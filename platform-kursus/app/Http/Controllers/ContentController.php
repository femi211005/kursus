<?php
namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentProgress;
use App\Models\Course;
use App\Notifications\ContentCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    // Halaman daftar konten berdasarkan peran user
    public function index(Request $request)
    {
        $user = Auth::user();

        $contents = match ($user->role) {
            'admin' => Content::with('course')->get(),
            'teacher' => Content::with('course')
                ->whereHas('course', fn($query) => $query->where('teacher_id', $user->id))
                ->get(),
            default => collect(), // Koleksi kosong untuk non-admin/non-teacher
        };

        return view('dashboard.contents.index', compact('contents'));
    }

    // Halaman form tambah konten
    public function create()
    {
        $user = Auth::user();

        $courses = match ($user->role) {
            'admin' => Course::all(),
            'teacher' => Course::where('teacher_id', $user->id)->get(),
            default => collect(),
        };

        return view('dashboard.contents.create', compact('courses'));
    }

    
    // Simpan konten baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:contents,title',
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'required|url',
            'body' => 'required|string',
        ]);

        $user = Auth::user();
        $course = Course::findOrFail($request->course_id);

        // Pastikan hanya guru yang bisa membuat konten untuk kursus mereka
        if ($user->role === 'teacher' && $course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        Content::create($request->only(['title', 'course_id', 'video_url', 'body']));

        return redirect()->route(Auth::user()->role . '.contents.index')->with('success', 'Content created successfully.');
    }

    // Halaman form edit konten
    public function edit(Content $content)
    {
        $user = Auth::user();

        // Pastikan hanya admin atau pengajar yang dapat mengedit konten mereka
        if ($user->role !== 'admin' && $content->course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $courses = $user->role === 'admin'
            ? Course::all()
            : Course::where('teacher_id', $user->id)->get();

        return view('dashboard.contents.edit', compact('content', 'courses'));
    }

    // Update konten
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:contents,title,' . $content->id,
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'required|url',
            'body' => 'required|string',
        ]);

        $user = Auth::user();

        // Pastikan hanya admin atau pengajar yang dapat mengedit konten mereka
        if ($user->role !== 'admin' && $content->course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $content->update($request->only(['title', 'course_id', 'video_url', 'body']));

        return redirect()->route(Auth::user()->role . '.contents.index')->with('success', 'Content updated successfully.');
    }

    // Hapus konten
    public function destroy(Content $content)
    {
        $user = Auth::user();

        // Pastikan hanya admin atau pengajar yang dapat menghapus konten mereka
        if ($user->role !== 'admin' && $content->course->teacher_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $content->delete();

        return redirect()->route(Auth::user()->role . '.contents.index')->with('success', 'Content deleted successfully.');
    }

    // Menampilkan konten berdasarkan kursus
    public function tampilClass(Request $request, Course $course)
    {
        $contents = Content::where('course_id', $course->id)->get();
        return view('content.index', compact('contents', 'course'));
    }
    
    // Menampilkan detail konten dan kemajuan user
    public function show(Content $content)
    {
        $user = Auth::user();
        
        // Mendapatkan kemajuan konten untuk user
        $progress = ContentProgress::where('student_id', $user->id)
                                ->where('content_id', $content->id)
                                ->first();

        // Mendapatkan konten sebelumnya dan berikutnya dalam kursus yang sama
        $previousContents = Content::where('course_id', $content->course_id)
                                    ->where('id', '<', $content->id)
                                    ->get();
        $nextContent = Content::where('course_id', $content->course_id)
                            ->where('id', '>', $content->id)
                            ->first();

        $prevContent = $previousContents->last(); // Mendapatkan konten sebelumnya yang terakhir

        // Mendapatkan daftar seluruh konten dalam kursus yang sama
        $courseContents = Content::where('course_id', $content->course_id)
                                ->with(['progress' => function ($query) use ($user) {
                                    $query->where('student_id', $user->id);
                                }])
                                ->get();

        // Menambahkan status aksesibilitas untuk setiap konten
        $isPreviousCompleted = true; // Konten pertama selalu bisa diakses
        foreach ($courseContents as $item) {
            $item->is_accessible = $isPreviousCompleted; // Tandai konten sebagai dapat diakses jika konten sebelumnya selesai
            $isPreviousCompleted = $item->progress && $item->progress->is_completed; // Update status untuk konten berikutnya
        }

        // Mendapatkan URL video untuk konten ini (jika ada)
        $videoUrl = $content->video_url; // Asumsikan `video_url` sudah ada dalam model `Content`

        return view('content.show', compact('content', 'progress', 'prevContent', 'nextContent', 'courseContents', 'videoUrl'));
    }

    // // Menandai konten sebagai selesai
    // public function markAsDone(Request $request, Content $content)
    // {
    //     $user = Auth::user();
    
    //     // Pastikan user terdaftar di kursus
    //     if (!$content->course->participants()->where('student_id', $user->id)->exists()) {
    //         abort(403, 'You are not enrolled in this course.');
    //     }
    
    //     // Simpan atau perbarui progress user
    //     ContentProgress::updateOrCreate(
    //         ['student_id' => $user->id, 'content_id' => $content->id],
    //         ['is_completed' => $request->input('is_completed', true)] // Default true
    //     );
    
    //     return back()->with('success', 'Content marked as completed.');
    // }


    public function markAsDone(Request $request, Content $content)
    {
        $user = Auth::user();
        
        // Cek apakah user sudah terdaftar di kursus
        if (!$content->course->participants()->where('student_id', $user->id)->exists()) {
            abort(403, 'You are not enrolled in this course.');
        }

        // Simpan atau perbarui progress user
        ContentProgress::updateOrCreate(
            ['student_id' => $user->id, 'content_id' => $content->id],
            ['is_completed' => true] // Tandai konten selesai
        );

        return back()->with('success', 'Content marked as completed.');
    }

    
}
