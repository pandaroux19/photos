<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Tag;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function showAlbums(){
        $albums = Album::all();
        return view('pages/albums', ["albums" => $albums]);
    }

    public function showAlbum($id){
        $album = Album::findOrFail($id);
        return view('pages/album', ["album" => $album]);
    }

    public function showTags(){
        $tags = Tag::all();
        return view('pages/tags', ["tags" => $tags]);
    }

    public function showTag($id){
        $tag = Tag::findOrFail($id);
        return view('pages/tag', ["tag" => $tag]);
    }
}
