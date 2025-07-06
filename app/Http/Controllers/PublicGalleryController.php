<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class PublicGalleryController extends Controller
{
    public function index() {
        $albums = Album::where('is_public', true)
                        ->with('user')
                        ->withCount('photos')
                        ->latest()
                        ->get();
        return view('public_index', compact('albums'));
    }

    public function show(Album $album) {
        if (!$album->is_public) {
            abort(404);
        }
        $album->load('photos');
        return view('public.show', compact('album'));
    }
}
