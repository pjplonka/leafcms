<?php declare(strict_types=1);

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use LeafCms\FileCenter\Models\Image;

/** @var Factory $factory */
$factory->define(Image::class, function (Faker $faker) {
    return [
        'path'      => $faker->word,
        'filename'  => $faker->slug,
        'extension' => ['jpeg', 'jpg', 'png', 'gif'][random_int(0, 3)],
    ];
});
