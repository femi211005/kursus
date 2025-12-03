<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Content;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Models\Course;

// Rute halaman welcome (wel2.blade.php)
Route::get('/', function () {
    return view('wel2');
})->name('welcome');

Route::get('/', [CourseController::class, 'wel'])->name('welcome');


// Rute halaman class.blade.php
Route::get('/class', [CourseController::class, 'home'])->name('class');

// Rute halaman content/index.blade.php
Route::get('/courses/{course}/contents', [ContentController::class, 'tampilClass'])->name('contents.index');


// Route::get('courses/contents/{content}', [ContentController::class, 'show'])
//     ->middleware('auth')
//     ->name('contents.show');


// Rute yang memerlukan autentikasi
// Route di web.php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CourseController::class, 'wel'])->middleware('verified')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Route untuk menghapus foto profil
    Route::delete('/profile/delete-picture', [ProfileController::class, 'deletePicture'])->name('profile.delete-picture');
});



Route::get('/content/{content}', [ContentController::class, 'show'])
    ->middleware('auth')
    ->name('content.show');

Route::post('/contents/{content}/complete', [ContentController::class, 'markAsDone'])->name('content.complete');
Route::get('/generate-certificate/{courseId}', [CertificateController::class, 'generate'])->name('certificate.generate');


// Route::post('/course/{course}/enroll', [CourseController::class, 'enrollInCourse'])->name('course.enroll');

Route::post('/course/enroll/{id}', [CourseController::class, 'enroll'])->name('course.enroll');

require __DIR__ . '/auth.php';

