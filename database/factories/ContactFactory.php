<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'team_id' => $faker->randomNumber,
        'unsubscribed_status' => $faker->randomElement(['none']),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'sticky_phone_number_id' => $faker->randomNumber,
        'twitter_id' => $faker->randomNumber,
        'fb_messenger_id' => $faker->randomNumber,
        'time_zone' => $faker->randomElement(['Central Daylight Time', 'Eastern Daylight Time']),
    ];
});
