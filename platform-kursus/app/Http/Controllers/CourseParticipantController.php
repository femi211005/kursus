<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher', 'category')->get();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with('teacher', 'category')->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.create', compact('categories', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.edit', compact('course', 'categories', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
