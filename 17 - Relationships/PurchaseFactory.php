<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase;
use App\User;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'user_id' => User::pluck('id')->random(),
        'date' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
        'price' => $faker->randomFloat(2, 1, 100),
        'description' => ucfirst($faker->words(2, true))
    ];
});
