<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NauticaEdū - Edukasi Kelestarian Laut</title>

    {{-- Panggil CSS/JS Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900">

    {{-- Root div Vue --}}
    <div id="app"></div>

    {{-- Fallback jika JS gagal --}}
    <noscript>
        <p>Untuk menampilkan konten, aktifkan JavaScript di browser Anda.</p>
    </noscript>
    
</body>
</html>
