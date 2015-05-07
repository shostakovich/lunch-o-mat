@extends('app')

@section('content')
    <h1>All Circles</h1>
    @foreach($circles as $circle)
    <article>
        <h1>{{$circle->name}}</h1>
        <p>{{$circle->description}}</p>
    </article>
    @endforeach
@stop
