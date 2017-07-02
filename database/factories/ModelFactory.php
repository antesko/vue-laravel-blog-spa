<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'avatar'         => $faker->imageUrl(),
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => \App\User::inRandomOrder()->first()->id,
        'title'    => $faker->unique()->sentence,
        'body'     => $faker->realText(mt_rand(2000, 5000)),
        'image'    => $faker->imageUrl(),
        'tags'     => json_encode($faker->words(mt_rand(2, 7))),
        'featured' => mt_rand(0, 1),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'post_id' => \App\Post::inRandomOrder()->first()->id,
        'body'    => $faker->realText(),
    ];
});
