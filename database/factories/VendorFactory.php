<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {

   $startingDate = $faker->dateTimeBetween('this week', '+6 days');
    $endingDate   = $faker->dateTimeBetween($startingDate, strtotime('+6 days'));

    return [
        'user_id' => App\Models\User::all()->random()->id,
        'company_name' => $faker->company,
        'business_location' => 'Lahore',
        'rating'=> $faker->numberBetween(1,5),
        'exit_date'=> $endingDate,
        'status'=> $faker->randomElement(['Pending' ,'Active', 'Verifying']),
    ];
});
