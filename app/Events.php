<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ['event_name','venues_id','start_date','end_date','active','created_at','updated_at'];

    public function venues(){

    	return $this->belongsTo('App\Venues');
    }

}
