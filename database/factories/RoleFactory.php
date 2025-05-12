<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Usar unique() para evitar nombres de roles duplicados si se crean muchos
        // y randomElement para seleccionar de una lista predefinida.
        // Para asegurar que siempre tengamos 'Admin' y 'User', los crearemos explícitamente en el Seeder.
        // Esta factory puede usarse para crear otros roles adicionales si es necesario.
        $roleName = fake()->unique()->randomElement(['Editor', 'Viewer', 'Support', 'Manager', 'Contributor']);
        return [
            'Name' => $roleName,
            'Description' => fake()->sentence(rand(5,10)) // Descripción un poco más larga
        ];
    }
}
