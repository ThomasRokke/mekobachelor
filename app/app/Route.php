<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    {                                                                                //To remove problem with Laravel not implementing NULL logic in orderByFunction - So i Do this with raw to prevent using RAW in Eloquent ORM later in the project.
        return $this->hasMany('App\Stop', 'route_id', 'id')->select(['*', DB::raw('route_position IS NULL AS route_position_null')])
            ->orderBy('route_position_null')
            ->orderBy('route_position');
    }

    /**
     * Get the stops for the route
     */
    public function driver()
    {
        return $this->hasOne('App\User', 'id', 'driver_id');
    }



}
