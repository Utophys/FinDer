@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">🗑️ Trash Bin</h1>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Deleted Items</h6>
                    </div>
                    <div class="card-body">
                        @if($deletedAlternativeFish->isEmpty() && $deletedFood->isEmpty() && $deletedFishVarieties->isEmpty())
                            <p class="text-center text-muted">No deleted items found in the trash bin.</p>
                        @else
                            <div class="col">
                                @foreach($deletedAlternativeFish as $fish)
                                    <div class="mb-3">
                                        <div class="card border-left-danger h-100 flex flex-row justify-between">
                                            <div class="card-body flex flex-row">
                                                <div class="flex-shrink-0 mr-3" style="width: 64px; height: 64px;">
                                                    @if($fish->image)
                                                        <img src="{{ $fish->image }}" class="w-full h-full object-cover rounded"
                                                            alt="{{ $fish->NAME }} image" style="width: 100%; height: 100%;">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light rounded"
                                                            style="width: 100%; height: 100%;">
                                                            <span class="text-muted small">No Image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="mb-2">
                                                        <h4 class="font-extrabold">Alternative Fish - {{ $fish->FISH_ID }}</h4>
                                                    </div>
                                                    <div class="flex justify-between max-w-xl">
                                                        <h6 class="card-title font-weight-bold">{{ $fish->NAME }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.ikan.recover', $fish->FISH_ID) }}" method="POST"
                                                onsubmit="return confirm('Pulihkan data ini?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white h-full px-3 py-1 rounded text-sm max-w-xs text-center">
                                                    Recover
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($deletedFood as $food)
                                    <div class="mb-3">
                                        <div class="card border-left-danger h-100 flex flex-row justify-between">
                                            <div class="card-body flex flex-row">
                                                <div class="flex-shrink-0 mr-3" style="width: 64px; height: 64px;">
                                                    @if($food->IMAGE)
                                                        <img src="{{ $food->IMAGE }}" class="w-full h-full object-cover rounded"
                                                            alt="{{ $food->NAME }} image" style="width: 100%; height: 100%;">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light rounded"
                                                            style="width: 100%; height: 100%;">
                                                            <span class="text-muted small">No Image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="mb-2">
                                                        <h4 class="font-extrabold">Fish Food - {{ $food->FOOD_ID }}</h4>
                                                    </div>
                                                    <div class="flex justify-between max-w-xl">
                                                        <h6 class="card-title font-weight-bold">{{ $food->NAME }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.food.recover', $food->FOOD_ID) }}" method="POST"
                                                onsubmit="return confirm('Pulihkan data ini?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white h-full px-3 py-1 rounded text-sm max-w-xs text-center">
                                                    Recover
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach($deletedFishVarieties as $variety)
                                    <div class="mb-3">
                                        <div class="card border-left-danger h-100 flex flex-row justify-between">
                                            <div class="card-body flex flex-row">
                                                <div class="flex-shrink-0 mr-3" style="width: 64px; height: 64px;">
                                                    @if($variety->IMAGE)
                                                        <img src="{{ $variety->IMAGE }}" class="w-full h-full object-cover rounded"
                                                            alt="{{ $variety->NAME }} image" style="width: 100%; height: 100%;">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light rounded"
                                                            style="width: 100%; height: 100%;">
                                                            <span class="text-muted small">No Image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="mb-2">
                                                        <h4 class="font-extrabold">Fish Variety - {{ $variety->FISH_VARIETY_ID }}
                                                        </h4>
                                                    </div>
                                                    <h6 class="card-title font-weight-bold">{{ $variety->VARIETY_NAME }} -
                                                        {{ $variety->fish ? $variety->fish->NAME : 'N/A' }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.varieties.recover', $variety->FISH_VARIETY_ID) }}" method="POST"
                                                onsubmit="return confirm('Pulihkan data ini?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-700 text-white h-full px-3 py-1 rounded text-sm max-w-xs text-center">
                                                    Recover
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--
    Pastikan controller Anda mengirimkan variabel-variabel berikut ke view ini:
    $deletedAlternativeFish: Collection dari model ALTERNATIVE_FISH dimana is_deleted = 1
    $deletedFood: Collection dari model FOOD dimana is_deleted = 1
    $deletedFishVarieties: Collection dari model FISH_VARIETY dimana is_deleted = 1
    (Pastikan untuk melakukan Eager load relasi 'alternativeFish')

    Controller tidak perlu diubah dari versi sebelumnya yang mengirimkan ketiga collection tersebut secara terpisah.
    --}}
@endsection