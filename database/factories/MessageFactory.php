<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
        'recipient_id' => factory(\App\Models\User::class),
    ];
});
