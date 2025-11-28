<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@platform.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $teacher1 = User::create([
            'name' => 'John Doe',
            'email' => 'teacher1@platform.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        $teacher2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'teacher2@platform.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'is_active' => true,
        ]);

        $student1 = User::create([
            'name' => 'Alice Johnson',
            'email' => 'student1@platform.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        $student2 = User::create([
            'name' => 'Bob Williams',
            'email' => 'student2@platform.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        // 2. Create Categories
        $webDev = Category::create([
            'name' => 'Web Development',
            'description' => 'Courses related to web development and programming',
        ]);

        $dataScience = Category::create([
            'name' => 'Data Science',
            'description' => 'Courses about data analysis and machine learning',
        ]);

        $design = Category::create([
            'name' => 'Design',
            'description' => 'UI/UX and graphic design courses',
        ]);

        // 3. Create Courses
        $course1 = Course::create([
            'title' => 'Laravel Web Development',
            'description' => 'Learn to build modern web applications with Laravel',
            'teacher_id' => $teacher1->id,
            'category_id' => $webDev->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
        ]);

        $course2 = Course::create([
            'title' => 'React.js Fundamentals',
            'description' => 'Master the basics of React.js and build interactive UIs',
            'teacher_id' => $teacher1->id,
            'category_id' => $webDev->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'is_active' => true,
        ]);

        $course3 = Course::create([
            'title' => 'Python for Data Science',
            'description' => 'Introduction to Python programming for data analysis',
            'teacher_id' => $teacher2->id,
            'category_id' => $dataScience->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(4),
            'is_active' => true,
        ]);

        $course4 = Course::create([
            'title' => 'UI/UX Design Principles',
            'description' => 'Learn the fundamentals of user interface and experience design',
            'teacher_id' => $teacher2->id,
            'category_id' => $design->id,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'is_active' => true,
        ]);

        // 4. Create Contents for Course 1
        Content::create([
            'course_id' => $course1->id,
            'title' => 'Introduction to Laravel',
            'content' => '<h2>Welcome to Laravel!</h2><p>Laravel is a powerful PHP framework...</p>',
            'order_index' => 1,
        ]);

        Content::create([
            'course_id' => $course1->id,
            'title' => 'Setting Up Your Environment',
            'content' => '<h2>Installation Guide</h2><p>Let\'s set up Laravel on your machine...</p>',
            'order_index' => 2,
        ]);

        Content::create([
            'course_id' => $course1->id,
            'title' => 'Routing and Controllers',
            'content' => '<h2>Understanding Routes</h2><p>Routes are the entry points to your application...</p>',
            'order_index' => 3,
        ]);

        // 5. Create Contents for Course 2
        Content::create([
            'course_id' => $course2->id,
            'title' => 'What is React?',
            'content' => '<h2>Introduction to React</h2><p>React is a JavaScript library for building user interfaces...</p>',
            'order_index' => 1,
        ]);

        Content::create([
            'course_id' => $course2->id,
            'title' => 'Components and Props',
            'content' => '<h2>Building Components</h2><p>Components let you split the UI into independent pieces...</p>',
            'order_index' => 2,
        ]);

        // 6. Create Enrollments
        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
        ]);

        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course1->id,
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course3->id,
        ]);
    }
}