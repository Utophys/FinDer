@extends('layouts.dss') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Hasil dan Detail Perhitungan Rekomendasi Ikan')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto"> {{-- Lebarkan max-width untuk tabel --}}

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-md" role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- Tombol Kembali ke Kuesioner di Atas --}}
            <div class="mb-8 text-center">
                <a href="{{ route('user.dss') }}" class="text-blue-600 hover:text-blue-800 underline">
                    &larr; Kembali atau Ulangi Kuesioner
                </a>
            </div>

            {{-- Bagian Detail Kalkulasi MOORA --}}
            @if(isset($calculationData))
                @php
                    $userWeights = $calculationData['userWeights'];
                    $allCriteria = $calculationData['allCriteria'];
                    $allAlternatives = $calculationData['allAlternatives'];
                    $initialMatrix = $calculationData['initialMatrix'];
                    $denominatorSquares = $calculationData['denominatorSquares'];
                    $normalizedMatrix = $calculationData['normalizedMatrix'];
                    $weightedNormalizedMatrix = $calculationData['weightedNormalizedMatrix'];
                    $benefitCostSums = $calculationData['benefitCostSums'];
                    $rankedFishDetailsForCalc = $calculationData['rankedFishDetails']; // Ini adalah $rankedFishDetails dari controller

                    // Mapping nama alternatif untuk kemudahan tampilan
                    $alternativeNames = $allAlternatives->pluck('NAME', 'FISH_ID'); // Ganti 'NAME' jika nama kolom beda
                    $criteriaNames = $allCriteria->pluck('NAME', 'CRITERIA_ID');
                    $criteriaTypes = $allCriteria->pluck('TYPE', 'CRITERIA_ID');
                @endphp

                <div class="bg-white p-6 rounded-lg shadow-xl mb-10">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Detail Perhitungan MOORA (Result ID:
                        {{ $resultId }})</h2>

                    {{-- 1. Bobot Kriteria Pengguna (Wj) --}}
                    <section class="mb-8">
                        <h3 class="text-xl font-medium text-gray-700 mb-3">1. Bobot Kriteria Pengguna (W<sub>j</sub>)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">ID Kriteria</th>
                                        <th class="border px-3 py-2 text-left">Nama Kriteria</th>
                                        <th class="border px-3 py-2 text-center">Bobot (W<sub>j</sub>)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allCriteria as $crit)
                                        <tr>
                                            <td class="border px-3 py-2">{{ $crit->CRITERIA_ID }}</td>
                                            <td class="border px-3 py-2">{{ $crit->NAME }}</td>
                                            <td class="border px-3 py-2 text-center">{{ $userWeights[$crit->CRITERIA_ID] ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- 2. Matriks Keputusan Awal (Xij) --}}
                    <section class="mb-8">
                        <h3 class="text-xl font-medium text-gray-700 mb-3">2. Matriks Keputusan Awal (X<sub>ij</sub>)</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Alternatif (Ikan)</th>
                                        @foreach($allCriteria as $crit)
                                            <th class="border px-3 py-2 text-center" title="{{ $crit->NAME }} ({{ $crit->TYPE }})">
                                                {{ $crit->CRITERIA_ID }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allAlternatives as $alt)
                                        <tr>
                                            <td class="border px-3 py-2 font-medium">
                                                {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}</td>
                                            @foreach($allCriteria as $crit)
                                                <td class="border px-3 py-2 text-center">
                                                    {{ number_format($initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0, 2) }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- 3. Normalisasi Matriks (X*ij) --}}
                    <section class="mb-8">
                        <h3 class="text-xl font-medium text-gray-700 mb-3">3. Matriks Ternormalisasi (X*<sub>ij</sub>)</h3>
                        <p class="text-xs text-gray-600 mb-1">Rumus: X*<sub>ij</sub> = X<sub>ij</sub> / &radic;(&sum;
                            X<sub>ij</sub><sup>2</sup>)</p>
                        <div class="overflow-x-auto mb-3">
                            <span class="text-sm font-medium text-gray-600">Nilai Pembagi (&radic;(&sum;
                                X<sub>ij</sub><sup>2</sup>)):</span>
                            <table class="min-w-full border border-gray-300 text-sm mt-1">
                                <thead class="bg-gray-50">
                                    <tr>
                                        @foreach($allCriteria as $crit)
                                            <th class="border px-3 py-1 text-center">{{ $crit->CRITERIA_ID }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($allCriteria as $crit)
                                            <td class="border px-3 py-1 text-center">
                                                {{ number_format($denominatorSquares[$crit->CRITERIA_ID] ?? 0, 4) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Alternatif (Ikan)</th>
                                        @foreach($allCriteria as $crit)
                                            <th class="border px-3 py-2 text-center" title="{{ $crit->NAME }}">
                                                {{ $crit->CRITERIA_ID }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allAlternatives as $alt)
                                        <tr>
                                            <td class="border px-3 py-2 font-medium">
                                                {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}</td>
                                            @foreach($allCriteria as $crit)
                                                <td class="border px-3 py-2 text-center">
                                                    {{ number_format($normalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0, 4) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- 4. Matriks Ternormalisasi Terbobot (Yij) --}}
                    <section class="mb-8">
                        <h3 class="text-xl font-medium text-gray-700 mb-3">4. Matriks Ternormalisasi Terbobot (Y<sub>ij</sub>)
                        </h3>
                        <p class="text-xs text-gray-600 mb-1">Rumus: Y<sub>ij</sub> = W<sub>j</sub> * X*<sub>ij</sub></p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Alternatif (Ikan)</th>
                                        @foreach($allCriteria as $crit)
                                            <th class="border px-3 py-2 text-center" title="{{ $crit->NAME }}">
                                                {{ $crit->CRITERIA_ID }} (W={{$userWeights[$crit->CRITERIA_ID] ?? 'N/A' }})</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allAlternatives as $alt)
                                        <tr>
                                            <td class="border px-3 py-2 font-medium">
                                                {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}</td>
                                            @foreach($allCriteria as $crit)
                                                <td class="border px-3 py-2 text-center">
                                                    {{ number_format($weightedNormalizedMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0, 4) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- 5. Perhitungan Nilai Optimasi (Yi) dan Peringkat Akhir --}}
                    <section class="mb-8">
                        <h3 class="text-xl font-medium text-gray-700 mb-3">5. Perhitungan Nilai Optimasi (Y<sub>i</sub>) dan
                            Peringkat</h3>
                        <p class="text-xs text-gray-600 mb-1">Rumus: Y<sub>i</sub> = (&sum; Y<sub>ij</sub> untuk Kriteria
                            Benefit) - (&sum; Y<sub>ij</sub> untuk Kriteria Cost)</p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border px-3 py-2 text-left">Alternatif (Ikan)</th>
                                        <th class="border px-3 py-2 text-center">&sum; Benefit</th>
                                        <th class="border px-3 py-2 text-center">&sum; Cost</th>
                                        <th class="border px-3 py-2 text-center">Nilai Y<sub>i</sub> (Skor Akhir)</th>
                                        <th class="border px-3 py-2 text-center">Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Buat array skor dan peringkat dari $rankedFishDetailsForCalc untuk mudah di-lookup
                                        $finalScoresLookup = [];
                                        $finalRankingLookup = [];
                                        foreach ($rankedFishDetailsForCalc as $detail) {
                                            $finalScoresLookup[$detail->FISH_ID] = $detail->SCORE;
                                            $finalRankingLookup[$detail->FISH_ID] = $detail->RANKING;
                                        }
                                    @endphp
                                    @foreach($allAlternatives as $alt)
                                        <tr>
                                            <td class="border px-3 py-2 font-medium">
                                                {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}</td>
                                            <td class="border px-3 py-2 text-center">
                                                {{ number_format($benefitCostSums[$alt->FISH_ID]['benefit'] ?? 0, 4) }}</td>
                                            <td class="border px-3 py-2 text-center">
                                                {{ number_format($benefitCostSums[$alt->FISH_ID]['cost'] ?? 0, 4) }}</td>
                                            <td class="border px-3 py-2 text-center font-semibold">
                                                {{ number_format($finalScoresLookup[$alt->FISH_ID] ?? 0, 4) }}</td>
                                            <td class="border px-3 py-2 text-center font-semibold">
                                                {{ $finalRankingLookup[$alt->FISH_ID] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            @endif
            {{-- Akhir Bagian Detail Kalkulasi MOORA --}}


            {{-- Bagian Rekomendasi Ikan (kode Anda sebelumnya) --}}
            <div class="bg-blue-600 text-white"> {{-- Ubah bg-gray-100 menjadi bg-blue-600 di sini jika ingin background
                biru untuk hasil --}}
                @if($top1FishDetail && $top1FishDetail->fish)
                    @php
                        $topFish = $top1FishDetail->fish;
                        $imagePath = $topFish->IMAGE_PATH ?? 'default-fish.jpg';
                        if (Illuminate\Support\Str::startsWith($imagePath, 'storage/')) {
                            $imageUrl = Storage::url(substr($imagePath, strlen('storage/')));
                        } else {
                            $imageUrl = asset($imagePath);
                        }
                    @endphp
                    <div class="bg-blue-700 p-6 sm:p-8 rounded-xl shadow-2xl flex flex-col md:flex-row items-center mb-12">
                        <div class="md:w-1/3 w-full mb-6 md:mb-0 md:mr-8 flex-shrink-0">
                            <img src="{{ $imageUrl }}" alt="{{ $topFish->NAME ?? 'Ikan Pilihan' }}" {{-- Ganti NAMA_IKAN menjadi
                                NAME jika itu nama kolomnya --}}
                                class="w-full h-auto object-cover rounded-lg shadow-md mb-4 aspect-[4/3]">
                            <div class="text-center mt-2 text-xs text-blue-300">Peringkat: {{ $top1FishDetail->RANKING }} |
                                Skor: {{ number_format($top1FishDetail->SCORE, 4) }}</div>
                        </div>
                        <div class="md:w-2/3 w-full text-center md:text-left">
                            <h1 class="text-3xl sm:text-4xl font-bold mb-3 leading-tight">
                                Ikan paling cocok untuk Anda, adalah <span
                                    class="text-yellow-300">{{ $topFish->NAME ?? 'Ikan Pilihan' }}</span>! {{-- Ganti NAMA_IKAN
                                --}}
                            </h1>
                            <p class="text-blue-200 mb-6 text-sm sm:text-base leading-relaxed">
                                {{ $topFish->DESCRIPTION ?? 'Deskripsi ikan ini belum tersedia.' }} {{-- Ganti DESKRIPSI_SINGKAT
                                menjadi DESCRIPTION jika itu nama kolomnya --}}
                            </p>
                            @if(Route::has('user.fish_detail'))
                                <a href="{{ route('user.fish_detail', ['id' => $topFish->FISH_ID]) }}"
                                    class="inline-flex items-center bg-white text-blue-600 font-semibold py-2 px-5 sm:py-3 sm:px-6 rounded-lg shadow-md hover:bg-gray-100 transition duration-150 ease-in-out text-sm sm:text-base">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            @endif
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
                        <h2 class="text-2xl font-semibold mb-6 text-center text-white">Ikan lain yang dapat dipertimbangkan</h2>
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
                                            {{ number_format($detail->SCORE, 4) }}</div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            {{-- Tombol Ulangi Kuesioner di Bawah --}}
            @if($top1FishDetail)
                <div class="text-center mt-12">
                    <a href="{{ route('user.dss') }}" class="text-blue-600 hover:text-blue-800 underline">
                        Ulangi Kuesioner atau Kembali
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .aspect-\[4\/3\] {
            /* Ganti ke class yang ada atau pastikan Tailwind JIT aktif */
            padding-bottom: 75%;
            /* Fallback jika aspect-ratio via class tidak didukung */
        }

        /* Tailwind V3 mendukung kelas aspect-ratio seperti aspect-video, aspect-square.
           Jika Anda menggunakan Tailwind V2 atau konfigurasi tanpa JIT,
           Anda mungkin perlu mendefinisikan kelas aspek rasio kustom di tailwind.config.js
           atau menggunakan padding-bottom trick seperti di atas.
           Untuk Tailwind V3 dengan JIT, class seperti `aspect-[4/3]` seharusnya bekerja.
        */
    </style>
@endpush