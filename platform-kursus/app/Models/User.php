<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ONE TO MANY RELATIONSHIP WITH COURSES
    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id'); // Using 'teacher_id' as the foreign key
    }

    // MANY TO MANY RELATIONSHIP WITH COURSES
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_participants', 'student_id', 'course_id');
    }

    // OTHER RELATIONSHIPS
    public function contentProgress()
    {
        return $this->hasMany(ContentProgress::class, 'student_id');
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }
    

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}
