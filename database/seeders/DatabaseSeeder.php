<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Semester;
use App\Models\TypeMatkul;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Seed semester table with values from 1 to 14
        for ($i = 1; $i <= 14; $i++) {
            Semester::create(['semester' => $i]);
        }

        // Seed typeMatkul table with default types
        $types = ['Wajib', 'Pilihan', 'Prasyarat'];
        foreach ($types as $type) {
            TypeMatkul::create(['sifat' => $type]);
        }
    }
}
