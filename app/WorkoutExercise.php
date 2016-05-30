<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workout_id', 'exercise_id', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function exercise()
    {
        return $this->belongsToMany('App\Exercise');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function workout()
    {
        return $this->belongsToMany('App\Workout');
    }

    public function sets()
    {
        return $this->hasMany('App\Set');
    }

}
