<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'vendor_id' => App\Models\Vendor::all()->random()->id,
        'amount' => $faker->numberBetween(100,100000),
        'status' => rand(0,1),
    ];
});
