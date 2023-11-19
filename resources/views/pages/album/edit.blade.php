@extends('app')

@section('content')

<h1>Ajouter une photo à l'album : {{$album->titre}}</h1>

<form action="{{route('albumUpdate', $album->id)}}" method="POST" id="add">
    @csrf
    @method('PUT')
    <div class="input-fields">
        <div>
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

@endsection