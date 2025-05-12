<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generar nombres que suenen más a almacenes o centros de distribución
        $warehouseName = fake()->unique()->randomElement([
            'Almacén Central', 'Centro de Distribución Norte', 'Bodega Principal Sureste', 
            'Almacén ' . fake()->citySuffix . ' ' . fake()->streetName, 
            'Logística ' . fake()->lastName,
            'Depósito ' . fake()->colorName,
        ]);
        return [
            'Name' =>  $warehouseName,  
        ];
    }
}
