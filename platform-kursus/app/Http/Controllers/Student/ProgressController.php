<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function complete(Content $content)
    {
        $user = auth()->user();

        if (!$user->courses()->where('course_id', $content->course_id)->exists()) {
            abort(403);
        }

        // Misal update progress (soft example)
        $pivot = $user->courses()->where('course_id', $content->course_id)->first()->pivot;
        $pivot->progress = min($pivot->progress + 10, 100);
        $pivot->save();

        return redirect()->back()->with('success', "Materi $content->title ditandai selesai");
    }
}
