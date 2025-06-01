@extends('layouts.admin.app')

@section('content')
<div class="w-full h-screen bg-gradient-to-r from-blue-600 to-[#0E87CC] text-white p-6 overflow-y-auto">
    <div class="flex items-center space-x-3 mb-6 pt-8">
        <img src="{{ asset('assets/images/history-white-icon.svg') }}" class="w-7 h-7" alt="History">
        <h2 class="text-2xl font-bold animate__animated animate__fadeInDown">Histori SPK Pengguna</h2>
    </div>

    @if(isset($resultsWithDetails) && count($resultsWithDetails) > 0)
        @foreach ($resultsWithDetails as $entry)
            <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md cursor-pointer transition hover:shadow-lg" onclick="toggleDetail(this)">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <h2 class="text-xl font-bold mb-1">Pengguna: {{ $entry['user']->DISPLAY_NAME }}</h2>
                            <p class="text-sm text-gray-600">{{ $entry['user']->EMAIL }}</p>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('admin.user-results.admincalculation', ['result_id' => $entry['result']->RESULT_ID]) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Lihat Perhitungan
                        </a>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($entry['result']->TIME_ADDED)->timezone('Asia/Jakarta')->format('d - m - Y (H.i.s)') }}</p>
                    </div>
                    <div class="icon text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon-toggle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <div class="detail mt-2 hidden">
                    @foreach ($entry['details'] as $fish)
                        <div class="flex items-center mb-2">
                            <img src="{{ asset('storage/alternative_fishes/' . $fish->IMAGE) }}" alt="{{ $fish->fish_name }}" class="w-16 h-16 rounded-lg object-cover mr-4" />
                            <div>
                                <p class="font-semibold">Ikan #{{ $fish->RANKING }}: {{ $fish->fish_name }}</p>
                            </div>
                        </div>
                    @endforeach

                    @php
                        $questions = [
                            ['id' => 1, 'dbCriteriaId' => 'CRT00001', 'text' => 'Seberapa besar pengaruh harga awal ikan terhadap keputusan Anda?', 'meta' => 'Pertanyaan 1/7 - Nilai/Harga'],
                            ['id' => 2, 'dbCriteriaId' => 'CRT00002', 'text' => 'Memikirkan perawatan ikan, seberapa penting kemudahan dalam merawatnya?', 'meta' => 'Pertanyaan 2/7 - Kompleksitas Pemeliharaan'],
                            ['id' => 3, 'dbCriteriaId' => 'CRT00003', 'text' => 'Bagaimana pertimbangan Anda terhadap biaya rutin pemeliharaan ikan?', 'meta' => 'Pertanyaan 3/7 - Biaya Pemeliharaan'],
                            ['id' => 4, 'dbCriteriaId' => 'CRT00004', 'text' => 'Mengenai ukuran maksimal ikan dewasa, seberapa penting ini bagi Anda?', 'meta' => 'Pertanyaan 4/7 - Ukuran'],
                            ['id' => 5, 'dbCriteriaId' => 'CRT00005', 'text' => 'Seberapa menarik bagi Anda untuk memiliki ikan yang langka atau unik?', 'meta' => 'Pertanyaan 5/7 - Kelangkaan'],
                            ['id' => 6, 'dbCriteriaId' => 'CRT00006', 'text' => 'Seberapa besar peran keindahan visual ikan dalam pilihan Anda?', 'meta' => 'Pertanyaan 6/7 - Estetika'],
                            ['id' => 7, 'dbCriteriaId' => 'CRT00007', 'text' => 'Seberapa penting karakter atau tingkah laku unik ikan bagi Anda?', 'meta' => 'Pertanyaan 7/7 - Perilaku'],
                        ];

                        $criteriaMap = [];
                        foreach ($entry['criteria'] as $crit) {
                            $criteriaMap[$crit->CRITERIA_ID] = $crit;
                        }
                    @endphp

                    <div class="mt-4">
                        <h3 class="font-semibold mb-2">Pertanyaan & Jawaban</h3>
                        <div class="space-y-4">
                            @foreach ($questions as $q)
                                @php $answer = $criteriaMap[$q['dbCriteriaId']] ?? null; @endphp
                                <div class="bg-gray-100 p-3 rounded shadow-sm">
                                    <p class="text-sm font-medium text-gray-800">{{ $q['meta'] }}</p>
                                    <p class="text-sm text-gray-700">{{ $q['text'] }}</p>
                                    @if ($answer)
                                        <p class="mt-1 font-semibold text-blue-700">
                                            Jawaban: {{ $answer->WEIGHT_TXT }} (Nilai: {{ $answer->WEIGHT_INT }})
                                        </p>
                                    @else
                                        <p class="mt-1 italic text-gray-500">Belum ada jawaban.</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Tidak ada histori pengguna.</p>
    @endif
</div>

<script>
    function toggleDetail(card) {
        const detail = card.querySelector('.detail');
        const icon = card.querySelector('.icon-toggle');

        detail.classList.toggle('hidden');

        if (!detail.classList.contains('hidden')) {
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`;
        } else {
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
        }
    }
</script>
@endsection