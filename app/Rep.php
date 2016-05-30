<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rep extends Model
{

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'count', 'weight', 'set_id'
    ];

    public function set() {
        return $this->belongsTo('App\Set');
    }

}
