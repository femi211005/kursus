<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        
        if ($user->isStudent()) {
            // Get enrolled courses with progress
            $enrolledCourses = $user->enrolledCourses()
                ->with(['teacher', 'contents'])
                ->get()
                ->map(function($course) use ($user) {
                    $totalContents = $course->contents->count();
                    $completedContents = $user->progress()
                        ->whereHas('content', function($q) use ($course) {
                            $q->where('course_id', $course->id);
                        })
                        ->where('is_completed', true)
                        ->count();
                    
                    $course->progress_percentage = $totalContents > 0 
                        ? ($completedContents / $totalContents) * 100 
                        : 0;
                    
                    return $course;
                });
            
            return view('profile.student', compact('user', 'enrolledCourses'));
        } 
        
        if ($user->isTeacher()) {
            // Get taught courses with student count
            $taughtCourses = $user->taughtCourses()
                ->withCount('students')
                ->with('category')
                ->get();
            
            return view('profile.teacher', compact('user', 'taughtCourses'));
        }
        
        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}