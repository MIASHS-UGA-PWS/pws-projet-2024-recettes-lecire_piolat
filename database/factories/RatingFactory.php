<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id, // Get a random user ID,
            'recipe_id' => \App\Models\Recipe::inRandomOrder()->first()->id, // Get a random recipe ID,
            'rating' => $this->faker->numberBetween($min = 1, $max = 5),
        ];
    }
}
