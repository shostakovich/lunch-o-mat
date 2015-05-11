@extends('app')

@section('content')
    <div class="page-header">
        <h1>
            {{$circle->name}}
        </h1>

        @unless($membership)
            {!! BootForm::open()->post()->action('/memberships') !!}
            {!! Form::hidden('circle_id', $circle->id) !!}
            {!! Bootform::submit('Join Circle', 'btn-success') !!}
            {!! BootForm::close() !!}
        @else
            {!! BootForm::open()->delete()->action("/memberships/{$membership->id}") !!}
            {!! Bootform::submit('Leave Circle', 'btn-danger') !!}
            {!! BootForm::close() !!}
        @endunless
    </div>


    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="well well-sm">{{$circle->description}}</div>
        </div>
    </div>
@stop
