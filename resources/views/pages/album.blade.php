@extends('app')

@section('content')
    <h1>{{$album->titre}}</h1>
    <ul>
        @foreach ($album->photos as $p)
            <li>
                <h2>{{$p->titre}}</h2>
                <img src="{{$p->url}}" alt="">
            </li>
        @endforeach
    </ul>
@endsection