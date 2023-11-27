<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();
        return view('pages.album.index', ["albums" => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "titre" => "required",
            "titre-photo.*" => "required",
            "url.*" => "required | url",
            "note.*" => "required | integer | max:10",
            "tags.*" => "required",
        ]);

        $album = new Album();
        $album->titre = $request->input('titre');
        $album->creation = date('Y-m-d');
        $album->save();

        for($i=0;$i<count($request->input("titre-photo"));$i++) {
            $tags = explode(' ', $request->input('tags')[$i]);
            $photo = new Photo();
            $photo->titre = $request->input("titre-photo")[$i];
            $photo->url = $request->input("url")[$i];
            $photo->note = $request->input("note")[$i];
            $photo->album_id = $album->id;
            $photo->save();
            foreach($tags as $t){
                $select = Tag::whereRaw('LOWER(nom) = ?', strtolower($t))->first();
                if($select){
                    $photo->tags()->attach($select->id);
                }
                else{
                    $tag = new Tag();
                    $tag->nom = $t;
                    $tag->save();
                    $photo->tags()->attach($tag->id);
                }
            }
        }

        return redirect(route("albumShow", $album->id));


        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        return view('pages.album.show', ["album" => $album]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        return view('pages.album.edit', ["album" => $album]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            "titre-photo.*" => "required",
            "url.*" => "required | url",
            "note.*" => "required | integer | max:10",
            "tags.*" => "required",
        ]);
        
        for($i=0;$i<count($request->input("titre-photo"));$i++) {
            $tags = explode(' ', $request->input('tags')[$i]);
            $photo = new Photo();
            $photo->titre = $request->input("titre-photo")[$i];
            $photo->url = $request->input("url")[$i];
            $photo->note = $request->input("note")[$i];
            $photo->album_id = $album->id;
            $photo->save();
            foreach($tags as $t){
                $select = Tag::whereRaw('LOWER(nom) = ?', strtolower($t))->first();
                if($select){
                    $photo->tags()->attach($select->id);
                }
                else{
                    $tag = new Tag();
                    $tag->nom = $t;
                    $tag->save();
                    $photo->tags()->attach($tag->id);
                }
            }
        }

        return redirect(route("albumShow", $album->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
