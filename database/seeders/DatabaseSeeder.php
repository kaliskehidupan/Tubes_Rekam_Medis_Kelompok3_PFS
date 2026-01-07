<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@app.com',
            'password' => bcrypt('password'), // password
            'role' => 'superadmin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@app.com',
            'password' => bcrypt('password'), // password
            'role' => 'user',
        ]);
    }
}
