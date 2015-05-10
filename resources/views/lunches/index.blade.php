@extends('app')

@section('content')
    <div class="page-header">
        <h1>
            Sign up for a Lunch!
            <small>Let Lunch-o-mat do all the heavy lifting...</small>
        </h1>
    </div>


    <div class="alert alert-warning" role="alert">
        <strong>Warning!</strong> You might have to socialize..
    </div>

	@foreach($circles as $circle)
        <div class="panel panel-default">
            <div class="panel-heading">
               {{$circle->name}}
            </div>
            <div class="panel-body">{{$circle->description}}</div>
            <table class="table table-bordered">
                <thead>
                <tr class="active">
                    <th>Status</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($circle->upcomingLunches as $lunch)
                    <tr class="{{ ($lunch->isSignedUp($user)) ? 'success' : '' }}">
                        <td>
                            <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span> Participating
                        </td>
                        <td>{{ $lunch->starts_at->toFormattedDateString() }}</td>
                        <td>{{ $lunch->starts_at->toTimeString() }}</td>
                        <td>({{ $lunch->duration_in_minutes }} min.)</td>

                        <td>
                        @unless($lunch->isSignedUp($user))
                            {!! BootForm::open()->post()->action("/lunches/{$lunch->id}/signup") !!}
                            {!! BootForm::submit('Signup', 'btn-success') !!}
                            {!! BootForm::close() !!}
                        @else
                            {!! BootForm::open()->post()->action("/lunches/{$lunch->id}/cancel") !!}
                            {!! BootForm::submit('Cancel', 'btn-error') !!}
                            {!! BootForm::close() !!}
                        @endunless
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
	@endforeach
@stop
