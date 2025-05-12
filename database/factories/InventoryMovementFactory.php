<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *@extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryMovement>
 */
class InventoryMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'Product_ID' => fake() -> numberBetween(1,30),
        'Movement_Type' =>  fake() -> text(50),
        'Quantity' => fake() -> numberBetween(0,999),
        'User_ID' => fake() -> numberBetween(1,2),
        ];
    }
}
