<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentProgress extends Model
{
    protected $fillable = [
        'content_id',
        'student_id',
        'is_completed',
    ];

    /**
     * Relasi Many-to-One dengan Content.
     * Setiap progres milik satu konten.
     */


    /**
     * Relasi Many-to-One dengan User (Student).
     * Setiap progres milik satu siswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }


    public function content()
    {
        return $this->belongsTo(Content::class);
    }

}
