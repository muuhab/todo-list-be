<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $completed = $this->faker->boolean;
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'completed' => $completed,
        ];
    }
}
