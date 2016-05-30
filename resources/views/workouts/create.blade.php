@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Workout</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST"
                                  action="{{ url('/workouts/store') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">Duration</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="duration"
                                               value="{{ old('duration') }}">

                                        @if ($errors->has('duration'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">Start Date</label>

                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="start_date"
                                               value="{{ old('start_date') }}">
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">Start Date</label>

                                    <div class="col-md-10">
                                        <input type="date" class="form-control" name="end_date"
                                               value="{{ old('end_date') }}">
                                    </div>
                                </div>

                                <div id="exercises">

                                    <div class="exercise-group form-group{{ $errors->has('exercises') ? ' has-error' : '' }}">
                                        <label class="col-md-2 control-label">Exercises</label>

                                        <div class="col-md-10">
                                            <select class="form-control" name="exercises[]">
                                                @foreach($exercises as $exercise)
                                                    <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-md-offset-2">
                                        <button id="add-exercise-btn" class="btn btn-default">Add
                                            Exercise
                                        </button>
                                        <button id="remove-exercise-btn" class="btn btn-danger">Remove Exercise</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-2">
                                        <input class="btn btn-primary" type="submit" value="Create">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {

            function addNewExercise() {
                var $container = $('#exercises');
                var $exerciseBlock = $('.exercise-group').first().clone();
                $container.append($exerciseBlock);
            }

            function removeExercise() {
                var $container = $('#exercises');
                if ($container.find('.exercise-group').size() > 1) {
                    $container.find('.exercise-group').last().remove();
                }
            }

//            $('body').last().on('change', '#exercises select:last', function () {
//                setTimeout(function () {
//                    addNewExercise();
//                }, 300);
//            });

            $('#add-exercise-btn').on('click', function (e) {
                e.preventDefault();
                addNewExercise();
            });

            $('#remove-exercise-btn').on('click', function (e) {
                e.preventDefault();
                removeExercise();
            });

        });
    </script>
@endsection
