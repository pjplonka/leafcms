<?php declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use LeafCms\Blog\Models\Category;

/** @var Factory $factory */
$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
