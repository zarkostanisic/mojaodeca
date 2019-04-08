php<?php

use Faker\Generator as Faker;
use App\Type;
use App\Category;
use App\Image;
use App\User;
use App\Gender;
use App\Subcategory;

$factory->define(App\Product::class, function (Faker $faker) {

    $category_id=Category::all()->random()->id;

    $result=Subcategory::where('category_id','=',$category_id)->first();
 
    if ($result) {
        $subcategory_id=$result->id;
    }else{
        $subcategory_id=1;
    }
    
    // var_dump($subcategory_id);
    
    return [
       
     		'name'=>$faker->sentence(),
            'description'=>$faker->realText,
            'price'=>$faker->randomDigit,
            'size'=>$faker->numberBetween(35,48),
            'phone'=>$faker->e164PhoneNumber, 
        	'location'=>$faker->city,
         	'used'=>$faker->boolean,
            'favorite_num'=>$faker->randomDigit,
            'views_num'=>$faker->randomDigit,
            'category_id'=>$category_id,
        	'images'=>'{}',
            'gender_id'=>Gender::all()->random()->id,
            'subcategory_id'=>$subcategory_id,
            'user_id'=>User::all()->random()->id,
    ];
});
