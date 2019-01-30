<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the orders for the stop
     */
    public function stop()
    {
        return $this->belongsTo('App\Stop', 'stop_id', 'id');
    }
}
