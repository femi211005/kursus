<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'category')->where('is_active', true)->paginate(10);
        return view('student.courses.index', compact('courses'));
    }

    public function enroll(Course $course)
    {
        if (!auth()->user()->courses()->where('course_id', $course->id)->exists()) {
            auth()->user()->courses()->attach($course->id, ['progress' => 0]);
        }
        return redirect()->back()->with('success', 'Berhasil mendaftar course');
    }

    public function profile()
    {
        $user = auth()->user();
        $courses = $user->courses()->with('teacher')->get();
        return view('student.profile', compact('user', 'courses'));
    }

    public function show(Course $course)
    {
        if (!auth()->user()->courses()->where('course_id', $course->id)->exists()) {
            abort(403);
        }
        $contents = $course->contents()->get();
        return view('student.courses.show', compact('course', 'contents'));
    }
}
