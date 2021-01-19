<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use Faker\Generator as Faker;
use App\Models\Vendor;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'vendor_id' => $faker->randomElement([Vendor::all()->random()->id, null]),
        'title' => $faker->jobTitle,
        'description'=> $faker->realText($maxNbChars = 255, $indexSize = 2),
        'service_image' => $faker->image('public/storage/images/service-images',640,480, null, false),
        'charges' => $faker->numberBetween(100,1000),
        'frequency'=>$faker->randomElement([1 , 30 , 180, 360]),
        'requirements'=>$faker->realText($maxNbChars = 100, $indexSize = 2),
        'status'=> $faker->randomElement(['Active', 'Inactive']),
    ];
});
