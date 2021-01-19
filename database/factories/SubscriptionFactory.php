<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {

    $startingDate = $faker->dateTimeBetween('this week', '+1 days');
    $endingDate   = $faker->dateTimeBetween($startingDate, strtotime('+6 days'));

    return [
        'user_id' => App\Models\User::all()->random()->id,
        'service_id' => App\Models\Service::all()->where('vendor_id', Null)->random()->id,
        'frequency'=>$faker->randomElement([1 , 30 , 360]),
        'charges'=>$faker->numberBetween(100,100000),
        'duration'=> rand(30, 365),
        'expiry'=>$endingDate,
        'status'=>rand(0,1),
    ];
});



 // $table->id();

 //            $table->unsignedBigInteger('user_id');
 //            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


 //            $table->unsignedBigInteger('service_id');
 //            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');


 //             $table->string('frequency');
 //             $table->string('charges');
 //             $table->timestamp('duration')->nullable();
 //             $table->timestamp('expiry')->nullable();
 //             $table->string('status');

 //            $table->timestamps();
