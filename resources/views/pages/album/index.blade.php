@extends('app')

@section('content')
    <h1>Voici la liste des albums</h1>
    <ul>
        @foreach ($albums as $a)
            <li><a href="{{route('albumShow', $a->id)}}">{{$a->titre}}</a></li>            
        @endforeach
        
    </ul>
@endsection