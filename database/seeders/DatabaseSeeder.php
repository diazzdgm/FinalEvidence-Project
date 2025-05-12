<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\InventoryMovement;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear Roles primero (la factory crea roles adicionales, UserSeeder crea Admin y User si no existen)
        Role::factory(3)->create(); // Creamos 3 roles adicionales con la factory (ej. Editor, Viewer, Manager)

        // Llamar a UserSeeder que crea Admin, User y les asigna roles, y otros 5 usuarios con rol User.
        $this->call([
            UserSeeder::class,
        ]); 
        // Ya no necesitamos User::factory(2)->create(); aquí, UserSeeder se encarga.

        // Crear otros datos
        Warehouse::factory(5)->create();
        Category::factory(3)->create();
        
        // Asegurarse de que las factories de Product, Order, InventoryMovement
        // usen IDs válidos de las entidades creadas arriba.
        // Esto se maneja dentro de cada factory respectiva.
        Product::factory(30)->create();
        Customer::factory(15)->create();
        Order::factory(15)->create(); // Asegúrate que OrderFactory asigna Customer_ID y User_ID válidos
        InventoryMovement::factory(15)->create(); // Asegúrate que InventoryMovementFactory asigna Product_ID y User_ID válidos
    }
}
