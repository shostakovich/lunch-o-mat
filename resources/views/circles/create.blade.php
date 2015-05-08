<?php $errors = Session::has('errors') ? Session::get('errors') : $errors; ?>

@extends('app')

@section('content')
    <h1>Create a new circle</h1>

    {!! BootForm::open()->post()->action('/circles') !!}
        {!! BootForm::text('Name', 'name') !!}
        {!! BootForm::textarea('Description', 'description') !!}
        {!! BootForm::submit('Create Circle') !!}
    {!! BootForm::close() !!}
@stop
