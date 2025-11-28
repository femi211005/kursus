<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\ContentController as TeacherContentController;
use App\Http\Controllers\Student\LessonController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [HomeController::class, 'catalog'])->name('courses.catalog');
Route::get('/courses/{course}', [HomeController::class, 'show'])->name('courses.show');

// Auth Routes (dari Breeze)
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard - redirect based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.users.index');
        } elseif ($user->isTeacher()) {
            return redirect()->route('teacher.courses.index');
        } else {
            return redirect()->route('profile.show');
        }
    })->name('dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])
        ->name('courses.enroll');
    Route::delete('/courses/{course}/unenroll', [EnrollmentController::class, 'destroy'])
        ->name('courses.unenroll');
    
    Route::get('/courses/{course}/lessons/{content}', [LessonController::class, 'show'])
        ->name('lessons.show');
    Route::post('/courses/{course}/lessons/{content}/complete', [LessonController::class, 'markAsCompleted'])
        ->name('lessons.complete');
});

// Teacher Routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('courses', TeacherCourseController::class);
    Route::get('courses/{course}/contents', [TeacherContentController::class, 'index'])
        ->name('contents.index');
    Route::get('courses/{course}/contents/create', [TeacherContentController::class, 'create'])
        ->name('contents.create');
    Route::post('courses/{course}/contents', [TeacherContentController::class, 'store'])
        ->name('contents.store');
    Route::get('courses/{course}/contents/{content}/edit', [TeacherContentController::class, 'edit'])
        ->name('contents.edit');
    Route::put('courses/{course}/contents/{content}', [TeacherContentController::class, 'update'])
        ->name('contents.update');
    Route::delete('courses/{course}/contents/{content}', [TeacherContentController::class, 'destroy'])
        ->name('contents.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('courses', AdminCourseController::class);
});