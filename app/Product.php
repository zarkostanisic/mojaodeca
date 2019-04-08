<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $casts = [
        'images' => 'json',
    ];

    public function country(){

        return $this->belongsTo('App\Country');
    }
    public function category(){

    	return $this->belongsTo('App\Category','category_id', 'id');
    }
    public function subcategory(){

        return $this->belongsTo('App\Subcategory');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function gender(){

    	return $this->belongsTo('App\Gender');
    }
     public function getUsedAttribute($value)
    {
    	if($value == 0){
    		return 'Novo';
    	}else{
    		return 'Polovno';
    	}
       
    }

    public function scopeLatestByCategory($query,$category_id){

        $query->where('category_id', $category_id)->latest();
    }

    public function getSlugAttribute(): string
    {
        return str_slug($this->name);
    }

}
