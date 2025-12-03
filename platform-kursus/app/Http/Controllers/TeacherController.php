<?php

// namespace App\Http\Controllers;

// use App\Models\Course;
// use App\Models\UserProgress;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class TeacherController extends Controller
// {
//     public function showStudentProgress($courseId)
//     {
//         $course = Course::with(['contents', 'participants'])->findOrFail($courseId);
    
//         if ($course->teacher_id !== Auth::user()->id) {
//             abort(403, 'Unauthorized');
//         }
    
//         $studentProgress = $course->participants->map(function ($student) use ($course) {
//             $weeklyActivity = $this->getWeeklyActivity($student->id, $course->id); // Ambil aktivitas mingguan
//             $progressPercentage = $course->calculateStudentProgress($student->id);
    
//             return [
//                 'student' => $student,
//                 'progress_percentage' => $progressPercentage,
//                 'weekly_activity' => $weeklyActivity
//             ];
//         });
    
//         return view('dashboard.teacher.userProgress', compact('course', 'studentProgress'));
//     }
    
    
//     // private function getWeeklyActivity($studentId, $courseId)
//     // {
//     //     return UserProgress::where('student_id', $studentId)
//     //         ->where('course_id', $courseId)
//     //         ->where('is_done', true) // Pastikan hanya yang selesai
//     //         ->selectRaw('WEEK(marked_at) as week, COUNT(*) as completed_count')
//     //         ->groupBy('week')
//     //         ->orderBy('week')
//     //         ->get();
//     // }

//     private function getWeeklyActivity($studentId, $courseId)
// {
//     // Ambil data aktivitas mingguan beserta judul konten yang diselesaikan
//     return UserProgress::where('student_id', $studentId)
//         ->where('course_id', $courseId)
//         ->where('is_done', true)
//         ->with('content') // Pastikan relasi dengan konten sudah ada
//         ->selectRaw('WEEK(marked_at) as week')
//         ->groupBy('week')
//         ->get()
//         ->map(function ($progress) {
//             $contentTitles = $progress->content->pluck('title'); // Ambil judul konten
//             return [
//                 'week' => $progress->week,
//                 'completed_count' => $progress->content->count(), // Jumlah konten diselesaikan
//                 'content_titles' => $contentTitles, // Daftar judul konten
//             ];
//         });
// }

// }
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function showStudentProgress($courseId, $studentId)
    {
        $course = Course::with(['contents', 'participants'])->findOrFail($courseId);
        
        if ($course->teacher_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }
    
        $student = $course->participants->find($studentId);
    
        if (!$student) {
            abort(404, 'Student not found');
        }
    
        $progressPercentage = $course->calculateStudentProgress($studentId);
    
        // Ambil aktivitas mingguan atau progres konten siswa
        $studentProgress = $this->getStudentContentProgress($studentId, $courseId);
    
        return view('dashboard.teacher.userProgress', compact('course', 'student', 'progressPercentage', 'studentProgress'));
    }
    
    private function getStudentContentProgress($studentId, $courseId)
    {
        return UserProgress::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where('is_done', true)
            ->with('content') // Pastikan relasi dengan konten sudah ada
            ->get()
            ->map(function ($progress) {
                return [
                    'content_title' => $progress->content->title,
                    'completed_at' => $progress->marked_at,
                ];
            });
    }
    
}
