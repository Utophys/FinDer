@extends('layouts.dss') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Hasil dan Detail Perhitungan Rekomendasi Ikan')

@section('content')
    <div class="flex flex-col min-h-screen bg-[#0E87CC] ">
        <nav class="bg-white shadow-md py-6 px-8 flex justify-between items-center top-0 left-0 right-0 z-50">
            <!-- Left: FinDer Logo -->
            <div class="flex items-center">
                <img src="{{ asset('assets/images/FinDer-Logos.svg') }}" alt="FinDer Logo"
                    class="h-12 max-h-full object-contain">
            </div>

            <!-- Right: User Info with Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700 font-medium">
                        @auth
                            {{ Auth::user()->DISPLAY_NAME }}
                        @else
                            Guest
                        @endauth
                    </span>
                    <img src="{{ asset('assets/images/icon-user.svg') }}" alt="User Icon" class="h-8 w-8 rounded-full">
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                    @auth

                        <form method="POST" action="{{ route('user.logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('auth.show') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-black no-underline">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
        <div class="py-10 px-4 sm:px-6 lg:px-8">
            <div class=" max-w-10/12 mx-auto">
                <div class="text-white">
                    @if($top1FishDetail && $top1FishDetail->fish)
                        @php
                            $topFish = $top1FishDetail->fish;
                            $imagePath = $topFish->IMAGE ?? 'default-fish.jpg';
                            if (Illuminate\Support\Str::startsWith($imagePath, 'storage/')) {
                                $imageUrl = Storage::url(substr($imagePath, strlen('storage/')));
                            } else {
                                $imageUrl = asset($imagePath);
                            }
                        @endphp
                        <div class="p-6 sm:p-8 rounded-xl flex flex-col md:flex-row items-stretch mb-12 bg-opacity-20 backdrop-blur-md"> 
                            <div class="md:w-[40%] lg:w-4/10 w-full mb-6 md:mb-0 flex-shrink-0 flex flex-col justify-center items-center pr-0 md:pr-4 lg:pr-6">
                                <img src="{{ $imageUrl }}"
                                    alt="{{ $topFish->NAME ?? 'Ikan Pilihan' }}"
                                    class="w-full max-w-2xl sm:max-w-2xl h-auto object-contain rounded-lg shadow-lg"> 
                                                        </div>

                            <div class="hidden md:flex items-center justify-center px-3 lg:px-4"> 
                                <div class="w-2 h-full bg-white bg-opacity-50 rounded-full"></div> 
                            </div>

                            <div class="md:hidden w-4/5 h-px bg-white bg-opacity-50 my-6 mx-auto rounded-full"></div>

                            <div class="md:w-[55%] lg:w-2/3 w-full text-center md:text-left md:pl-4 lg:pl-6 flex flex-col justify-center"> {{-- Tambahkan flex flex-col justify-center --}}
                                <div> 
                                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 sm:mb-3 leading-tight text-shadow">
                                        Ikan paling cocok untuk Anda, adalah <br class="block sm:hidden"><span class="text-yellow-300">{{ $topFish->NAME ?? 'Ikan Pilihan' }}</span>!
                                    </h1>
                                    <p class="text-gray-100 mb-4 sm:mb-6 text-sm sm:text-base leading-relaxed text-shadow-sm line-clamp-4 md:line-clamp-5 lg:line-clamp-none">
                                        {{ $topFish->DESCRIPTION ?: 'Deskripsi untuk ikan ini belum tersedia.' }}
                                    </p>
                                    <div class="pt-2"> 
                                        @if(Route::has('user.fish_detail'))
                                        <a href="{{ route('user.fish_detail', ['id' => $topFish->FISH_ID]) }}"
                                        class="inline-flex items-center bg-white text-[#0E87CC] font-semibold py-2 px-4 sm:px-5 rounded-lg shadow-md hover:bg-gray-200 transition duration-150 ease-in-out text-xs sm:text-sm transform hover:scale-105">
                                            Lihat Detail
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1 sm:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('user.dss.calculation', ['result_id' => $resultId]) }}"
                                        class="inline-flex items-center bg-white text-[#0E87CC] font-semibold py-2 px-4 sm:px-5 rounded-lg shadow-md hover:bg-gray-200 transition duration-150 ease-in-out text-xs sm:text-sm transform hover:scale-105">
                                            Lihat Perhitungan
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1 sm:ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                            <div class="text-center md:text-left mt-3 text-xs text-gray-200 font-medium">Peringkat: {{ $top1FishDetail->RANKING }} | Skor: {{ number_format($top1FishDetail->SCORE, 4) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @else
                        <div class="bg-blue-700 p-8 rounded-xl shadow-2xl text-center mb-12">
                            <h1 class="text-3xl font-bold mb-3">Oops!</h1>
                            <p class="text-blue-200">Tidak dapat menampilkan rekomendasi ikan teratas saat ini.</p>
                        </div>
                    @endif

                    @if($otherConsiderations && $otherConsiderations->count() > 0)
                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold mb-6 text-center text-white">Ikan lain yang dapat dipertimbangkan
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                                @foreach($otherConsiderations as $detail)
                                    @if($detail->fish)
                                        @php $otherFish = $detail->fish; @endphp
                                        <a href="{{ Route::has('user.fish_detail') ? route('user.fish_detail', ['id' => $otherFish->FISH_ID]) : '#' }}"
                                            class="block bg-white text-blue-700 p-4 rounded-lg shadow-md hover:bg-gray-100 hover:shadow-lg transition duration-150 ease-in-out text-center focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                            <span
                                                class="font-medium text-sm sm:text-base">{{ $otherFish->NAME ?? 'Ikan Alternatif' }}</span>
                                            {{-- Ganti NAMA_IKAN --}}
                                            <div class="text-xs text-gray-500 mt-1">Peringkat: {{ $detail->RANKING }} | Skor:
                                                {{ number_format($detail->SCORE, 4) }}
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection