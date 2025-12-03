<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ForumPost extends Model
{
    protected $fillable = ['course_id', 'user_id', 'post_content', 'parent_id'];

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi untuk mendapatkan postingan yang dibalas (postingan induk)
    public function parent()
    {
        return $this->belongsTo(ForumPost::class, 'parent_id');
    }
    
    // Relasi untuk mendapatkan balasan terhadap postingan
    public function replies()
    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
