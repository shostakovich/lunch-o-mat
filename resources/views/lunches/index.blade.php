@extends('app')

@section('content')
	<h1>Upcoming Lunches</h1>

	@foreach($circles as $circle)
		<table>
			<thead>
				<caption>{{$circle->name}}</caption>
			</thead>
			<tbody>
			<tr>
				<td>Date</td>
				<td>Time</td>
				<td>Duration</td>
				<td>Signup</td>
			</tr>
			@foreach($circle->upcomingLunches as $lunch)
				<tr>
					<td>{{ $lunch->starts_at->toFormattedDateString() }}</td>
					<td>{{ $lunch->starts_at->toTimeString() }}</td>
					<td>({{ $lunch->duration_in_minutes }} min.)</td>
					<td>
						{!! Form::open(['url' => "/lunches/{$lunch->id}/signup", 'method' => 'post']) !!}
							{!! Form::submit('Signup') !!}
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@endforeach
@stop
