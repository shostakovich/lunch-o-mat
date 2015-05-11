@extends('app')

@section('content')
    <div class="page-header">
        <h1>
            {{$circle->name}}
        </h1>
    </div>

    @unless($circle->hasMember($user))
    {!! BootForm::open()->post()->action('/memberships') !!}
        {!! Form::hidden('circle_id', $circle->id) !!}
        {!! Bootform::submit('Join Circle') !!}
    {!! BootForm::close() !!}
   @else
    {!! BootForm::open()->delete()->action('/memberships') !!}
        {!! Form::hidden('circle_id', $circle->id) !!}
        {!! Bootform::submit('Leave Circle') !!}
    {!! BootForm::close() !!}
    @endunless
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="well well-sm">{{$circle->description}}</div>
        </div>
    </div>
@stop
