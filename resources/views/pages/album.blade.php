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
                        <li><a href="{{route("tag", $tag->id)}}">{{$tag->nom}}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection