<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Basic Programming',
        ]);
        Category::create([
            'name' => 'Web Development',
        ]);
        Category::create([
            'name' => 'Database and Backend Development',
        ]);
        Category::create([
            'name' => 'Mobile Development',
        ]);
        Category::create([
            'name' => 'Data Science',
        ]);
    }
}
