@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto pt-25">
        <!-- Hero Section -->
        <div class="relative w-full h-64 md:h-80 bg-gray-200 rounded-t-lg overflow-hidden mb-6">


            <!-- Back Button -->
            <a href="/"
                class="absolute top-4 left-4 z-20 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 transition-all duration-200 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>

            <!-- overlay -->
            <div class="absolute inset-0 bg-black/20"></div>

            @if($fish->image)
                <img src="{{ $fish->image }}" alt="{{ $fish->NAME }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4-4-4-4m16 8l-4-4 4-4M12 20V4" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" />
                    </svg>
                </div>
            @endif

            <!-- Centered text container with gradient -->
            <div class="absolute inset-0 flex items-center justify-center p-6">
                <div class="w-full text-center">
                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-white drop-shadow-lg">{{ $fish->NAME }}</h1>
                </div>
            </div>
        </div>

        <!-- Main Content Container -->
        <div class="px-4 pb-8">
            <!-- Description Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-3">Deskripsi</h2>
                <p class="text-gray-700">{{ $fish->DESCRIPTION }}</p>
            </div>

            <!-- Criteria Section -->
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Kriteria</h2>

                <!-- First Criteria Row -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Harga</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Harga'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Biaya Pemeliharaan</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Biaya Pemeliharaan'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Kompleksitas Pemeliharaan</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Kompleksitas Pemeliharaan'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Second Criteria Row -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Kelangkaan</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Kelangkaan'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Ukuran</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Ukuran'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Estetika</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Estetika'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Third Criteria Row -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="border-b pb-2">
                        <h3 class="font-medium text-gray-700">Perilaku</h3>
                        @php $criterion = collect($groupedCriteria)->flatten(1)->firstWhere('NAME', 'Perilaku'); @endphp
                        <p class="mt-2">
                            @if($criterion)
                                @if($criterion->TYPE === 'cost')
                                    {{ $criterion->DISPLAY_VALUE }}
                                @else
                                    <span class="text-yellow-500">{{ $criterion->DISPLAY_VALUE }}</span>
                                @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div class="border-b pb-2"></div>
                    <div class="border-b pb-2"></div>
                </div>
            </div>

            <!-- Food and Varieties Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Favorite Food -->
                <div class="bg-white rounded-lg p-4 sm:p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Makanan Favorit</h3>
                    @if($fish->food)
                        @php
                            $foodRecord = $fish->food;
                            $imageName = $foodRecord->IMAGE ?? null; // Ambil nama file gambar dari record makanan
                            $defaultPlaceholder = 'img/placeholder_food.png'; // Sediakan placeholder untuk makanan
                            // Asumsi gambar makanan disimpan di storage/app/public/food_images/
                            // dan Anda telah menjalankan php artisan storage:link
                            $baseImageDirectory = 'storage/food_images/';

                            if ($imageName && !Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                $imageUrl = asset($baseImageDirectory . $imageName);
                            } elseif (Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                $imageUrl = $imageName; // Jika sudah URL absolut
                            } else {
                                // Jika IMAGE null, string kosong, atau tidak dimulai dengan http (dan bukan nama file valid)
                                $imageUrl = asset($defaultPlaceholder);
                            }
                        @endphp

                        {{-- Tampilkan Gambar Makanan --}}
                        <div class="mb-4 rounded-md overflow-hidden shadow">
                            <img src="{{ $imageUrl }}" alt="Makanan untuk {{ $fish->NAME }}"
                                class="w-full h-40 object-cover bg-gray-200">
                        </div>

                        {{-- Tampilkan Nama-nama Makanan sebagai Badge --}}
                        @if($foodRecord->NAME)
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $foodRecord->NAME) as $foodItemName)
                                    <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ trim($foodItemName) }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">Informasi nama makanan tidak tersedia.</p>
                        @endif
                    @else
                        <p class="text-sm text-gray-500">Tidak ada data makanan favorit untuk ikan ini.</p>
                    @endif
                </div>

                <!-- Varieties -->
                <div class="bg-white rounded-lg p-4 sm:p-6 shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Varietas Ikan</h3>

                    @if($varieties->count() > 1)
                        {{-- Tampilan Swipeable jika varietas lebih dari 1 --}}
                        <div class="relative">
                            {{-- Kontainer yang bisa di-scroll horizontal --}}
                            <div
                                class="flex overflow-x-auto py-4 space-x-4 sm:space-x-6 scroll-snap-x-mandatory scrollbar-thin hover:scrollbar-thumb-gray-400 scrollbar-thumb-gray-300 scrollbar-track-gray-100 scrollbar-thumb-rounded-full">
                                @foreach($varieties as $variety)
                                    {{-- Setiap kartu varietas --}}
                                    <div class="flex-none w-60 sm:w-64 md:w-72 scroll-snap-align-start"> {{-- flex-none agar lebar
                                        tidak menyusut --}}
                                        <div
                                            class="bg-gray-50 rounded-xl shadow-lg overflow-hidden h-full transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col">
                                            @php
                                                $imageName = $variety->IMAGE;
                                                $defaultPlaceholder = 'img/placeholder_variety.png';
                                                $baseImageDirectory = 'storage/variety_images/';

                                                if ($imageName && !Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                                    $imageUrl = asset($baseImageDirectory . $imageName);
                                                } elseif (Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                                    $imageUrl = $imageName;
                                                } else {
                                                    $imageUrl = asset($defaultPlaceholder);
                                                }
                                            @endphp
                                            <div class="w-full h-40 sm:h-48 bg-gray-200">
                                                <img src="{{ $imageUrl }}" alt="{{ $variety->VARIETY_NAME }}"
                                                    class="w-full h-full object-cover">
                                            </div>

                                            <div class="p-3 sm:p-4 flex-grow flex flex-col justify-center">
                                                <h4 class="text-sm sm:text-md font-semibold text-gray-700 text-center">
                                                    {{ $variety->VARIETY_NAME }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @elseif($varieties->count() == 1)
                        @php $variety = $varieties->first(); @endphp
                        <div class="flex justify-center">
                            <div class="w-full max-w-xs sm:max-w-sm"> {{-- Batasi lebar kartu tunggal --}}
                                <div
                                    class="bg-gray-50 rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col">
                                    @php
                                        $imageName = $variety->IMAGE;
                                        $defaultPlaceholder = 'img/placeholder_variety.png';
                                        $baseImageDirectory = 'storage/variety_images/';

                                        if ($imageName && !Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                            $imageUrl = asset($baseImageDirectory . $imageName);
                                        } elseif (Illuminate\Support\Str::startsWith($imageName, 'http')) {
                                            $imageUrl = $imageName;
                                        } else {
                                            $imageUrl = asset($defaultPlaceholder);
                                        }
                                    @endphp
                                    <div class="w-full h-48 sm:h-56 bg-gray-200">
                                        <img src="{{ $imageUrl }}" alt="{{ $variety->VARIETY_NAME }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div class="p-4 sm:p-5 flex-grow flex flex-col justify-center">
                                        <h4 class="text-md sm:text-lg font-semibold text-gray-700 text-center">
                                            {{ $variety->VARIETY_NAME }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Tampilan jika tidak ada varietas (@empty) --}}
                        <div class="text-center py-8">
                            <span class="text-gray-500 text-lg">Tidak ada varietas tersedia saat ini.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection