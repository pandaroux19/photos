@extends('app')

@section('content')

<h1>{{$tag->nom}}</h1>
<ul>
    @foreach($tag->photos as $p)
    <a href="{{route('album', $p->album->id)}}"><img src="{{$p->url}}" alt="{{$p->titre}}"></a>
    @endforeach
</ul>

@endsection