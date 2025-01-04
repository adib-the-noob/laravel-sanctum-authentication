<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->words(3, true),  // Generates a 3-word product name
            "price" => fake()->numberBetween(100, 1300),  // Random price between 100 and 1300
            "description" => fake()->paragraph(1),  // 1-paragraph description
            "slug" => fake()->slug(),
        ];
    }
}
