@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Workouts</h1>
        <p>Create a new workout <a href="{{ url('/workouts/create') }}">here</a></p>
        @if (count($workouts) > 0)
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Start/end Date</th>
                    <th>Exercises</th>
                </tr>
                @foreach($workouts as $workout)
                    <tr>
                        <td>{{ $workout->id }}</td>
                        <td>{{ $workout->start_date }} - {{ $workout->end_date }}</td>
                        <td>
                            <ul>
                            @foreach ($workout->exercises as $exercise)
                                <li>{{ $exercise->name }}</li>
                            @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
