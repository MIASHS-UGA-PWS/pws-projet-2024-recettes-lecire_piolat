<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($this->faker));
        $title = $this->faker->numerify($this->faker->foodName());
        return [
         'user_id' => User::inRandomOrder()->first()->id, // Get a random user ID,
         'title' => $title,
         'content' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
         'price' => $this->faker->words($nb = 1, $asText = true),
         'url' => str_replace(' ', '-', $title),
         'status' => 'published',
        ];
    }
}
