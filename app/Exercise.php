<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function workouts()
    {
        return $this->belongsToMany('App\Workout', 'workout_exercises', 'exercise_id', 'workout_id')
            ->withPivot(['description', 'sets', 'reps'])
            ->withTimestamps();
    }

}
