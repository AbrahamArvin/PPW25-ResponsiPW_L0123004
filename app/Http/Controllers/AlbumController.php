<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Auth::user()->albums()->withCount('photos')->latest()->get();
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'sometimes|boolean',
        ]);

        $data = $request->only('name', 'description');
        $data['is_public'] = $request->has('is_public');

        Auth::user()->albums()->create($data);

        return redirect()->route('albums.index')
                         ->with('success', 'Album berhasil dibuat.');
    }


    public function edit(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }
        return view('albums.edit', compact('album'));
    }


    public function update(Request $request, Album $album)
    {
      
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'sometimes|boolean',
        ]);

        $data = $request->only('name', 'description');
        $data['is_public'] = $request->has('is_public');

        $album->update($data);

        return redirect()->route('albums.index')
                         ->with('success', 'Album berhasil diperbarui.');
    }

  
    public function destroy(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }
        
        $album->delete();

        return redirect()->route('albums.index')
                         ->with('success', 'Album berhasil dihapus.');
    }

    public function show(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }
        
        $album->load('photos');
        return view('albums.show', compact('album'));
    }
}