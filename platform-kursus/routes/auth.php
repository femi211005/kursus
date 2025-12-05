<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProgressController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    
    Route::post('/update-role', [UserController::class, 'updateRole'])->name('update.role');
    

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('home', [AdminController::class, 'isAdmin'])->name('home');
        Route::resource('user', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('contents', ContentController::class);
        Route::get('myClass', [CourseController::class, 'myClass'])->name('myClass');
    });
    
    Route::prefix('teacher')->name('teacher.')->middleware('role:teacher')->group(function () {
        Route::get('home', [AdminController::class, 'isTeacher'])->name('home');
        Route::resource('courses', CourseController::class);
        Route::resource('contents', ContentController::class);
        Route::get('myClass', [CourseController::class, 'myClass'])->name('myClass');
        Route::post('myClass', [CourseController::class, 'myClass'])->name('myClass.post');
        Route::get('/teacher/courses/{courseId}/progress', [TeacherController::class, 'showStudentProgress'])
        ->name('courses.progress');

    });
    
    Route::prefix('student')->name('student.')->middleware('role:student')->group(function () {
        Route::get('home', [AdminController::class, 'isStudent'])->name('home');
        Route::get('myClass', [CourseController::class, 'myClass'])->name('myClass');
        Route::post('myClass', [CourseController::class, 'myClass'])->name('myClass.post');


        // Route::get('/certificate/download/{course}', [CertificateController::class, 'download'])->name('certificate.download');

    });

    Route::get('/course/{course_id}/forum', [ForumController::class, 'index'])->middleware('canAccessForum')->name('forum.index');
    Route::post('/course/{course_id}/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/course/{course_id}/forum/{parent_id?}', [ForumController::class, 'store'])->name('forum.store');


    
});
