@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto pt-25">
    <!-- Hero Section -->
    <div class="relative w-full h-64 md:h-80 bg-gray-200 rounded-t-lg overflow-hidden mb-6">


        <!-- Back Button -->
        <a href="/" class="absolute top-4 left-4 z-20 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                <path d="M4 16l4-4-4-4m16 8l-4-4 4-4M12 20V4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
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
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">Makanan Favorit</h3>
                <div class="flex flex-wrap gap-2">
                    @if($fish->food && $fish->food->NAME)
                    @foreach(explode(',', $fish->food->NAME) as $food)
                    <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded">{{ trim($food) }}</span>
                    @endforeach
                    @else
                    <p class="text-sm text-gray-500">Tidak ada data makanan favorit.</p>
                    @endif
                </div>
            </div>

            <!-- Varieties -->
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">Varietas Ikan</h3>
                <div class="flex flex-wrap gap-2">
                    @forelse($varieties as $variety)
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded">
                        {{ $variety->VARIETY_NAME }}
                    </span>
                    @empty
                    <span class="text-gray-500 text-sm">Tidak ada varietas tersedia.</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection