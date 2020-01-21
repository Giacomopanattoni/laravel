<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Album;
use App\Models\Photo;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$categories = array(
    'cats',
    'business',
    'abstract') 
;

$factory->define(Album::class, function (Faker $faker) use ($categories) {
    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'user_id' => User::inRandomOrder()->first()->id,
        'album_thumb' => $faker ->imageUrl(120,120, $faker->randomElement($categories))
    ];
});


$factory->define(Photo::class, function (Faker $faker) use ($categories) {
    return [
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'album_id' => Album::inRandomOrder()->first()->id,
        'img_path' => $faker->imageUrl( 640,480,$faker->randomElement( $categories ))
    ];
});
