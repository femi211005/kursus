<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->coursesAsTeacher()->with('category')->paginate(10);
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
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);

        auth()->user()->coursesAsTeacher()->create(array_merge($request->all(), ['is_active' => true]));

        return redirect()->route('teacher.courses.index')->with('success', 'Course berhasil dibuat');
    }

    public function edit(Course $course)
    {
        if ($course->teacher_id != auth()->id()) abort(403);
        $categories = Category::all();
        return view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id != auth()->id()) abort(403);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'required|boolean',
        ]);

        $course->update($request->all());
        return redirect()->route('teacher.courses.index')->with('success', 'Course berhasil diperbarui');
    }

    public function destroy(Course $course)
    {
        if ($course->teacher_id != auth()->id()) abort(403);
        $course->delete();
        return redirect()->route('teacher.courses.index')->with('success', 'Course dihapus');
    }
}
