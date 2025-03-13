<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage as FacadesStorage;

class TopicController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:topic-list|topic-create|topic-edit|topic-delete', only : ['index','store']),
            new Middleware('permission:topic-create', only : ['create','store']),
            new Middleware('permission:topic-edit', only : ['edit','update']),
            new Middleware('permission:topic-delete', only : ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        if ($search) {
            $data = Topic::where('judul_topic', 'like', '%' . $search . '%')
                         ->orWhere('isi_topic', 'like', '%' . $search . '%')
                         ->get();
        } else {
            $data = Topic::latest()->get();
        }

        return view('topic.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $rules = [
            'author_id' => 'required|exists:users,id',
            'judul_topic' => 'required|string|min:5',
            'isi_topic' => 'required|string|min:5',
            'tanggal_dibuat' => 'required|date',
        ];
    
        if ($request->hasFile('topic_img')) {
            $rules['topic_img'] = 'required|image|mimes:jpg,jpeg,png|max:2048';
        }
    
        $validatedData = $request->validate($rules);
    
        $topicData = [
            'author_id' => $validatedData['author_id'],
            'judul_topic' => $validatedData['judul_topic'],
            'isi_topic' => $validatedData['isi_topic'],
            'tanggal_dibuat' => $validatedData['tanggal_dibuat'],
        ];
    
        if ($request->hasFile('topic_img')) {
            $image = $request->file('topic_img');
            $topicData['topic_img'] = $image->store('topic', 'public'); 
        }
    
        Topic::create($topicData);
    
        return redirect()->route('topic.index')->with(['success' => 'Topic berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $comments = Comment::where('id_topic', $topic->id)->latest()->get();
        return view('topic.show', compact('topic', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('topic.update', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $rules = [
            'author_id' => 'required|exists:users,id',
            'judul_topic' => 'required|string|min:5',
            'isi_topic' => 'required|string|min:5',
            'tanggal_dibuat' => 'required|date',
        ];
    
        if ($request->hasFile('topic_img')) {
            $rules['topic_img'] = 'nullable|image|mimes:jpg,jpeg,png|max:2048';
        }
    
        $validatedData = $request->validate($rules);
    
        $topicData = [
            'author_id' => $validatedData['author_id'],
            'judul_topic' => $validatedData['judul_topic'],
            'isi_topic' => $validatedData['isi_topic'],
            'tanggal_dibuat' => $validatedData['tanggal_dibuat'],
        ];
    
        if ($request->hasFile('topic_img')) {
            if ($topic->topic_img && FacadesStorage::exists($topic->topic_img)) {
                FacadesStorage::delete($topic->topic_img);
            }
    
            $image = $request->file('topic_img');
            $topicData['topic_img'] = $image->store('public/topic');
        }
    
        $topic->update($topicData);
    
        return redirect()->route('topic.index')->with(['success' => 'Topic berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        if ($topic->topic_img) {
            // Hapus gambar dari penyimpanan
            FacadesStorage::delete('public/' . $topic->topic_img);
        }
    
        // Hapus topik dari database
        $topic->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('topic.index')->with('success', 'Topik berhasil dihapus');
    }
}
