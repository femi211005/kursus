<?php
// app/Http/Controllers/EnrollmentController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:student']);
    }

    public function store(Course $course)
    {
        // Check if already enrolled
        if ($course->isEnrolledBy(auth()->id())) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'student_id' => auth()->id(),
            'course_id' => $course->id,
        ]);

        return back()->with('success', 'Successfully enrolled in the course!');
    }

    public function destroy(Course $course)
    {
        $enrollment = Enrollment::where('student_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if ($enrollment) {
            $enrollment->delete();
            return back()->with('success', 'You have unenrolled from this course.');
        }

        return back()->with('error', 'You are not enrolled in this course.');
    }
}