<?php

namespace App;
use Cache;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function list(){
    	return Cache::remember('categories', 22*60, function() {
            return $this->all();
        });
    }
}
