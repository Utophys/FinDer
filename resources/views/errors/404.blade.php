{{-- resources/views/errors/404.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center bg-white p-10 rounded-lg shadow-xl max-w-lg mx-auto">
        <h1 class="text-8xl font-bold text-indigo-600">404</h1>
        <h2 class="text-3xl font-bold text-gray-800 mt-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-600 mt-2 text-lg">
            Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin link yang Anda ikuti sudah rusak atau halaman
            telah dipindahkan.
        </p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
            {{-- Tombol untuk kembali ke halaman sebelumnya --}}
            <button onclick="window.history.back()"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75 transition-colors duration-200">
                Kembali
            </button>

            {{-- Tombol untuk kembali ke Halaman Utama/Beranda --}}
            <a href="{{ url('/') }}"
                class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-75 transition-colors duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>

</html>