@extends('layouts.admin.app')

@section('title', 'Hasil dan Detail Perhitungan Rekomendasi Ikan')

@section('content')
<div class="p-6">
    <button onclick="history.back()"
        class="mb-6 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 
               text-white font-semibold rounded-lg shadow-lg 
               hover:from-indigo-600 hover:to-blue-500 
               transform hover:-translate-y-1 hover:scale-105 
               transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500">
        ← Kembali
    </button>
</div>


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
$rankedFishDetailsForCalc = $calculationData['rankedFishDetails'];

// Mapping nama alternatif untuk kemudahan tampilan
$alternativeNames = $allAlternatives->pluck('NAME', 'FISH_ID'); 
$criteriaNames = $allCriteria->pluck('NAME', 'CRITERIA_ID');
$criteriaTypes = $allCriteria->pluck('TYPE', 'CRITERIA_ID');
@endphp

<div class="bg-white p-6 rounded-lg shadow-xl mb-10 text-gray-900">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Detail Perhitungan MOORA (Result ID:
        {{ $resultId }})
    </h2>

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
                            {{ $crit->CRITERIA_ID }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($allAlternatives as $alt)
                    <tr>
                        <td class="border px-3 py-2 font-medium">
                            {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}
                        </td>
                        @foreach($allCriteria as $crit)
                        <td class="border px-3 py-2 text-center">
                            {{ number_format($initialMatrix[$alt->FISH_ID][$crit->CRITERIA_ID] ?? 0, 2) }}
                        </td>
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
                            {{ number_format($denominatorSquares[$crit->CRITERIA_ID] ?? 0, 4) }}
                        </td>
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
                            {{ $crit->CRITERIA_ID }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($allAlternatives as $alt)
                    <tr>
                        <td class="border px-3 py-2 font-medium">
                            {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}
                        </td>
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
                            {{ $crit->CRITERIA_ID }} (W={{$userWeights[$crit->CRITERIA_ID] ?? 'N/A' }})
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($allAlternatives as $alt)
                    <tr>
                        <td class="border px-3 py-2 font-medium">
                            {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}
                        </td>
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
                            {{ $alternativeNames[$alt->FISH_ID] ?? $alt->FISH_ID }}
                        </td>
                        <td class="border px-3 py-2 text-center">
                            {{ number_format($benefitCostSums[$alt->FISH_ID]['benefit'] ?? 0, 4) }}
                        </td>
                        <td class="border px-3 py-2 text-center">
                            {{ number_format($benefitCostSums[$alt->FISH_ID]['cost'] ?? 0, 4) }}
                        </td>
                        <td class="border px-3 py-2 text-center font-semibold">
                            {{ number_format($finalScoresLookup[$alt->FISH_ID] ?? 0, 4) }}
                        </td>
                        <td class="border px-3 py-2 text-center font-semibold">
                            {{ $finalRankingLookup[$alt->FISH_ID] ?? 'N/A' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endif

@endsection