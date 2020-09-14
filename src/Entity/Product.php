<?php

declare(strict_types=1);

namespace App\Entity;

use Exception;
use Faker\Factory;

class Product
{
    /**
     * @throws Exception
     */
    public static function getRandomProduct(): array
    {
        $faker = Factory::create();

        return [
            'title' => $faker->text(30),
            'text' => $faker->text(150),
            'image' => self::getRandomImage(),
        ];
    }

    /**
     * @return string
     * @throws Exception
     */
    private static function getRandomImage(): string
    {
        $imageNumber = \random_int(0, 5);
        if ($imageNumber === 0) {
            return 'images/no-photo.svg';
        }

        return "images/sample_$imageNumber.jpg";
    }
}
