<?php

use Faker\Generator as Faker;
use Thtg88\ExistsWithoutSoftDeletedRule\Tests\TestClasses\Models\TestModel;
use Illuminate\Support\Str;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(TestModel::class, static function (Faker $faker) {
    return ['name' => $faker->name];
});
