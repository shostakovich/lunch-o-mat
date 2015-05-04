@extends('app')

@section('content')
    <h1>Upcoming Lunches</h1>

    <ul>
        @foreach($lunches as $lunch)
            <li>{{ $lunch->starts_at }} ({{ $lunch->duration_in_minutes }} min.)</li>
        @endforeach
    </ul>
@stop
