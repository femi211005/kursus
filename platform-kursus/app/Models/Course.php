<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'teacher_id',
        'course_picture',
        'end_date',
    ];

    /**
     * Relationship: One-to-Many with Teacher (User).
     * This links each course with its teacher.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id'); // Using 'teacher_id' as the foreign key
    }

    /**
     * Relationship: Many-to-Many with Students (Users).
     * This links a course with many students (users).
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'course_participants', 'course_id', 'student_id');
    }

    /**
     * Relationship: One-to-Many with Category.
     * This links each course with its category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: One-to-Many with Content.
     * This links each course with its content.
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }



    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'course_id');
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function isUserEnrolled($userId)
    {
        return $this->participants()->where('id', $userId)->exists();
    }

    public function isActive()
    {
        return is_null($this->end_date) || $this->end_date >= now();
    }

    
}
