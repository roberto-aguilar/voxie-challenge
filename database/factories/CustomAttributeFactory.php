<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use App\CustomAttribute;
use Faker\Generator as Faker;

$factory->define(CustomAttribute::class, function (Faker $faker) {
    return [
        'contact_id' => factory(Contact::class),
        'key' => $faker->word,
        'value' => $faker->word,
    ];
});
