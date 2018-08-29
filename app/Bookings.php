<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [];

    public function venues(){

    	return $this->belongsTo('App\Venues','venue_id');
    }

    public function events(){

    	return $this->belongsTo('App\Events','event_id');
    }

    public function users(){

    	return $this->belongsTo('App\Models\Auth\User', 'customer_id');
    }
}
