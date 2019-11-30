<?php
declare(strict_types=1);

use App\Eloquents\EloquentCustomer;
use Faker\Generator as Faker;

$factory->define(EloquentCustomer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
