<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    // public function index($course_id)
    // {
    //     $course = Course::findOrFail($course_id);
    //     $forumPosts = $course->forumPosts()->with('user')->get();
    
    //     // Menentukan apakah pengguna yang sedang login adalah teacher (pembuat kursus)
    //     $isTeacher = $course->teacher && $course->teacher->id === Auth::id();
    
    //     return view('forum.index', compact('course', 'forumPosts', 'isTeacher'));
    // }

    public function index($course_id)
    {
        $course = Course::with('teacher', 'participants')->findOrFail($course_id);
        $user = Auth::user();

        // Periksa apakah user adalah teacher atau telah enroll
        $isTeacher = $user->id === $course->teacher_id;
        $isEnrolled = $course->participants->contains('id', $user->id);

        if (!$isTeacher && !$isEnrolled) {
            // Redirect jika user tidak memiliki akses
            return redirect()->route('class')->with('error', 'You do not have permission to access this forum.');
        }

        // Ambil post forum untuk course
        $forumPosts = $course->forumPosts; // Menggunakan relasi di model Course

        return view('forum.index', compact('course', 'forumPosts'));
    }

    

    public function store(Request $request, $course_id)
    {
        $request->validate([
            'post_content' => 'required',
        ]);
    
        $course = Course::findOrFail($course_id);
    
        // Memeriksa apakah ini adalah balasan (ada parent_id)
        $parent_id = $request->input('parent_id', null); // default null jika bukan balasan
    
        // Menyimpan posting baru atau balasan
        ForumPost::create([
            'course_id' => $course->id,
            'user_id' => Auth::user()->id,
            'post_content' => $request->post_content,
            'parent_id' => $parent_id, // Menyimpan parent_id jika ada
        ]);
    
        return redirect()->route('forum.index', ['course_id' => $course->id]);
    }
    
    
}
