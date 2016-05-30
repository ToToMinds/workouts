@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Exercises</h1>
        <p>Create a new exercise <a href="{{ url('/exercises/create') }}">here</a></p>
        @if (count($exercises) > 0)
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                @foreach($exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->id }}</td>
                        <td>{{ $exercise->name }}</td>
                        <td>{{ $exercise->description }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
