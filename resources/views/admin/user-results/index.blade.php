@extends('layouts.admin.app')

@section('content')
<div class="mt-10 px-4">
    <div class="mb-6">
        <h1 class="font-bold animate__animated animate__fadeInDown">Data Hasil SPK</h>
    </div>

    @foreach($results as $result)
    <div class="bg-white text-black p-4 mb-4 rounded-lg shadow-md cursor-pointer transition hover:shadow-lg" onclick="toggleDetail(this)">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="font-semibold text-lg">{{ $result['USER_ID'] }}</h3>
                <p class="text-sm text-gray-600">{{ $result['TIME_ADDED'] }} - <span class="text-blue-500">{{ $result['RESULT_ID'] }}</span></p>
            </div>
            <div class="icon text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 icon-toggle" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </div>
        </div>

        <div class="detail mt-2 hidden">
            @if (count($result['masterCriteria']))
            <ul class="list-disc ml-5 text-sm text-gray-700">
                @foreach ($result['masterCriteria'] as $criteria)
                <li>Weight Text: {{ $criteria['WEIGHT_TXT'] }} - Weight Int: {{ $criteria['WEIGHT_INT'] }}</li>
                @endforeach
            </ul>
            @else
            <p class="text-sm text-gray-500">Tidak ada master criteria.</p>
            @endif

            @if (count($result['details']))
            <ul class="list-disc ml-5 text-sm text-gray-700 mt-2">
                @foreach ($result['details'] as $detail)
                <li>Ikan: {{ $detail['FISH_ID'] }} - Rank: {{ $detail['RANKING'] }}</li>
                @endforeach
            </ul>
            @else
            <p class="text-sm text-gray-500">Tidak ada detail.</p>
            @endif
        </div>
    </div>
    @endforeach
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

