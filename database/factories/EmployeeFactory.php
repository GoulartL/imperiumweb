<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'company' => 1,
        'name' => $faker->name,
        'civil_state' => $faker->randomElement([1,2]),
        'vat' => $faker->numerify('###########'),
        'personal_id' => $faker->numerify('#######'),
        'sex' => $faker->randomElement([1,2]),
        'position' => $faker->randomElement(['Costureira 1','Tira fios 1', 'Etiqueta 1']),
        'sector' => 'Produção',
        'admission_date' => $faker->dateTime($max = 'now', $timezone = null),
        'resignation_date' => $faker->optional()->dateTime($max = 'now', $timezone = null),
        'phone_number_1' => preg_replace('/[^0-9]/','',$faker->e164PhoneNumber),
        'phone_number_2' => preg_replace('/[^0-9]/','',$faker->e164PhoneNumber),
        'observation' => $faker->text($maxNbChars = 200),
    ];
});
