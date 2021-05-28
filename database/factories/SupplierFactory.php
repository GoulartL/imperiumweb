<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'Company' => 1,
        'taxvat' => $faker->numerify('##############'),
        'type' => 1,
        'state_register_id' => $faker->numerify('##############'),
        'name' => $faker->name,
        'fantasy_name' => $faker->name,
        'address' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'district' => $faker->citySuffix,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'complement' => '',
        'zip_code' => $faker->randomNumber(8),
        'contact_name' => $faker->name,
        'phone_number_1' => preg_replace('/[^0-9]/','',$faker->e164PhoneNumber),
        'phone_number_2' => preg_replace('/[^0-9]/','',$faker->e164PhoneNumber),
        'email_1' => $faker->unique()->safeEmail,
        'email_2' => $faker->unique()->safeEmail,
        'bank' => 'BANCO DO BRASIL',
        'agency' => $faker->randomNumber(4),
        'account' => $faker->randomNumber(5),
        'account_name' => $faker->name,
        'observation' => $faker->text($maxNbChars = 200),
    ];
});
