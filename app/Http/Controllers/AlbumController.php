<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function showAlbums(){
        $albums = Album::all();
        return view('pages/albums', ["albums" => $albums]);
    }

    public function showAlbum($id){
        $album = Photo::findOrFail($id);
        return view('pages/album', ["album" => $album]);
    }
}
