<?php $errors = Session::has('errors') ? Session::get('errors') : $errors; ?>

@extends('app')

@section('content')
    <h1>Create a new circle</h1>

    {!! Form::open(['url' => '/circles', 'method' => 'post']) !!}
        <div>
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name') !!}
	        {!! $errors->first('name') !!}
        </div>
        <div>
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textArea('description') !!}
	        {!! $errors->first('description') !!}
        </div>

        <div>
            {!! Form::submit('Create Circle') !!}
        </div>
    {!! Form::close() !!}
@stop
