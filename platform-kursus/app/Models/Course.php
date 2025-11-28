<?php
// app/Models/Course.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'teacher_id',
        'category_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('order_index');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                    ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Helper Methods
    public function getStudentCountAttribute()
    {
        return $this->students()->count();
    }

    public function isEnrolledBy($userId)
    {
        return $this->students()->where('student_id', $userId)->exists();
    }
}