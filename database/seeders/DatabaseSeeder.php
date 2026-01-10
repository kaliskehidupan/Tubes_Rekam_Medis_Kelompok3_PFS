<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Menggunakan Hash lebih disarankan daripada bcrypt()
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Opsional: Hapus user lama agar tidak duplikat saat dijalankan ulang
        // User::truncate();

        // Create Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@app.com',
            'password' => Hash::make('password'), // Lebih aman dan standar Laravel modern
            'role' => 'superadmin',
        ]);

        // Create Regular User (Orang 1 & 2)
        User::create([
            'name' => 'Regular User',
            'email' => 'user@app.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
