<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ContentProgress;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function markContentAsDone($contentId)
    {
        $progress = ContentProgress::firstOrCreate([
            'content_id' => $contentId,
            'student_id' => auth()->id,
        ], [
            'is_completed' => true,
        ]);

        return back()->with('success', 'Content marked as done.');
    }

    public function updateCourseProgress($courseId)
    {
        $progress = UserProgress::firstOrCreate([
            'course_id' => $courseId,
            'student_id' => auth()->id,
        ]);

        $completedContents = $progress->course->contents()->whereHas('progress', function ($query) {
            $query->where('student_id', auth()->id)->where('is_completed', true);
        })->count();

        $totalContents = $progress->course->contents()->count();
        $progressPercentage = ($totalContents > 0) ? ($completedContents / $totalContents) * 100 : 0;

        $progress->update(['progress_percentage' => $progressPercentage]);

        return back()->with('success', 'Course progress updated.');
    }
}
