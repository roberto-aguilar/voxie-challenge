<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ContactFile;
use App\User;
use Faker\Generator as Faker;

$factory->define(ContactFile::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->word,
        'path' => "contacts/{$faker->word}.csv",
    ];
});
