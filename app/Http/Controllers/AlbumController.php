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
            "image.*" => "required | file | mimes:jpg,png",
            // "url.*" => "required | url",
            "note.*" => "required | integer | max:10",
            "tags.*" => "required",
        ]);

        $album = new Album();
        $album->titre = $request->input('titre');
        $album->creation = date('Y-m-d');
        $album->user_id = auth()->user()->id;
        $album->save();

        if($request->input("titre-photo")){
            for($i=0;$i<count($request->input("titre-photo"));$i++) {
                $tags = explode(' ', $request->input('tags')[$i]);

                if($request->file("image")[$i]->isValid()) {               // Je vérifie qu'il est valide
                    $f = $request->file("image")[$i]->hashName();         // Je récupère un hash de son nom
                    $request->file("image")[$i]->storeAs("public/upload", $f);   // Je le stocke au bon endroit
                    $image = "/storage/upload/$f";                     // Si je veux pouvoir l'utiliser c'est avec ce chmin
                    // Enregistrer dans base de données ?
                }

                $photo = new Photo();
                $photo->titre = $request->input("titre-photo")[$i];
                // $photo->url = $request->input("url")[$i];
                $photo->url = $image;
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
        }

        return redirect(route("albumShow", $album->id));
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
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        foreach($album->photos as $photo){
            foreach($photo->tags as $tag){
                $select = $tag->pivot->where('tag_id', strtolower($tag->pivot->tag_id))->count();
                if($select==1){
                    $photo->tags()->delete();
                }
            }
            $photo->tags()->detach();
            $photo->delete();
        }
        $album->delete();
        return redirect(route("albumIndex"));
    }
}
