@extends('app')

@section('content')

<h1>{{$tag->nom}}</h1>
<ul>
    @foreach($tag->photos as $p)
    <a href="{{route('albumShow', $p->album->id)}}"><img src="{{$p->url}}" alt="{{$p->titre}}"></a>
    @endforeach
    <a href="{{url()->previous()}}">Revenir en arrière</a>
</ul>

@endsection