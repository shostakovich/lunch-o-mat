@extends('app')

@section('content')
    @if(count($circles) == 0)
	    <div class="alert alert-warning">
		    You can not schedule any lunches!
	    </div>
    @else
    	{!! BootForm::open()->post()->action('/lunches') !!}
	    	{!! BootForm::select('Circle', 'circle_id')->options($circles)->select(array_keys($circles)[0]) !!}
		    {!! BootForm::text('When', 'starts_at') !!}
		    {!! BootForm::text('Duration', 'duration_in_minutes')->defaultValue('60') !!}
		    {!! BootForm::submit('Schedule Lunch') !!}
	    {!! BootForm::close() !!}
    @endif
@stop
