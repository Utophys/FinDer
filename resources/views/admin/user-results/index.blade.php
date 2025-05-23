@extends('layouts.admin.app')

@section('content')
    <div class="mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Data Hasil SPK</h2>
        </div>

        <div class="flex flex-col gap-6">
            @foreach($results as $result)
                <div>
                    <!-- Kartu utama yang bisa diklik -->
                    <div class="cursor-pointer text-gray-800 w-full rounded-lg shadow p-4 bg-white items-center"
                        data-bs-toggle="collapse" data-bs-target="#collapseResult{{ $loop->index }}" aria-expanded="false"
                        aria-controls="collapseResult{{ $loop->index }}">
                        <div class="flex flex-row justify-between">
                            <h3 class="text-lg font-semibold">{{ $result['USER_ID'] }}</h3>
                            <div class="flex flex-row gap-2">
                                <h3 class="text-lg font-semibold">{{ $result['TIME_ADDED'] }}</h3>
                                <h3 class="text-lg font-semibold">-</h3>
                                <h3 class="text-lg font-semibold text-blue-400">{{ $result['RESULT_ID'] }}</h3>
                            </div>
                        </div>
                        @if (count($result['masterCriteria']))
                            <ul class="list-disc ml-6">
                                @foreach ($result['masterCriteria'] as $criteria)
                                    <li>Weight Text: {{ $criteria['WEIGHT_TXT'] }} - Weight Int: {{ $criteria['WEIGHT_INT'] }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada master criteria.</p>
                        @endif


                        @if (count($result['details']))
                            <ul class="list-disc ml-6">
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
    </div>
@endsection