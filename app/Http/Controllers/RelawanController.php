<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RelawanController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:relawan-daftar', only : ['daftar','store']),
        ];
    }
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
    public function create()
    {
        //
    }

    public function daftar(Event $event)
    {
        return view('relawan.create', compact('event'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|min:2',
            'nomor_telepon' => 'required|string|min:10|max:12|regex:/^[0-9]+$/',
            'nama_organisasi' => 'required|string|min:2',
            'nik' => 'required|string|size:16|regex:/^[0-9]+$/',
            'event_id' => 'required|integer|exists:events,id_event',
            'user_id' => 'required|integer'
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka.',
            'nik.size' => 'NIK harus tepat 16 digit.',
            'event_id.exists' => 'Event tidak ditemukan.',
        ]);
    
        Relawan::create($validatedData);
    
        return redirect()->route('event.index')->with('success', 'Data relawan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Relawan $relawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relawan $relawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relawan $relawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relawan $relawan)
    {
        //
    }
}
