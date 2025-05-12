<?php

namespace Database\Factories;

use App\Models\Category; // Importar Category
use App\Models\Warehouse; // Importar Warehouse
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
        // Obtener IDs existentes para Warehouse y Category
        // Es importante que los seeders de Warehouse y Category se ejecuten ANTES que el de Product
        $warehouseIds = Warehouse::pluck('id')->toArray();
        $categoryIds = Category::pluck('id')->toArray();

        return [
            'Name' => ucfirst(fake()->words(rand(2,4), true)), // Nombres de producto más descriptivos  
            'Description' => fake()->sentence(rand(10, 20)), // Descripciones más largas
            'Unit_Price' => fake()->randomFloat(2, 5, 500), // Rango de precios más amplio
            'Stock' => fake()->numberBetween(0, 200),
            'Warehouse' => !empty($warehouseIds) ? fake()->randomElement($warehouseIds) : Warehouse::factory(), // Asigna un Warehouse existente o crea uno si no hay
            'Category_ID' => !empty($categoryIds) ? fake()->randomElement($categoryIds) : Category::factory(), // Asigna una Category existente o crea una si no hay
        ];
    }
}
