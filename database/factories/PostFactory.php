<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'keywords' => $this->faker->realText($maxNbChars = 15, $indexSize = 2),
            'image' => $this->faker->imageUrl(360, 360, 'animals', true, 'dogs', true), 
            'image_size' => $this->faker->randomNumber(5, true), 
        ];
    }
}
