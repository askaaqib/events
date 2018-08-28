<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    protected $fillable = ['venue_name','capacity','days_of_work','address','active',	'created_at','updated_at'];

}
