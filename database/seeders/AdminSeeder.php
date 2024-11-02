<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@almaata.ac.id'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('almaata2020'),
                'role' => 'admin'
            ]
        );
    }
}
