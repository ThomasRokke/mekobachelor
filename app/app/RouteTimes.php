<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteTimes extends Model
{
    //
    protected $fillable = [
        'route', 'time', 'from_time', 'to_time'
    ];
}
