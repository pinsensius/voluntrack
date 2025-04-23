<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Event;
use App\Models\Relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:event-list|event-create|event-edit|event-delete', only : ['index','store']),
            new Middleware('permission:event-create', only : ['create','store']),
            new Middleware('permission:event-edit', only : ['edit','update']),
            new Middleware('permission:event-delete', only : ['destroy']),
            new Middleware('permission:event-show', only : ['show', 'edit'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search){
            $events = Event::where('nama','like','%'. $search. '%')->orWhere('tags','like','%'. $search. '%')->orWhere('alamat','like','%'. $search. '%')->orWhere('event_detail','like','%'. $search. '%')->get();
        }else{
            $events = Event::with('user')->get();
        }

        foreach($events as $event){
            $totalDonasi = Donasi::where('event_id', $event->id_event)->sum("amount");
            $persentaseDonasi = $event->target_donasi > 0 ? round(($totalDonasi / $event->target_donasi) * 100, 2) : 0;

            $event->progress_event = $persentaseDonasi;

            $event->save();
        }


        return view('event.index', compact('events'));

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('event.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_image' => 'required',
            'event_image.*' => 'image|mimes:jpeg,jpg,png|max:2048',
            'vr_image.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'host' => 'required|exists:users,id',
            'nama' => 'required|min:5|regex:/^[A-Za-z0-9\s]+$/|string',
            'tags' => 'required|in:lingkungan,kemanusiaan,olahraga|string',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date|after:today',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'event_detail' => 'required|string|min:10|max:2000',
            'requirement' => 'required|string|min:10|max:2000',
            'target_donasi' => 'required|numeric',
            'alamat' => 'required|string'
        ]);

        $imagePath = [];

        if( $request->hasFile('event_image')){
            foreach($request->file('event_image') as $image){
                $imagePath[] = $image->store('event', 'public');
            }
        }

        $vrImagePath = null;

        if( $request->hasFile('vr_image')){
            // dd($request->file('vr_image'));
            $vrImagePath = $request->file('vr_image')->store('360', 'public');
        }else{
            echo "gambar gak masuk";
        }

        Event::create([
            'event_image' => json_encode($imagePath),
            'vr_image' => $vrImagePath,
            'host' => $request->host,
            'nama' => $request->nama,
            'tags' => $request->tags,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'event_detail' => $request->event_detail,
            'requirement' => $request->requirement,
            'target_donasi' => $request->target_donasi,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('event.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // session(['event_id' => $event->id_event]);
        $relawans = Relawan::where('event_id', $event->id_event)->latest()->get();
        $donaturs = Donasi::with('user')->where('event_id', $event->id_event)->latest()->get()->unique('donatur');

        return view('event.show', compact('event', 'relawans', 'donaturs'));   

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        
        return view('event.update', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $request->validate([
            'event_image' => 'required',
            'event_image.*' => 'image|mimes:jpeg,jpg,png|max:2048',
            'vr_image.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required|min:5|regex:/^[A-Za-z0-9\s]+$/|string',
            'tags' => 'required|in:lingkungan,kemanusiaan,olahraga|string',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date|after:today',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s,.-]+$/',
            'event_detail' => 'required|string|min:10|max:2000',
            'requirement' => 'required|string|min:10|max:2000',
            'target_donasi' => 'required'
        ]);

        if ($request->hasFile('event_image')) {
            if ($event->event_image) {
                $oldImages = json_decode($event->event_image, true);
                foreach ($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $imagePath = [];
            foreach ($request->file('event_image') as $image) {
                $imagePath[] = $image->store('event', 'public');
            }

            $event->event_image = json_encode($imagePath);
        }

        if ($request->hasFile('vr_image')) {
            if ($event->vr_image) {
                Storage::disk('public')->delete($event->vr_image);
            }

            $vrImagePath = $request->file('vr_image')->store('360', 'public');
            $event->vr_image = $vrImagePath;
        }

        $event->update([
            'nama' => $request->nama,
            'tags' => $request->tags,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alamat' => $request->alamat,
            'event_detail' => $request->event_detail,
            'requirement' => $request->requirement,
            'target_donasi' => $request->target_donasi
        ]);

        return redirect()->route('event.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {   
        if($event->event_image) {
            $imagePaths = json_decode($event->event_image, true);
            foreach($imagePaths as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        
        $event->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');


    }
}
