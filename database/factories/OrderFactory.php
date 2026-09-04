<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
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
        return [
            'code' => fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'customer_id' => \App\Models\Customer::factory(),
            'total' => fake()->randomFloat(2, 10, 1000),
            'status' => fake()->randomElement(['draft', 'confirmed', 'canceled']),
        ];
    }
}
