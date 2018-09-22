<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venues extends Model
{
    protected $fillable = ['venue_name','capacity','days_of_work','address','active','created_at','updated_at'];

    function array_sub_sort(array $values, array $keys){

		$i=0;
		$status = 0;
		$arr;
		foreach($keys as $key => $value){
			
			foreach($values as $k => $v){
				if($value == $v){
					$status = 1;
					break;
				}
			}
    		if($status == 1){
    			$arr[$value] =$value;
    			$status = 0;
    		}else{
    			$arr[$value] = 0;
    		}
    	}
			
		return $arr;
	}

}
