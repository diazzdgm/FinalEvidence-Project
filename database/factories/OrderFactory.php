<?php

namespace Database\Factories;

use App\Models\Customer; // Importar Customer
use App\Models\User;    // Importar User
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
        $userIds = User::pluck('id')->toArray();
        $customerIds = Customer::pluck('id')->toArray();

        $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled', 'Refunded'];

        return [
            'Status' => fake()->randomElement($statuses),
            'User_ID' => !empty($userIds) ? fake()->randomElement($userIds) : User::factory(),
            'Customer_ID' => !empty($customerIds) ? fake()->randomElement($customerIds) : Customer::factory(),
            // Corregido para coincidir con el nombre de la columna en la migración
            'label_path' => null, 
        ];
    }
}
