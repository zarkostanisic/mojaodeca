<?php

namespace App;
use Cache;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     public function list(){
    	return Cache::remember('countries', 22*60, function() {
            return $this->all();
        });
    }
}
