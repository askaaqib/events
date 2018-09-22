<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcludeDate extends Model
{
    //

    protected $fillable = ['from_date', 'to_date','venues_id','active','created_at','updated_at'];

    public function venues(){

    	return $this->belongsTo('App\Venues');
    }
}
