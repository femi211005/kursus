<?php
// app/Http/Controllers/Student/LessonController.php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Content;
use App\Models\Progress;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:student']);
    }

    public function show(Course $course, Content $content)
    {
        // Check if student is enrolled
        if (!$course->isEnrolledBy(auth()->id())) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You must enroll in this course first.');
        }

        // Check if content belongs to course
        if ($content->course_id !== $course->id) {
            abort(404);
        }

        // Get all contents for navigation
        $contents = $course->contents()->orderBy('order_index')->get();
        
        // Check if current content is completed
        $isCompleted = $content->isCompletedBy(auth()->id());
        
        // Get next and previous content
        $currentIndex = $contents->search(function($item) use ($content) {
            return $item->id === $content->id;
        });
        
        $previousContent = $currentIndex > 0 ? $contents[$currentIndex - 1] : null;
        $nextContent = $currentIndex < $contents->count() - 1 ? $contents[$currentIndex + 1] : null;
        
        // Check if previous content is completed (required to access current)
        $canAccess = true;
        if ($previousContent && !$previousContent->isCompletedBy(auth()->id())) {
            $canAccess = false;
        }

        // Calculate progress
        $totalContents = $contents->count();
        $completedContents = auth()->user()->progress()
            ->whereHas('content', function($q) use ($course) {
                $q->where('course_id', $course->id);
            })
            ->where('is_completed', true)
            ->count();
        
        $progressPercentage = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;

        return view('student.lessons.show', compact(
            'course', 
            'content', 
            'contents', 
            'isCompleted', 
            'previousContent', 
            'nextContent',
            'canAccess',
            'progressPercentage'
        ));
    }

    public function markAsCompleted(Course $course, Content $content)
    {
        // Check if student is enrolled
        if (!$course->isEnrolledBy(auth()->id())) {
            return back()->with('error', 'You must enroll in this course first.');
        }

        // Check if content belongs to course
        if ($content->course_id !== $course->id) {
            abort(404);
        }

        // Create or update progress
        Progress::updateOrCreate(
            [
                'student_id' => auth()->id(),
                'content_id' => $content->id,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
            ]
        );

        return back()->with('success', 'Lesson marked as completed!');
    }
}