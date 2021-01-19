<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {

    $startDate   = $faker->dateTimeBetween(strtotime('+1 days'), strtotime('+2 days'));
    $endingDate   = $faker->dateTimeBetween($startDate, strtotime('+100 days'));

    return [
           	'user_id' => App\Models\User::all()->random()->id,
            'exit_date'=> $endingDate,
            'rating'=> $faker->numberBetween(1,5),
            'salary'=> $faker->numberBetween(10000,500000),
            'status'=> 'Pending',

    ];
});
