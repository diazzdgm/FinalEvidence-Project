<?php

namespace Database\Factories;

use App\Models\Product; // Importar Product
use App\Models\User;    // Importar User
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
        $productIds = Product::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        $movementTypes = ['Entrada', 'Salida', 'Ajuste Positivo', 'Ajuste Negativo', 'Transferencia Entrada', 'Transferencia Salida', 'Devolución'];

        return [
            'Product_ID' => !empty($productIds) ? fake()->randomElement($productIds) : Product::factory(),
            'Movement_Type' =>  fake()->randomElement($movementTypes),
            'Quantity' => fake()->numberBetween(1, 100), // Cantidades más realistas para movimientos individuales
            'User_ID' => !empty($userIds) ? fake()->randomElement($userIds) : User::factory(),
        ];
    }
}
