<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $hasher = app()->make('hash');

    $faker->addProvider(new Faker\Provider\vi_VN\Address($faker));
    $faker->addProvider(new Faker\Provider\vi_VN\Color($faker));
    $faker->addProvider(new Faker\Provider\vi_VN\Person($faker));
    $faker->addProvider(new Faker\Provider\vi_VN\PhoneNumber($faker));
    $faker->addProvider(new Faker\Provider\vi_VN\PhoneNumber($faker));

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->userName,
        'password' => $hasher->make('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
        'description' => $faker->sentences(1, true),
    ];
});

$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'category_id' => \App\Models\Category::orderByRaw('RAND()')->first()->id,
        'user_id' => \App\Models\User::orderByRaw('RAND()')->first()->id,
        'slug' => $faker->slug,
        'title' => $faker->jobTitle,
        'excerpt' => $faker->sentences(2, true),
        'content' => $faker->realText(3000),
        'status' => rand(0, 1),
        'image' => $faker->imageUrl()   ,
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'slug' => $faker->slug,
    ];
});

$factory->define(App\Models\PostTag::class, function (Faker\Generator $faker) {
    return [
        'tag_id' => \App\Models\Tag::orderByRaw('RAND()')->first()->id,
        'post_id' => \App\Models\Post::orderByRaw('RAND()')->first()->id,
    ];
});

