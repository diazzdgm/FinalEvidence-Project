<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *@extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        'Name' =>  fake() -> word(),  
        'Description' =>  fake() -> text(50),
        'Unit_Price' => fake () -> randomFloat(2, 1, 100),
        'Stock' => fake() -> numberBetween(0,999),
        'Warehouse' => fake() -> numberBetween(1,5),
        'Category_ID' => fake() -> numberBetween(1,3),

        ];
    }
}
