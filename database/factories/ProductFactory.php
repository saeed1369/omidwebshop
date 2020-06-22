<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name ,
        'image' => $faker->image() ,
        'price' => $faker->randomFloat() ,
        'takhfif' => $faker->numberBetween(0,50) ,
        'country' => $faker->country ,
        'catagory1' => $faker->text(20) ,
        'catagory2' => $faker->name,
        'catagory3' => $faker->name ,
        'company' => $faker->company ,
        'khasiyat' => $faker->text(200),
        'aboutProduct' => $faker->text(500) ,
        'brand' => $faker->name ,
        'hajm' => $faker->numberBetween(20,2000) ,
        'tarkibat' => $faker->text(50) ,
        'nahvehEstefadeh' => $faker->text(300) ,
        'age' => $faker->numberBetween(10,70) ,
        'gener' => 'مرد' ,
        'codeBehdasht' => $faker->numberBetween(1000,50000),
        'created_at' =>now(),
        'updated_at' => $faker->dateTime() ,
    ];
});
