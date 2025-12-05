<?php
// app/Events/CourseUpdated.php
namespace App\Events;

use App\Models\Course;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CourseUpdated implements ShouldBroadcast
{
    public $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function broadcastOn()
    {
        return new Channel('course-updates');
    }

    public function broadcastWith()
    {
        return [
            'course_id' => $this->course->id,
            'course_name' => $this->course->name,
            'course_description' => $this->course->description,
            'course_picture' => $this->course->course_picture,
            'end_date' => $this->course->end_date,
        ];
    }
}