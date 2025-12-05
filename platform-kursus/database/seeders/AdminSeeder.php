<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), 
            'role' => 'admin', 
        ]);

        User::create([
            'name' => 'Femilia Padaunan',
            'email' => 'femi@gmail.com',
            'password' => Hash::make('femi123'), 
            'role' => 'teacher', 
        ]);

        User::create([
            'name' => 'Andra Rombe',
            'email' => 'andra@gmail.com',
            'password' => Hash::make('andra123'), 
            'role' => 'student', 
        ]);
    }
}
