<?php
// app/Http/Controllers/Teacher/CourseController.php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:teacher']);
    }

    public function index()
    {
        $courses = Course::where('teacher_id', auth()->id())
            ->with('category')
            ->withCount('students')
            ->paginate(15);
        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('teacher.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => auth()->id(),
            'category_id' => $request->category_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => true,
        ]);

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $course->load(['contents', 'students']);
        return view('teacher.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $course->update($data);

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}