<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Event;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        // dd($events);
        return view('donasi.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Donasi $donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donasi $donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donasi $donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donasi $donasi)
    {
        //
    }

    public function createTransaction(Request $request){
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

        Donasi::create([
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
    
        $donasi = Donasi::where('order_id', $orderId)->first();
    
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
