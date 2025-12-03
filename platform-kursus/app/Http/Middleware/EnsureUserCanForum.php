<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class EnsureUserCanAccessForum
{
    public function handle(Request $request, Closure $next)
    {
        $courseId = $request->route('course_id');
        $course = Course::with('teacher', 'participants')->findOrFail($courseId);
        $user = Auth::user();

        // Periksa apakah user adalah teacher atau telah enroll
        $isTeacher = $user->id === $course->teacher_id;
        $isEnrolled = $course->participants->contains('id', $user->id);

        if (!$isTeacher && !$isEnrolled) {
            return redirect()->route('class')->with('error', 'You do not have permission to access this forum.');
        }

        return $next($request);
    }
}
