@extends('layouts.app')

@section('content')

@if(session('status'))
<div class="fixed inset-0 z-60 flex items-center justify-center bg-black bg-opacity-50">
    <div id="emailAlert" class="relative bg-white border-l-4 border-green-500 px-6 py-6 rounded-xl shadow-2xl max-w-md w-full mx-4 flex items-start gap-4">
        <div class="text-green-600 mt-1 w-10 h-10 flex-shrink-0">
            <svg viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10">
                <g>
                    <path d="M66.734,401.582c-5.902,0-11.421-1.551-16.135-4.277l139.049-121.182l12.979,11.294 c10.863,9.44,24.46,14.22,37.93,14.22c13.536,0,27.133-4.78,37.996-14.22l12.973-11.294l47.074,41.038 c5.324-8.971,11.939-17.054,19.613-24.038l-43.093-37.547L446.977,140.54v127.084c12.26,2.236,23.756,6.62,34.136,12.75V124.834 c0-4.404-0.43-8.762-1.236-12.979c-2.175-10.925-7.016-20.922-13.778-29.181c-1.43-1.8-2.921-3.411-4.54-5.022 c-11.978-12.046-28.804-19.56-47.182-19.56H66.734c-18.377,0-35.136,7.514-47.182,19.56c-1.612,1.611-3.102,3.222-4.532,5.022 c-6.768,8.259-11.609,18.256-13.717,29.181C0.43,116.072,0,120.43,0,124.834v244.162c0,9.367,1.987,18.371,5.526,26.502 c3.283,7.762,8.131,14.785,14.026,20.673c1.491,1.491,2.981,2.86,4.593,4.224c11.549,9.561,26.454,15.336,42.589,15.336h280.481 c-8.118-10.032-14.436-21.567-18.412-34.15H66.734z M43.697,101.797c5.962-5.956,13.973-9.561,23.037-9.561h347.645 c9.065,0,17.142,3.606,23.037,9.561c1.047,1.061,2.042,2.243,2.921,3.418L258.128,264.017c-5.029,4.405-11.24,6.581-17.571,6.581 c-6.271,0-12.476-2.176-17.572-6.581L40.85,105.148C41.656,103.973,42.65,102.858,43.697,101.797z M34.136,368.997V140.479 L166,255.51L34.203,370.42C34.136,369.984,34.136,369.494,34.136,368.997z"/>
                    <path d="M428.285,286.484c-46.235,0-83.702,37.48-83.702,83.715c0,46.228,37.467,83.708,83.702,83.708 c46.242,0,83.715-37.48,83.715-83.708C512,323.963,474.527,286.484,428.285,286.484z M441.23,410.236h-20.331v-56.421h-0.242 l-14.744,6.963l-3.076-17.82l20.654-9.441h17.74V410.236z"/>
                </g>
            </svg>
        </div>
        <div class="text-sm text-gray-800 pr-6">
            <h3 class="text-green-700 font-semibold text-base mb-1">Success!</h3>
            <p>{{ session('status') }}</p>
        </div>
        <button onclick="document.getElementById('emailAlert').parentElement.remove()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition text-xl font-bold">&times;</button>
    </div>
</div>
@endif






@if($showPasswordAlert)
<div id="passwordAlert" class="fixed top-24 left-0 right-0 z-50 bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 shadow-md flex items-center justify-between" role="alert">
    <div class="flex items-center space-x-2">
        <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.597c.75 1.336-.213 3.004-1.742 3.004H3.48c-1.53 0-2.493-1.668-1.743-3.004L8.257 3.1zm1.743 9.401a1 1 0 10-2 0 1 1 0 002 0zm-.25-6.75a.75.75 0 00-1.5 0v4a.75.75 0 001.5 0v-4z" clip-rule="evenodd" />
        </svg>

        <form method="POST" action="{{ route('user.reset_password_send') }}" onsubmit="handleResetClick(event)">
            @csrf
            <button type="submit" class="text-sm font-medium text-yellow-800 hover:underline bg-transparent border-none p-0">
                Masukkan Password Baru Anda Agar Lebih Aman! Klik Disini Untuk Menerima Email Pembaruan Password.
            </button>
        </form>
    </div>
    <button onclick="this.parentElement.remove()" class="text-sm font-medium text-yellow-800 hover:text-yellow-600">
        ×
    </button>
