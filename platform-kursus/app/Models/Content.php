<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Content extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'body',
        'video_url',
    ];

    /**
     * Relasi Many-to-One dengan Course.
     * Setiap konten milik satu kursus.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relasi One-to-Many dengan ContentProgress.
     * Setiap konten dapat memiliki banyak progres dari siswa.
     */
    public function progress()
    {
        return $this->hasOne(ContentProgress::class);
    }


    public function userProgress()
    {
        return $this->hasMany(UserProgress::class, 'content_id');
    }

    
}
