<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Usar unique() para evitar nombres de categorías duplicados si se crean muchas
        // y randomElement para seleccionar de una lista predefinida o generar palabras clave.
        $categoryName = fake()->unique()->randomElement([
            'Electrónicos', 'Ropa', 'Hogar y Cocina', 'Deportes', 'Libros', 
            'Juguetes', 'Belleza', 'Automotriz', 'Alimentos', 'Mascotas',
            'Oficina', 'Industrial', 'Herramientas', 'Jardín', 'Software'
        ]);
        // Alternativamente, para más variedad:
        // $categoryName = ucfirst(fake()->words(rand(1,2), true)); 

        return [
            'Name' =>  $categoryName,
        ];
    }
}
