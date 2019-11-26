<?php declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use LeafCms\Blog\Models\Article;

/** @var Factory $factory */
$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
    ];
});
