<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Thtg88\LaravelExistsWithoutSoftDeletedRule\Tests\TestClasses\Models\TestModel;
use Illuminate\Support\Str;

$factory->define(TestModel::class, static function (Faker $faker) {
    return ['name' => $faker->name];
});
