@extends('app')

@section('content')

<h1>Créer un nouvel album</h1>

<form action="{{route('albumStore')}}" method="post" id="add" enctype="multipart/form-data">
    @csrf
    <div class="input-fields">
        <label for="titre">Le titre de votre album</label>
        <input type="text" name="titre" id="titre" placeholder="Titre">
    </div>
    <button id="add-photo">Ajouter une photo</button>
    <input type="submit" value="Suivant">
</form>

@endsection