<?php
namespace App\Http\Controllers;

use App\Events\CourseUpdated;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Notifications\CourseUpdateNotification;
use App\Notifications\GlobalMessageNotification;
use App\Notifications\UpdateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class CourseController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil data kursus berdasarkan role
        $statusFilter = $request->query('status', 'all'); // Default: tampilkan semua kursus
    
        // Query kursus langsung berdasarkan role dan filter status
        $courses = Course::when($user->role === 'teacher' || $user->role === 'admin', function ($query) use ($user) {
            // Untuk admin, tampilkan semua kursus, untuk teacher hanya kursus yang dia ajar
            if ($user->role === 'teacher') {
                $query->where('teacher_id', $user->id);
            }
        })
        ->when($statusFilter === 'ongoing', function ($query) {
            // Kursus yang sedang berlangsung: end_date setelah akhir hari ini
            $query->whereNotNull('end_date')
                  ->where('end_date', '>', now()->endOfDay());
        })
        ->when($statusFilter === 'expired', function ($query) {
            // Kursus yang sudah selesai: end_date hingga akhir hari ini
            $query->whereNotNull('end_date')
                  ->where('end_date', '<=', now()->endOfDay());
        })
        ->with(['participants', 'contents', 'participants.contentProgress'])
        ->get();
    
        // Loop untuk menghitung progres per peserta di setiap kursus
        foreach ($courses as $course) {
            foreach ($course->participants as $participant) {
                // Ambil ID konten yang termasuk dalam kursus ini
                $courseContentIds = $course->contents->pluck('id');
    
                // Ambil ID konten yang telah diselesaikan oleh peserta (unik)
                $completedContentIds = $participant->contentProgress
                    ->where('is_completed', true)
                    ->whereIn('content_id', $courseContentIds) // Pastikan hanya konten milik kursus
                    ->pluck('content_id')
                    ->unique();
    
                // Menghitung total konten dalam kursus
                $totalContent = $courseContentIds->count();
    
                // Menghitung jumlah konten yang sudah diselesaikan
                $completedCount = $completedContentIds->count();
    
                // Debugging: Tampilkan nilai untuk analisis
                Log::debug("Course ID: {$course->id}, Participant ID: {$participant->id}, Total Content: {$totalContent}, Completed Count: {$completedCount}");
    
                // Menghitung persentase progres
                $progressPercentage = $totalContent > 0 ? ($completedCount / $totalContent) * 100 : 0;
    
                // Simpan progres ke peserta
                $participant->progressPercentage = round(min($progressPercentage, 100), 2); // Tidak lebih dari 100%
            }
        }
    
        return view('dashboard.courses.index', compact('courses', 'statusFilter'));
    }
    
    
    
    

    public function show($courseId)
    {
        $course = Course::with(['participants', 'contents', 'participants.contentProgress'])->find($courseId);
    
        // Untuk setiap peserta, hitung progress mereka
        foreach ($course->participants as $participant) {
            $completedContent = $participant->contentProgress->where('is_completed', true);
            $totalContent = $course->contents->count();
            $completedCount = $completedContent->count();
            $completionPercentage = $totalContent ? ($completedCount / $totalContent) * 100 : 0;
    
            $participant->progress = $completionPercentage; // Menyimpan progress
        }
    
        return view('course.show', compact('course'));
    }
    

    public function create()
    {
        $user = Auth::user();
        $categories = Category::all(); // Mendapatkan semua kategori

        if ($user->role == 'admin') {
            $teachers = User::where('role', 'teacher')->get(); // Hanya untuk admin
            return view('dashboard.courses.create', compact('categories', 'teachers'));
        }

        return view('dashboard.courses.create', compact('categories')); // Untuk teacher
    }

    public function store(Request $request)
    {
        $user = Auth::user();
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'course_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'end_date' => 'required|date|after_or_equal:today', // Validasi agar end_date >= hari ini
        ]);
    
        // Gunakan foto default jika tidak ada foto yang diupload
        $photoPath = 'course_pictures/defaultcourse.jpg';
    
        if ($request->hasFile('course_picture')) {
            $photoPath = $request->file('course_picture')->store('course_pictures', 'public');
        }
    
        // Tentukan teacher_id
        $teacherId = $user->role == 'admin' ? $request->teacher_id : $user->id;
    
        // Buat course baru
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'teacher_id' => $teacherId,
            'course_picture' => $photoPath,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route($user->role . '.courses.index')->with('success', 'Course created successfully');
    }
    
    public function edit(Course $course)
    {
        $categories = Category::all(); // Mendapatkan semua kategori
        $teachers = User::where('role', 'teacher')->get(); // Mendapatkan semua teacher

        return view('dashboard.courses.edit', compact('course', 'categories', 'teachers'));
    }

    // public function update(Request $request, Course $course)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'course_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //         'end_date' => 'required|date|after_or_equal:created_at',
    //     ]);
    
    //     if ($request->has('delete_photo') && $course->course_picture !== 'course_pictures/defaultcourse.jpg') {
    //         Storage::disk('public')->delete($course->course_picture);
    //         $course->course_picture = 'course_pictures/defaultcourse.jpg';
    //     }
    
    //     if ($request->hasFile('course_picture')) {
    //         if ($course->course_picture !== 'course_pictures/defaultcourse.jpg') {
    //             Storage::disk('public')->delete($course->course_picture);
    //         }
    //         $course->course_picture = $request->file('course_picture')->store('course_pictures', 'public');
    //     }
    
    //     $course->update([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'category_id' => $request->category_id,
    //         'course_picture' => $course->course_picture,
    //         'end_date' => $request->end_date,
    //     ]);
    
    //     return redirect()->route(Auth::user()->role.'.courses.index')->with('success', 'Course updated successfully');
    // }


    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'course_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'end_date' => 'required|date|after_or_equal:created_at',
        ]);
    
        // Hapus foto kursus jika dihapus oleh pengguna
        if ($request->has('delete_photo') && $course->course_picture !== 'course_pictures/defaultcourse.jpg') {
            Storage::disk('public')->delete($course->course_picture);
            $course->course_picture = 'course_pictures/defaultcourse.jpg';
        }
    
        // Proses upload foto baru jika ada
        if ($request->hasFile('course_picture')) {
            if ($course->course_picture !== 'course_pictures/defaultcourse.jpg') {
                Storage::disk('public')->delete($course->course_picture);
            }
            $course->course_picture = $request->file('course_picture')->store('course_pictures', 'public');
        }
    
        // Perbarui data kursus
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'course_picture' => $course->course_picture,
            'end_date' => $request->end_date,
        ]);

    
        // Redirect dengan pesan sukses
        return redirect()->route(Auth::user()->role.'.courses.index')->with('success', 'Course updated successfully');
    }


    public function destroy(Course $course)
    {
        // Hapus foto kursus jika bukan gambar default
        if ($course->course_picture !== 'course_pictures/defaultcourse.jpg') {
            Storage::disk('public')->delete($course->course_picture);
        }
    
        // Hapus course
        $course->delete();
    
        return redirect()->route(Auth::user()->role . '.courses.index')->with('success', 'Course deleted successfully');
    }



    public function home(Request $request)
    {
        // Ambil input pencarian dan kategori
        $search = $request->input('search');
        $category = $request->input('category');
    
        // Query awal: hanya kursus yang memiliki konten dan belum melewati end_date
        $query = Course::whereHas('contents') // Hanya kursus dengan konten
            ->with('contents', 'teacher', 'category') // Load relasi
            ->withCount('contents') // Hitung jumlah konten
            ->where(function ($query) {
                $query->whereNull('end_date') // Kursus tanpa end_date
                    ->orWhere('end_date', '>=', now()); // Kursus dengan end_date >= sekarang
            });
    
        // Filter berdasarkan kategori
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        }
    
        // Filter berdasarkan pencarian judul
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
    
        // Eksekusi query
        $courses = $query->get();
    
        // Ambil semua kategori untuk dropdown
        $categories = Category::all();
    
        // Kirim data ke view
        return view('class', compact('courses', 'categories', 'search', 'category'));
    }
    

    

    // public function enrollInCourse(Course $course)
    // {
    //     $user = Auth::user();
        
    //     // Cek apakah pengguna sudah terdaftar di kursus ini
    //     if (!$user->courseParticipants()->where('course_id', $course->id)->exists()) {
    //         // Increment the participant count for the course
    //         $course->increment('participants_count');
        
    //         // Attach the user to the course participants pivot table
    //         $user->courseParticipants()->attach($course);

    //         // Membuat entri untuk progres konten kursus (statusnya belum selesai)
    //         foreach ($course->contents as $content) {
    //             $user->contentparticipants()->create([
    //                 'content_id' => $content->id,
    //                 'is_completed' => false, // Initially, the user hasn't completed any content
    //             ]);
    //         }

    //         return redirect()->route(Auth::user()->role . '.myClass')->with('success', 'You have successfully enrolled in the course!');
    //     }

    //     return redirect()->route(Auth::user()->role . '.myClass')->with('info', 'You are already enrolled in this course.');
    // }

    public function enroll($id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($id);
        
        // Prevent the teacher from enrolling in their own course
        if ($user->role === 'teacher' && $course->teacher_id === $user->id) {
            // Redirect to the course contents page with error message
            return redirect()->route('contents.index' ,['course' => $course->id])->with('error', 'You cannot enroll in your own course.');
        }
        elseif ($user->role === 'admin') {
            // Redirect to the course contents page with error message
            return redirect()->route('contents.index' ,['course' => $course->id])->with('error', 'You cannot enroll becaouse you are admin.');
        }
        
        // Check if the user is already enrolled
        if (!$user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            // Attach the course to the user
            $user->enrolledCourses()->attach($course->id);
            
            // Increment participants_count for the course
            $course->increment('participants_count');
        }
    
        // Redirect to the appropriate page with success message
        return redirect()->route(Auth::user()->role . '.myClass')
                         ->with('success', 'You have successfully enrolled in the course.');
    }
    
    
    public function myClass()
    {
        $user = Auth::user(); // Current logged-in user
        $enrolledCourses = $user->enrolledCourses()->with('contents')->get();
    
        foreach ($enrolledCourses as $course) {
            $totalContents = $course->contents->count(); // Count of contents in the course
            $completedContents = $course->contents->filter(function ($content) use ($user) {
                return $user->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
            })->count(); // Count of completed contents
    
            // Calculate progress as percentage
            $progressPercentage = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;
    
            // Store progress for use in the view
            $course->progressPercentage = round($progressPercentage, 2); // Round the percentage
        }
    
        return view('dashboard.myClass', compact('enrolledCourses'));
    }

    // public function myClass()
    // {
    //     $user = Auth::user();
    //     $enrolledCourses = $user->enrolledCourses()->with('contents')->get();

    //     foreach ($enrolledCourses as $course) {
    //         $totalContents = $course->contents->count();
    //         $completedContents = $course->contents->filter(function ($content) use ($user) {
    //             return $user->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
    //         })->count();

    //         $progressPercentage = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;

    //         $course->progressPercentage = round($progressPercentage, 2);
    //         $course->canDownloadCertificate = $course->progressPercentage === 100; // Sertifikat hanya bisa diunduh jika progress 100%
    //     }

    //     return view('dashboard.' . $user->role . '.myClass', compact('enrolledCourses'));
    // }

    
 
    public function wel()
    {
        $courses = Course::withCount('participants')
            ->where('end_date', '>=', now()) // Filter untuk menampilkan kursus yang belum melewati end_date
            ->orderBy('participants_count', 'desc') // Urutkan berdasarkan jumlah peserta
            ->take(5)
            ->get();
        
        // Pastikan 'courses' dikirim ke view
        return view('wel2', compact('courses'));
    }
    
    
    
    
    
    
    
    

    
    
}
