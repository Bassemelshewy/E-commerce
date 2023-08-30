<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user=User::inRandomOrder()->first();
        $product=Product::inRandomOrder()->first();
        if(!$user)
        {
            $user=User::factory()->create();
        }
        return [
            'price'=>fake()->numberBetween(10,1000),
            'quantity'=>fake()->numberBetween(10,100),
            'product_id'=>$product->id,
            'user_id'=>$user->id,
        ];
    }
}
