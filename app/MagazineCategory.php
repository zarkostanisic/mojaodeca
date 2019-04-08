<?php

namespace App;
use Cache;
use Illuminate\Database\Eloquent\Model;

class MagazineCategory extends Model
{
    protected $table='magazine_categories';

    public function magazines(){
    	$this->hasMany('App\Magazine','cat_id');
    }

    public function list(){
    	return Cache::remember('magazineCategories', 22*60, function() {
            return $this->all();
        });
    }

}
