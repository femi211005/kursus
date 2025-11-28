<?php
// app/Models/Content.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'content',
        'order_index',
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    // Helper Methods
    public function isCompletedBy($userId)
    {
        return $this->progress()
                    ->where('student_id', $userId)
                    ->where('is_completed', true)
                    ->exists();
    }
}