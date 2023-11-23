<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            $photo->album_id = $request->input("album_id");
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

        return redirect(route("albumShow", $request->input("album_id")));
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        foreach($photo->tags as $tag){
            $select = $tag->pivot->where('tag_id', strtolower($tag->pivot->tag_id))->count();
            if($select==1){
                $photo->tags()->delete();
            }
        }
        $photo->tags()->detach();
        $photo->delete();
        return redirect(url()->previous());
    }
}
