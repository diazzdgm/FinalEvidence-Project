<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
        'Status' =>  fake() -> text(50),
        'User_ID' => fake() -> numberBetween(1,2),
        'Customer_ID' => fake() -> numberBetween(1,15),
        ];
    }
}
