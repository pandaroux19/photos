@extends('app')

@section('content')
    <h1>Voici la liste des albums</h1>
    <ul>
        @foreach ($albums as $a)
            <li><a href="{{route('album', $a->id)}}">{{$a->titre}}</a></li>            
        @endforeach
    </ul>
@endsection