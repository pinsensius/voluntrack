<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Relawan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class AdminController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin-list', only : ['dashboard','eventShow']),
            new Middleware('permission:admin-approve', only : ['approveEvent','rejectEvent']),
            new Middleware('permission:admin-show', only : ['eventShow']),
        ];
    }

    public function dashboard(Request $request): View{
        $search = $request->input('search');

        if($search){
            $events = Event::where('nama','like','%'. $search. '%')->orWhere('tags','like','%'. $search. '%')->orWhere('lokasi','like','%'. $search. '%')->orWhere('event_detail','like','%'. $search. '%')->where('status', 'pending')->get();
        }else{
            $events = Event::with('user')->where('status', 'pending')->get();
        }

        $banyakEvent = Event::count();
        $banyakRelawan = Relawan::distinct("user_id")->count();
        $banyakApprovedEvent = Event::where('status', 'approved')->count();
        $banyakRejectedEvent = Event::where('status', 'rejected')->count();
        $banyakAkun = User::count();

        return view('dashboard.event.index', compact('events','banyakAkun', 'banyakRejectedEvent', 'banyakApprovedEvent','banyakRelawan', 'banyakEvent'));

    }

    public function eventindex()
    {
        
       
    }

    /**
     * Display the specified resource.
     */
    public function eventShow(Event $event)
    {
        // session(['event_id' => $event->id_event]);
        $relawans = Relawan::where('event_id', $event->id_event)->latest()->get();
        return view('dashboard.event.show', compact('event', 'relawans'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function eventEdit(Event $event)
    {
        
        return view('dashboard.event.update', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function eventUpdate(Request $request, Event $event): RedirectResponse
    {
        $request->validate([
            'event_image' => 'required',
            'event_image.*' => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required|min:5|regex:/^[A-Za-z0-9\s]+$/|string',
            'tags' => 'required|in:lingkungan,kemanusiaan,olahraga|string',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => 'required|date',
            'lokasi' => 'required|string|min:3|max:255|regex:/^[A-Za-z0-9\s,.-]+$/',
            'event_detail' => 'required|string|min:10|max:2000',
            'requirement' => 'required|string|min:10|max:2000',
            'target_donasi' => 'required'
        ]);

        

        if($request->hasFile('event_image')){

            if($event->event_image) {
                $oldImages = json_decode($event->event_image, true);
                foreach($oldImages as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }   

            $imagePath = [];
            
            foreach($request->file('event_image') as $image){
                $imagePath[] = $image->store('event', 'public');
            }
    
            
    
            $event->update([
                'event_image' => json_encode($imagePath),
                'nama' => $request->nama,
                'tags' => $request->tags,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'lokasi' => $request->lokasi,
                'event_detail' => $request->event_detail,
                'requirement' => $request->requirement,
                'target_donasi' => $request->target_donasi
            ]);
        }else{
            $event->update([
                'nama' => $request->nama,
                'tags' => $request->tags,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'lokasi' => $request->lokasi,
                'event_detail' => $request->event_detail,
                'requirement' => $request->requirement,
                'target_donasi' => $request->target_donasi
            ]);
        }

        return redirect()->route('dashboard.event.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eventDestroy(Event $event)
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

    public function approveEvent(Event $event): RedirectResponse{
        $event->update(['status' => "approved"]);

        return redirect()->back()->with('success', 'Event telah di setujui');
    }

    public function rejectEvent(Event $event): RedirectResponse{
        $event->update(['status' => "rejected"]);

        return redirect()->back()->with('success', 'Event telah di tolak');
    }
}
