<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'content_id',
        'is_done',
        'marked_at', // Optional: kapan konten ditandai selesai
    ];

    /**
     * Relationship: Belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Belongs to Content.
     */
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
    
}
