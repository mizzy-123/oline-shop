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
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'category_id' => mt_rand(1, 2),
            'harga' => rand(10, 100) * 100
        ];
    }
}
