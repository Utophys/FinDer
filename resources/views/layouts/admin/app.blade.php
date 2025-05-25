<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    {{-- Tambahkan CSS atau meta lainnya di sini --}}
</head>

<body>
    <div class="flex w-full h-screen">
        <!-- Sidebar kiri -->
        <div class="bg-white w-[30%] h-full p-6 flex flex-col">
            <!-- Logo di pojok kiri atas -->
            <div class="flex items-start align-middle">
                <img src="{{ asset('img/finder-logo.png') }}" alt="finder-logo" class="w-24">
                <h1 class="text-2xl font-semibold text-center h-full align-middle">Hello, admin! :D</h1>
            </div>

            <!-- Konten tengah -->
            <div class="flex flex-col items-center">
                <!-- Tombol navigasi -->
                <a href="/admin/fishes"
                    class="bg-blue-500 text-white px-4 py-2 rounded mb-4 hover:bg-blue-600 transition">
                    Kelola Fishes
                </a>
                <a href="/admin/foods" class="bg-green-500 text-white px-4 py-2 mb-4 rounded hover:bg-green-600 transition">
                    Kelola Foods
                </a>
                <a href="/admin/user-results" class="bg-green-500 text-white px-4 mb-4 py-2 rounded hover:bg-green-600 transition">
                    Kelola History
                </a>
                <a href="/admin/varieties" class="bg-green-500 text-white px-4 mb-4 py-2 rounded hover:bg-green-600 transition">
                    Kelola Varietas Ikan
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>


        <!-- Konten kanan -->
        <div class="bg-[#0E87CC] w-[70%] h-full overflow-y-auto p-8 text-white">

            {{-- Konten utama halaman --}}
            <main>
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>