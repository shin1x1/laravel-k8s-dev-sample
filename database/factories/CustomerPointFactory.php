<?php
declare(strict_types=1);

use App\Eloquents\EloquentCustomerPoint;

$factory->define(EloquentCustomerPoint::class, function () {
    return [
        'point' => 0,
    ];
});
