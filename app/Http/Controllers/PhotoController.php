<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PhotoController extends Controller
{
    use AuthorizesRequests;
    public function create(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }
        return view('photos.create', compact('album'));
    }

    public function store(Request $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('photos', 'public');

        $album->photos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('albums.show', $album)
                         ->with('success', 'Foto berhasil diunggah.');
    }

    public function destroy(Photo $photo)
    {
        $this->authorize('delete', $photo);
        Storage::disk('public')->delete($photo->file_path);
        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
