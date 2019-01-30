<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'route', 'time', 'active', 'finished', 'driver_id', 'active',
    ];

    /**
     * Get the stops for the route
     */
    public function stops()
    {
        return $this->hasMany('App\Stop', 'route_id', 'id');
    }

    /**
     * Get the stops for the route
     */
    public function driver()
    {
        return $this->hasOne('App\User', 'id', 'driver_id');
    }



}
