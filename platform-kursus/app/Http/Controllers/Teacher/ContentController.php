<?php
// app/Http/Controllers/Teacher/ContentController.php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:teacher']);
    }

    public function index(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $contents = $course->contents()->orderBy('order_index')->get();
        return view('teacher.contents.index', compact('course', 'contents'));
    }

    public function create(Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $maxOrder = $course->contents()->max('order_index') ?? 0;
        return view('teacher.contents.create', compact('course', 'maxOrder'));
    }

    public function store(Request $request, Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order_index' => 'required|integer|min:1',
        ]);

        Content::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'content' => $request->content,
            'order_index' => $request->order_index,
        ]);

        return redirect()->route('teacher.contents.index', $course)
            ->with('success', 'Content created successfully.');
    }

    public function edit(Course $course, Content $content)
    {
        if ($course->teacher_id !== auth()->id() || $content->course_id !== $course->id) {
            abort(403);
        }

        return view('teacher.contents.edit', compact('course', 'content'));
    }

    public function update(Request $request, Course $course, Content $content)
    {
        if ($course->teacher_id !== auth()->id() || $content->course_id !== $course->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order_index' => 'required|integer|min:1',
        ]);

        $content->update($request->all());

        return redirect()->route('teacher.contents.index', $course)
            ->with('success', 'Content updated successfully.');
    }

    public function destroy(Course $course, Content $content)
    {
        if ($course->teacher_id !== auth()->id() || $content->course_id !== $course->id) {
            abort(403);
        }

        $content->delete();

        return redirect()->route('teacher.contents.index', $course)
            ->with('success', 'Content deleted successfully.');
    }
}