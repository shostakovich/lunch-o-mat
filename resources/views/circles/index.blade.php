@extends('app')

@section('content')
    <div class="page-header">
        <h1>
            Join a circle!
            <small>Great people.</small>
        </h1>
    </div>

    @foreach($circles as $circle)
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="/circles/{{$circle->id}}">{{$circle->name}}</a>
        </div>
        <div class="panel-body">
            <div class="well well-sm">{{$circle->description}}</div>
        </div>
        <div class="panel-footer">Panel footer</div>
    </div>
    @endforeach
@stop
