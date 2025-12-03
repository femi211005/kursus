<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        /* Menetapkan ukuran halaman A4 landscape untuk pencetakan */
        @page {
            size: A4 landscape;
            margin: 0;
            padding: 0;
        }

        /* Membuat ukuran div sesuai dengan ukuran A4 */
        .a4-landscape {
            width: 1123px; /* A4 landscape width */
            height: 793px; /* A4 landscape height */
            background-size: cover; /* Gambar latar belakang mengisi seluruh kontainer */
            background-position: center; /* Menempatkan gambar di tengah div */
            background-repeat: no-repeat; /* Menghindari pengulangan gambar */
            display: flex;
            justify-content: flex-start; /* Mengatur konten ke kiri */
            align-items: center; /* Menjaga konten tetap di tengah secara vertikal */
        }

        /* Membungkus teks agar bisa dipindahkan ke kanan */
        .content {
            margin-left: 130px; /* Memberikan jarak dari tepi kiri */
            padding-top: 230px;
            text-align: left;
            color: #333;
        }
    </style>
</head>
<body>
    <div 
        class="a4-landscape" 
        style="background-image: url('{{ public_path("images/certif.png") }}');">
        <div class="content">
            <h1 class="text-2xl font-bold">Certificate of Completion</h1>
            <p class="text-lg">This is to certify that</p>
            <h2 class="text-5xl font-bold">{{ $student_name }}</h2>
            <p class="text-lg">has successfully completed the course</p>
            <h3 class="text-4xl font-bold">{{ $course_name }}</h3>
            <p class="text-lg">
                Given this {{ now()->format('jS') }} day of {{ now()->format('F') }}, {{ now()->format('Y') }}.
            </p>
        </div>
    </div>
</body>
</html>
