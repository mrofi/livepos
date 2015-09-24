<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(livepos\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(livepos\ProductBrand::class, function(Faker\Generator $faker) {
	return [
		'brand' => $faker->unique()->lastName,
		'created_by' => '1',
		'updated_by' => '1',
	];
});

$factory->define(livepos\Supplier::class, function(Faker\Generator $faker) {
	return [
		'supplier' => $faker->unique()->company,
		'created_by' => '1',
		'updated_by' => '1',
	];
});

