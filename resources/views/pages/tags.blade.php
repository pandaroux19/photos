@extends('app')

@section('content')

<h1>Voici la liste des tags</h1>
<ul>
    @foreach($tags as $t)
    <li><a href="{{route("tag",$t->id)}}">{{$t->nom}}</a></li>
    @endforeach
</ul>

@endsection