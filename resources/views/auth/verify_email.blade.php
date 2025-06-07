<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md mx-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Verifikasi Email</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.verify.email') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                       value="{{ old('email', $email ?? '') }}" required autocomplete="email" readonly>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="verification_code" class="block text-gray-700 text-sm font-medium mb-2">Kode Verifikasi</label>
                <input type="text" id="verification_code" name="verification_code"
                       class="shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('verification_code') border-red-500 @enderror"
                       placeholder="Masukkan 6 digit kode" required autofocus maxlength="6">
                @error('verification_code')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 ease-in-out transform hover:scale-105">
                Verifikasi
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Tidak menerima kode? Pastikan Anda memeriksa folder spam Anda.
        </p>
        {{-- Resend Code Form --}}
        <form action="{{ route('auth.resend.verification') }}" method="POST" class="mt-4 text-center">
            @csrf
            <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">
            <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm font-medium">Kirim Ulang Kode</button>
        </form>
    </div>
</body>
</html>
