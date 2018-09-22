<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiseCapacity extends Model
{
	protected $table = 'rise_capacity';
    protected $fillable = ['from_date', 'to_date','events_id','rise_capacity','active','created_at','updated_at'];

    public function events(){

    	return $this->belongsTo('App\Events');
    }
}
