<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use App\Models\Service;
use App\Models\Employee;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $startingDate = $faker->dateTimeBetween('this week', '+1 days');
    $endingDate   = $faker->dateTimeBetween($startingDate, strtotime('+6 days'));
    
    

    return [
         'user_id' => User::all()->random()->id,
         'service_id' => Service::all()->random()->id,
         'employee_id' => $faker->randomElement([Employee::all()->random()->id, Null]),
          'budget' => $faker->numberBetween(100,10000),
          'status'=> $faker->randomElement(['Pending' ,'In Progress', 'Completed', 'Canceled']),
          'deadline'=>$endingDate ,
          'start_date'=>$startingDate,
          'finish_date'=>$endingDate ,
          'rating'=>$faker->numberBetween(1,5),
          'feedback_message'=>$faker->text,
    ];
});
