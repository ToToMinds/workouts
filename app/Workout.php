<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'start_date', 'end_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workoutExercises() {
        return $this->hasMany('App\WorkoutExercise');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exercises() {
        return $this->belongsToMany('App\Exercise', 'workout_exercises')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}
