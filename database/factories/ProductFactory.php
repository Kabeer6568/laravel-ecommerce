<?php

namespace Database\Factories;
use Illuminate\Support\Str;

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
        $name = fake()->words(3,true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => fake()->randomFloat(10,99),
            'description' => fake()->paragraph(),
            'image' =>'picsum.photos?random=' . fake()->unique()->numberBetween(1,1000),
            'is_featured' => fake()->boolean(20),

        ];
    }
}
