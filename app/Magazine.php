<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    public function category(){
    	return $this->belongsTo('App\MagazineCategory','cat_id');
    }
    public function getSlugAttribute(): string
    {
        return str_slug($this->title);
    }
}