</div>
@endif






<div id="page-wrapper" class="pt-24 transition-colors duration-500" style="background: transparent;">

    <section class="relative bg-white overflow-hidden h-[550px] md:h-[650px] group">

        @if($noSPKResultYet)
        <div id="hero" class="absolute inset-0 bg-gradient-to-r from-blue-600 to-[#0E87CC] z-10 flex items-center">
            <div class="text-white p-8 max-w-10/12 mx-auto">
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6 leading-tight">Selamat Datang di FinDer!
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl mb-8 leading-relaxed">
                    Belum tahu ikan apa yang cocok untuk Anda? <br class="hidden sm:block">
                    Mulai kuesioner kami dan temukan rekomendasi ikan terbaik yang dipersonalisasi khusus untuk
                    preferensi Anda.
                </p>
                @if(Route::has('user.dss.questions'))
                <a href="{{ route('user.dss.questions') }}"
                    class=" inline-block bg-white text-black px-8 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-400 transition-colors text-lg transform hover:scale-105">
                    Mulai Kuesioner Sekarang
                </a>
                @endif
            </div>
        </div>
        @elseif($heroFish)
        @php
        $imageName = $heroFish->IMAGE;
        $defaultPlaceholder = 'img/placeholder.png';
        $baseImageDirectory = 'storage/fish_images/';
        if ($imageName && !Illuminate\Support\Str::startsWith($imageName, 'http')) {
        $imageUrl = asset($baseImageDirectory . $imageName);
        } elseif (Illuminate\Support\Str::startsWith($imageName, 'http')) {
        $imageUrl = $imageName;
        } else {
        $imageUrl = asset($defaultPlaceholder);
        }
        @endphp

        <img src="{{ $imageUrl }}" alt="{{ $heroFish->NAME }}"
            class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 ease-in-out group-hover:scale-105">

        <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/40 to-transparent z-10"></div>

        <div
            class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center md:justify-center">
            <div class="max-w-xl text-white md:pt-0 pt-20">
                @if($isFromSPK)
                <span
                    class="inline-block bg-yellow-400 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-3 shadow">
                    Rekomendasi Untuk Anda!
                </span>
                @else
                <span
                    class="inline-block bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-3 shadow">
                    Inspirasi Ikan Hias
                </span>
                @endif
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 sm:mb-6 leading-tight shadow-sm">
                    {{ $heroFish->NAME }}
                </h1>
                <p
                    class="text-base sm:text-lg md:text-xl mb-8 sm:mb-10 text-gray-200 line-clamp-3 sm:line-clamp-4 leading-relaxed">
                    {{ $heroFish->DESCRIPTION ?: 'Deskripsi untuk ikan ini belum tersedia.' }}
                </p>
                <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:items-center sm:space-x-5">
                    {{-- Tombol Lihat Detail --}}
                    <form method="GET" action="{{ Route::has('user.fish_detail') ? route('user.fish_detail', ['id' => $heroFish->FISH_ID]) : '#' }}">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-full font-semibold shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 text-base sm:text-lg group-hover:bg-yellow-400 group-hover:text-gray-900">
                            {{-- Perubahan: rounded-lg menjadi rounded-full --}}
                            <span>Lihat Detail</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </form>

                    {{-- Tombol Kuesioner SPK --}}
                    <form method="GET" action="{{ Route::has('user.dss.questions') ? route('user.dss.questions') : '#' }}">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center bg-white text-blue-600 px-6 py-3 rounded-full font-semibold shadow-md hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:scale-105 text-base sm:text-lg max-w-max">
                            {{-- Perubahan: rounded-lg menjadi rounded-full --}}
                            {{ $isFromSPK ? 'Ubah Preferensi SPK' : 'Mulai Kuesioner SPK' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div
            class="absolute inset-0 bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 z-10 flex items-center justify-center">
            <div class="text-center text-white p-8 max-w-2xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Selamat Datang di FinDer</h1>
                <p class="text-lg md:text-xl mb-8">Jelajahi dunia ikan hias bersama kami atau mulai kuesioner untuk
                    rekomendasi.</p>
                @if(Route::has('user.dss'))
                <a href="{{ route('user.dss') }}"
                    class="inline-block bg-yellow-500 text-gray-900 px-8 py-3 rounded-lg font-semibold shadow-lg hover:bg-yellow-400 transition-colors text-lg">
                    Mulai Kuesioner
                </a>
                @endif
            </div>
        </div>
        @endif
    </section>

    <div id="ikan-lainnya" class="sticky top-23 z-10 bg-gradient-to-r from-blue-600 to-[#0E87CC] shadow-sm py-4"
        style="border-bottom-left-radius: 36px; border-bottom-right-radius: 36px;">
        <div class="max-w-7xl mx-auto px-6 flex justify-center">
            <h2 class="text-xl md:text-2xl font-semibold text-white text-center">Ikan Lainnya</h2>
        </div>
    </div>



    <section class="max-w-7xl mx-auto px-6 py-8 md:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($alternativeFishes as $fish)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow p-4">
                <div class="w-full h-40 bg-gray-100 rounded-lg mb-3 flex items-center justify-center overflow-hidden">
                    @if($fish->image)
                    <img src="{{ $fish->image }}" alt="{{ $fish->NAME }}" class="w-full h-full object-cover">
                    @else
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4-4-4-4m16 8l-4-4 4-4M12 20V4" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" />
                    </svg>
                    @endif
                </div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $fish->NAME }}</h3>
                <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $fish->DESCRIPTION }}</p>
                <form method="GET" action="{{ route('user.fish_detail', $fish->FISH_ID) }}" class="mt-3 inline-block">
                    <button type="submit" class="bg-transparent border-none p-0 cursor-pointer text-sm text-blue-600 hover:text-blue-800">
                        Lihat detail
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    const ikanLainnya = document.getElementById('ikan-lainnya');
    const hero = document.getElementById('hero');
    const wrapper = document.getElementById('page-wrapper');

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = 600;
        const startScroll = maxScroll * 0.5;

        if (scrollTop < startScroll) {
            ikanLainnya.style.background = 'linear-gradient(to right, #2563eb, #3b82f6)';
            return;
        }

        let opacity = (scrollTop - startScroll) / (maxScroll - startScroll);
        opacity = Math.min(opacity, 1);
        const darkOverlayOpacity = opacity * 0.6;

        ikanLainnya.style.background = `
                                    linear-gradient(
                                        to right,
                                        rgba(0, 0, 0, ${darkOverlayOpacity}),
                                        rgba(0, 0, 0, ${darkOverlayOpacity})
                                    ),
                                    linear-gradient(to right, #2563eb, #3b82f6)
                                `;
    });

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = 600;
        const startScroll = maxScroll * 0.5;

        if (scrollTop < startScroll) {
            hero.style.background = 'linear-gradient(to right, #2563eb, #3b82f6)';
            return;
        }

        let opacity = (scrollTop - startScroll) / (maxScroll - startScroll);
        opacity = Math.min(opacity, 1);
        const darkOverlayOpacity = opacity * 0.6;

        hero.style.background = `
                                    linear-gradient(
                                        to right,
                                        rgba(0, 0, 0, ${darkOverlayOpacity}),
                                        rgba(0, 0, 0, ${darkOverlayOpacity})
                                    ),
                                    linear-gradient(to right, #2563eb, #3b82f6)
                                `;
    });



    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = 600;
        const startScroll = maxScroll * 0.5;

        if (scrollTop < startScroll) {
            wrapper.style.background = 'transparent';
            return;
        }

        let opacity = (scrollTop - startScroll) / (maxScroll - startScroll);
        opacity = Math.min(opacity, 1);

        const blackShade = `rgba(10, 10, 15, ${opacity})`;
        const blueShade = `rgba(20, 40, 90, ${opacity})`;

        wrapper.style.background = `linear-gradient(to bottom, ${blackShade}, ${blueShade})`;
    });

    setTimeout(() => {
        const alertBox = document.getElementById('emailAlert');
        if (alertBox) {
            alertBox.parentElement.remove();
        }
    }, 5000);


</script>

@endsection
