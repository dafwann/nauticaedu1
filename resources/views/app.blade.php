<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NauticaEdū - Edukasi Kelestarian Laut</title>

    {{-- Vite CSS/JS --}}
    @vite([
        'resources/js/app.js'     {{-- panggil JS utama --}}
    ])
</head>
<body class="bg-white text-gray-900">
    {{-- Root div untuk Vue --}}
    <div id="app"></div>

    {{-- Optional: fallback jika JS gagal --}}
    <noscript>
        <p>Untuk menampilkan konten, aktifkan JavaScript di browser Anda.</p>
    </noscript>
</body>
</html>
