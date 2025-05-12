<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role; // Importar el modelo Role

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // Crear roles comunes si no existen, o obtenerlos si ya existen
        $adminRole = Role::firstOrCreate(
            ['Name' => 'Admin'], 
            ['Description' => 'Administrator with all permissions']
        );
        $userRole = Role::firstOrCreate(
            ['Name' => 'User'], 
            ['Description' => 'Regular user with standard permissions']
        );

        // Crear usuario Admin y asignarle el rol de Admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password') // Cambia 'password' por una contraseña segura
            ]
        );
        $adminUser->roles()->syncWithoutDetaching([$adminRole->id]); // Sincroniza roles, añadiendo si no existe

        // Crear algunos usuarios de ejemplo con el rol 'User'
        User::factory(5)->create()->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole->id);
        });

        // Puedes eliminar la creación de usuarios extra en DatabaseSeeder.php si este seeder ya los cubre
        // User::factory(2)->create(); // Esta línea estaba en DatabaseSeeder.php
    }
}
