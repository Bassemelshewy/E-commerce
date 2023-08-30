<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
            'product_name'=>fake()->name(),
            'product_price'=>fake()->numberBetween(100,1000),
            'product_availability'=>'available',
            'product_image'=>fake()->image(),
            'category_id'=>Category::inRandomOrder()->first()->id,
        ];
    }
}
