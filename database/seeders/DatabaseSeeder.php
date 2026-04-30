<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // Crear usuario
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        // Crear rol
        $role = Role::create([
            'name' => 'Desarrollador',
            'guard_name' => 'web',
        ]);

        

        // Asignar rol al usuario
        $user->assignRole('Desarrollador');
        $user->assignRole($role);
    }
}
