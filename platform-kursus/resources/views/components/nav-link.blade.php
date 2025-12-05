@props(['active'])

@php
// LOGIKA WARNA BARU:
// Karena background navigasi sekarang terang (#FCF8F8), kita tidak lagi membutuhkan pengecekan '$isRoleHome' 
// untuk mengubah teks menjadi putih. Semua teks harus gelap (gray) agar terbaca.

$classes = ($active ?? false)
            // KONDISI AKTIF (Menu sedang dipilih)
            // Border bawah menggunakan warna aksen (#F5AFAF)
            // Teks berwarna gelap (gray-900)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-[#F5AFAF] text-sm font-mono font-semibold leading-5 text-gray-900 focus:outline-none focus:border-[#F5AFAF] transition duration-150 ease-in-out'
            
            // KONDISI TIDAK AKTIF (Menu tidak dipilih)
            // Teks berwarna abu-abu (gray-500)
            // Saat di-hover, border bawah muncul dengan warna pink lembut (#F9DFDF)
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-mono font-semibold leading-5 text-gray-500 hover:text-gray-700 hover:border-[#F9DFDF] focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>