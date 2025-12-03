<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    // Tabel yang terkait dengan model
    protected $table = 'certificates';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'course_id',
        'student_id',
        'file_path',
    ];

    /**
     * Relasi ke model Course.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Relasi ke model User (Student).
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Fungsi untuk mendapatkan URL sertifikat.
     */
    public function getCertificateUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
