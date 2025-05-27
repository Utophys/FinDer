@extends('layouts.app')

@section('content')
@if($showPasswordAlert)
<div class="fixed top-24 left-0 right-0 z-50 bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 shadow-md flex items-center justify-between" role="alert">
    <div class="flex items-center space-x-2">
        <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l6.518 11.597c.75 1.336-.213 3.004-1.742 3.004H3.48c-1.53 0-2.493-1.668-1.743-3.004L8.257 3.1zm1.743 9.401a1 1 0 10-2 0 1 1 0 002 0zm-.25-6.75a.75.75 0 00-1.5 0v4a.75.75 0 001.5 0v-4z" clip-rule="evenodd" />
        </svg>

        <form method="POST" action="{{ route('user.reset_password_send') }}">
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
                            <a href="{{ Route::has('user.fish_detail') ? route('user.fish_detail', ['id' => $heroFish->FISH_ID]) : '#' }}"
                                class="inline-flex items-center justify-center space-x-2 text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-300 ease-in-out transform hover:scale-105 text-base sm:text-lg group-hover:bg-yellow-400 group-hover:text-gray-900">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="{{ Route::has('user.dss.questions') ? route('user.dss.questions') : '#' }}"
                                class="inline-flex items-center justify-center bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-100 transition-all duration-300 ease-in-out transform hover:scale-105 text-base sm:text-lg max-w-max">
                                {{ $isFromSPK ? 'Ubah Preferensi SPK' : 'Mulai Kuesioner SPK' }}
                            </a>
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
                        <a href="{{ route('user.fish_detail', $fish->FISH_ID) }}"
                            class="mt-3 inline-block text-sm text-blue-600 hover:underline">
                            Lihat detail
                        </a>
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
    </script>

@endsection