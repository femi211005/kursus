<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Certificate;
// use App\Models\Course;
// use Illuminate\Support\Facades\Auth;
// use Barryvdh\DomPDF\Facade\Pdf as PDF;
// use Illuminate\Support\Facades\Storage;

// class CertificateController extends Controller
// {
//     public function generate(Request $request, $courseId)
//     {
//         // Validasi keberadaan kursus
//         $course = Course::findOrFail($courseId);
    
//         // Pastikan user sudah menyelesaikan kursus
//         $user = Auth::user();
//         $completedContents = $course->contents->filter(function ($content) use ($user) {
//             return $user->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
//         })->count();
    
//         if ($completedContents < $course->contents->count()) {
//             return redirect()->back()->with('error', 'You must complete the course to get the certificate.');
//         }
    
//         // Buat data untuk sertifikat
//         $certificateData = [
//             'student_name' => $user->name,
//             'course_name' => $course->name,
//             'date' => now()->format('F d, Y'),
//         ];
    
//         // Buat PDF dari view sertifikat
//         $pdf = PDF::loadView('certificates.template', $certificateData);
    
//         // Menyimpan file PDF ke storage
//         $fileName = 'certificate_' . $user->id . '_' . $course->id . '.pdf';
//         $filePath = 'certificates/' . $fileName;
    
//         // Pastikan direktori penyimpanan ada
//         if (!Storage::exists('certificates')) {
//             Storage::makeDirectory('certificates');
//         }
    
//         // Simpan file PDF ke storage
//         Storage::put($filePath, $pdf->output());
    
//         // Simpan informasi sertifikat ke database
//         Certificate::create([
//             'student_id' => $user->id,
//             'course_id' => $course->id,
//             'file_path' => $filePath,
//         ]);
    
//         // Menampilkan PDF di browser terlebih dahulu
//         return $pdf->stream('certificate_' . $user->id . '_' . $course->id . '.pdf');
//     }
    
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function generate(Request $request, $courseId)
    {
        // Validasi keberadaan kursus
        $course = Course::findOrFail($courseId);
    
        // Pastikan user sudah menyelesaikan kursus
        $user = Auth::user();
        $completedContents = $course->contents->filter(function ($content) use ($user) {
            return $user->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
        })->count();
    
        if ($completedContents < $course->contents->count()) {
            return redirect()->back()->with('error', 'You must complete the course to get the certificate.');
        }
    
        // Buat data untuk sertifikat
        $certificateData = [
            'student_name' => $user->name,
            'course_name' => $course->name,
            'date' => now()->format('F d, Y'),
        ];
    
        // Buat PDF dari view sertifikat
        $pdf = PDF::loadView('certificates.template', $certificateData);
                //   ->setPaper('a4', 'landscape');  // Set ukuran kertas A4 landscape
    
        // Menyimpan file PDF ke storage
        $fileName = 'certificate_' . $user->name . '_' . $course->name . '.pdf';
        $filePath = 'certificates/' . $fileName;
    
        // Pastikan direktori penyimpanan ada
        if (!Storage::exists('certificates')) {
            Storage::makeDirectory('certificates');
        }
    
        // Simpan file PDF ke storage
        Storage::put($filePath, $pdf->output());
    
        // Simpan informasi sertifikat ke database
        Certificate::create([
            'student_id' => $user->id,
            'course_id' => $course->id,
            'student' => $user->name,
            'course' => $course->name,
            'file_path' => $filePath,
        ]);
    
        // Menampilkan PDF di browser terlebih dahulu
        return $pdf->stream('certificate_' . $user->name . '_' . $course->name . '.pdf');
    }
}
