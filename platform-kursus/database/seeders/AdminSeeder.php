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
            'password' => Hash::make('admin123'), // Hash the password for security
            'role' => 'admin', // Assuming there's a 'role' field for identifying roles
            'profile_picture' => 'profile_pictures/defaultpp.jpg', // Assuming there's a 'profile_picture' field for storing the profile picture   
        ]);

                // Create the teacher user
        User::create([
            'name' => 'Alifsa Rezky Rahmah',
            'email' => 'lifsa@gmail.com',
            'password' => Hash::make('lifsa123'), // Hash the password for security
            'role' => 'teacher', // Assuming there's a 'role' field for identifying roles
            'profile_picture' => 'profile_pictures/defaultpp.jpg', // Assuming there's a 'profile_picture' field for storing the profile picture
        ]);

        // Create the student user
        User::create([
            'name' => 'Kezia Dewanti Ayu Putri Tappi',
            'email' => 'kezia@gmail.com',
            'password' => Hash::make('kezia123'), // Hash the password for security
            'role' => 'student', // Assuming there's a 'role' field for identifying roles
            'profile_picture' => 'profile_pictures/defaultpp.jpg', // Assuming there's a 'profile_picture' field for storing the profile picture
        ]);
    }
}
