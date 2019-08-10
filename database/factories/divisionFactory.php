<?php
/* @var $factory \Illuminate\Database\Eloquent\Factory */
use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Division::class, function (Faker $faker) {
    return [
        'division_name' => $faker->name,
        'division_phone' => $faker->e164PhoneNumber,
        'manager_name' => $faker->name,
    ];
});
