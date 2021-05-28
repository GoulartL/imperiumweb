<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'Company' => 1,
        'description' => "Teste de boleto",
        'client' => 1,
        'emission' => $faker->dateTime($max = 'now'),
        'portion' => 1,
        'due_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+4 months', $timezone = null),
        'value' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1500, $max = 12000),
        'payment_date' => NULL,
        'payment_value' => NULL,
        'species' => 1,
        'observation' => $faker->text($maxNbChars = 200)
    ];
});
