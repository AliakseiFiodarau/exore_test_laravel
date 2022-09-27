<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'category_id' => rand(1,8),
            'posted_by' => rand(2,3)
        ];
    }
}
