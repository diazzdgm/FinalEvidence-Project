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
        $this->call([

            UserSeeder::class
        ]); 

        User::factory(2)->create();
        Warehouse::factory(5)->create();
        Category::factory(3)->create();
        Product::factory(30)->create();
        InventoryMovement::factory(15)->create();
        Customer::factory(15)->create();
        Role::factory(5)->create();
        Order::factory(15)->create();
    }
}
