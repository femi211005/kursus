<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Get 5 most popular courses based on student count
        $popularCourses = Course::withCount('students')
            ->where('is_active', true)
            ->orderBy('students_count', 'desc')
            ->take(5)
            ->with(['teacher', 'category'])
            ->get();

        // Get all categories for filter
        $categories = Category::all();

        // Build query for search and filter
        $query = Course::where('is_active', true)->with(['teacher', 'category']);

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $courses = $query->paginate(12);

        return view('home', compact('popularCourses', 'categories', 'courses'));
    }

    public function catalog(Request $request)
    {
        $categories = Category::all();
        
        $query = Course::where('is_active', true)
            ->with(['teacher', 'category'])
            ->withCount('students');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $courses = $query->paginate(12);

        return view('courses.catalog', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        $course->load(['teacher', 'category', 'contents']);
        
        $isEnrolled = false;
        $progress = 0;

        if (auth()->check() && auth()->user()->isStudent()) {
            $isEnrolled = $course->isEnrolledBy(auth()->id());
            
            if ($isEnrolled) {
                $totalContents = $course->contents()->count();
                $completedContents = auth()->user()->progress()
                    ->whereHas('content', function($q) use ($course) {
                        $q->where('course_id', $course->id);
                    })
                    ->where('is_completed', true)
                    ->count();
                
                $progress = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;
            }
        }

        return view('courses.show', compact('course', 'isEnrolled', 'progress'));
    }
}