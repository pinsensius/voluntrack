<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Midtrans\Notification;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:item-list|item-create|item-edit|item-delete', only: ['index', 'store']),
            new Middleware('permission:item-create', only: ['create', 'store']),
            new Middleware('permission:item-edit', only: ['edit', 'update']),
            new Middleware('permission:item-delete', only: ['destroy']),
            new Middleware('permission:item-show', only: ['show', 'edit'])
        ];
    }

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    public function createPayment(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'item_id' => 'required|exists:items,id',
        ]);

        $itemId = $request->input('item_id'); // Get the item ID from the request
        $item = Item::findOrFail($itemId); // Get the item from the database

        // Update the stock of the item
        if ($item->stok <= 0) {
            return response()->json(['error' => 'Item is out of stock!'], 400);
        }

        // Decrease stock by 1
        $item->stok -= 1;

        // Wrap the database operations in a transaction to maintain data integrity
        DB::beginTransaction();

        try {
            // Save the updated stock in the database
            $item->save();

            // Generate a unique order ID
            $orderId = uniqid();

            // Calculate the total transaction amount
            $hargaBarang = $item->harga_barang;
            $namaBarang = $item->nama_barang;
            $totalTransaksi = $hargaBarang * 1; // Assuming 1 item is being purchased

            // Insert the transaction details into the database
            DB::table('transaction_details')->insert([
                'item_id' => $itemId,
                'nama_barang' => $namaBarang,
                'harga_barang' => $hargaBarang,
                'total_transaksi' => $totalTransaksi,
            ]);

            // Prepare parameters for Midtrans Snap API
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $totalTransaksi,
                ],
                'item_details' => [
                    [
                        'id' => $orderId,
                        'price' => $hargaBarang,
                        'quantity' => 1,
                        'name' => $namaBarang,
                    ],
                ],
                'customer_details' => [
                    'first_name' => $request->user()->name ?? 'Guest',
                    'email' => $request->user()->email ?? 'guest@example.com',
                ],
            ];

            // Call Midtrans API to get Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Commit the transaction if everything is successful
            DB::commit();

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Return error response
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::latest()->get();

        return view("merchant.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("merchant.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar_barang' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        if ($request->hasFile('gambar_barang')) {
            $file = $request->file("gambar_barang");

            if ($file->isValid()) {
                $imagePath = $file->storeAs('items', $file->hashName(), 'public');

                Item::create([
                    'nama_barang' => $request->nama_barang,
                    'harga_barang' => $request->harga_barang,
                    'stok' => $request->stok,
                    'gambar_barang' => $imagePath
                ]);

                return redirect()->route("merchant.index")->with('success', 'Item berhasil ditambahkan');
            };
        } else {
            return redirect()->back()->withErrors('gambar_barang', 'Gambar barang gagal dimasukan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('merchant.index')->withErrors('Item tidak ditemukan.');
        }

        return view('merchant.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('merchant.index')->withErrors('Item tidak ditemukan.');
        }

        return view("merchant.edit", compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'nama_barang' => 'required|string|min:5|max:255',
            'harga_barang' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar_barang' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
    
        // Temukan item berdasarkan ID
        $item = Item::find($id);
    
        if (!$item) {
            return redirect()->route('merchant.index')->withErrors('Item tidak ditemukan.');
        }
    
        // Jika gambar barang ada dalam request
        if ($request->hasFile('gambar_barang')) {
            // Hapus gambar lama jika ada
            if ($item->gambar_barang && Storage::disk('public')->exists($item->gambar_barang)) {
                Storage::disk('public')->delete($item->gambar_barang);
            }
    
            // Simpan gambar baru dan dapatkan path-nya
            $imagePath = $request->file('gambar_barang')->store('items', 'public');
    
            // Perbarui semua atribut, termasuk gambar
            $item->update([
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'stok' => $request->stok,
                'gambar_barang' => $imagePath,
            ]);
        } else {
            // Perbarui atribut tanpa gambar
            $item->update([
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'stok' => $request->stok,
            ]);
        }
    
        // Redirect dengan pesan sukses
        return redirect()->route('merchant.index')->with('success', 'Item berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('merchant.index')->withErrors('Item tidak ditemukan.');
        }

        if ($item->gambar_barang && Storage::disk('public')->exists($item->gambar_barang)) {
            Storage::disk('public')->delete($item->gambar_barang);
        }

        $item->delete();

        return redirect()->route("merchant.index")->with('success', 'Item berhasil dihapus');
    }

    public function createTransaction(Request $request)
    {
        $id = $request->input('id');
        // $item = Item::findOrFail('')
        $orderId = uniqid();
        $amount = $request->input('amount');
        $paymentType = 'donation';

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $amount
        ];

        $customerDetails = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'callbacks' => [
                'finish' => route('event.index')
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        Item::create([
            'order_id' => $orderId,
            'amount' => $amount,
            'payment_type' => $paymentType,
            'transaction_status' => 'pending',
            'event_id' => $request->event_id,
            'donatur' => $request->donatur
        ]);

        return response()->json(['snap_token' => $snapToken]);
    }



    public function handleNotification(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new Notification();
        $transaction = $notification->transaction_status;
        $orderId = $notification->order_id;

        $donasi = Item::where('order_id', $orderId)->first();

        if (!$donasi) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        switch ($transaction) {
            case 'capture':
                if ($notification->payment_type == 'credit_card') {
                    $donasi->transaction_status = $notification->fraud_status === 'challenge' ? 'challenge' : 'success';
                }
                break;

            case 'settlement':
                $donasi->transaction_status = 'success';
                break;

            case 'pending':
                $donasi->transaction_status = 'pending';
                break;

            case 'deny':
                $donasi->transaction_status = 'denied';
                break;

            case 'expire':
                $donasi->transaction_status = 'expired';
                break;

            case 'cancel':
                $donasi->transaction_status = 'canceled';
                break;
        }

        $donasi->save();

        return response()->json(['message' => 'Notification handled successfully'], 200);
    }
}
