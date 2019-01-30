<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'workshop_id'
    ];
    /**
     * Get the stops for the route
     */
    public function stops()
    {
        return $this->hasMany('App\Stop', 'workshop_id', 'workshop_id');
    }
}
