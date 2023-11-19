@extends('app')

@section('content')
    <h1>{{$album->titre}}</h1>
    <ul>
        @foreach ($album->photos as $p)
            <li>
                <h2>{{$p->titre}}</h2>
                <img src="{{$p->url}}" alt="{{$p->titre}}">
                <ul>
                    @foreach ($p->tags as $tag)
                        <li><a href="{{route("tagShow", $tag->id)}}">{{$tag->nom}}</a></li>
                    @endforeach
                </ul>
                <p>{{$p->note}}</p>
            </li>
        @endforeach
        <a href="{{url()->previous()}}">Revenir en arrière</a>
    </ul>
@endsection