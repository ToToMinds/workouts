<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count', 'workout_exercise_id'
    ];

    public function exercise()
    {
        return $this->belongsTo('App\WorkoutExercise', 'workout_exercise_id');
    }

    public function reps()
    {
        return $this->hasMany('App\Rep');
    }

}
