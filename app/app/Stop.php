<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id', 'workshop_id'
    ];


    /**
     * Get the orders for the stop
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'stop_id', 'id');
    }

    /**
     * Get the orders for the stop
     */
    public function route()
    {
        return $this->belongsTo('App\Route', 'route_id', 'id');
    }

    public function workshop(){
        return $this->hasOne('App\Workshop', 'workshop_id', 'workshop_id');
    }
}
