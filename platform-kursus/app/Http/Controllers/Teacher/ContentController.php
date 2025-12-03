<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::whereHas('course', function($q) {
            $q->where('teacher_id', auth()->id());
        })->paginate(10);

        return view('teacher.contents.index', compact('contents'));
    }

    public function create()
    {
        $courses = auth()->user()->coursesAsTeacher()->get();
        return view('teacher.contents.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required',
            'content'   => 'required',
            'order'     => 'required|integer',
        ]);

        $course = Course::findOrFail($request->course_id);
        if ($course->teacher_id != auth()->id()) abort(403);

        Content::create($request->all());
        return redirect()->route('teacher.contents.index')->with('success', 'Materi berhasil dibuat');
    }

    public function edit(Content $content)
    {
        if ($content->course->teacher_id != auth()->id()) abort(403);
        $courses = auth()->user()->coursesAsTeacher()->get();
        return view('teacher.contents.edit', compact('content', 'courses'));
    }

    public function update(Request $request, Content $content)
    {
        if ($content->course->teacher_id != auth()->id()) abort(403);

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required',
            'content'   => 'required',
            'order'     => 'required|integer',
        ]);

        $content->update($request->all());
        return redirect()->route('teacher.contents.index')->with('success', 'Materi berhasil diperbarui');
    }

    public function destroy(Content $content)
    {
        if ($content->course->teacher_id != auth()->id()) abort(403);
        $content->delete();
        return redirect()->route('teacher.contents.index')->with('success', 'Materi dihapus');
    }
}
