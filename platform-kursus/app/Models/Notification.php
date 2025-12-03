<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'notifications';

    // Tentukan kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'message',
        'is_read',
    ];

    // Relasi dengan model User (sebuah notifikasi dimiliki oleh seorang pengguna)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
