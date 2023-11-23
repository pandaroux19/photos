@extends('app')

@section('content')
    <h1>{{$album->titre}}</h1>
    <form action="{{route("albumDestroy", $album->id)}}" method="post">
        @csrf
        @method("delete")
        <input type="submit" value="Supprimer l'album">
    </form>
    <ul>
        @foreach ($album->photos as $p)
            <li>
                <div id="photoBig">
                    <img src="" alt="photo">
                    <button>Fermer</button>
                </div>
                <h2>{{$p->titre}}</h2>
                <img id="photoShow" src="{{$p->url}}" alt="{{$p->titre}}">
                <ul>
                    @foreach ($p->tags as $tag)
                        <li><a href="{{route("tagShow", $tag->id)}}">{{$tag->nom}}</a></li>
                    @endforeach
                </ul>
                <p>{{$p->note}}</p>
                <form action="{{route("photoDestroy", $p->id)}}" method="post">
                @csrf
                @method("delete")
                <input type="submit" value="Supprimer">
                </form>
            </li>
        @endforeach
    </ul>
    <form action="/photo" method="POST" id="add">
        @csrf
        <div class="input-fields">
            <div>
                <input type="hidden" name="album_id" value="{{$album->id}}">
                <input type="text" name="titre-photo[]" required placeholder="Titre">
                <input type="text" name="url[]" required placeholder="Lien de l'image">
                <input type="number" name="note[]" required placeholder="Note">
                <input type="text" name="tags[]" required placeholder="Les tags">
                <button id="remove-photo">Supprimer la photo</button>
            </div>
        </div>
        <button id="add-photo">Ajouter une photo</button>
        <input type="submit" value="Suivant">
    </form>
    <a href="{{url()->previous()}}">Revenir en arrière</a>
    @endsection