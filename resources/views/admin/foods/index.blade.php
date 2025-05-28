@extends('layouts.admin.app')

@section('content')
<div class="mt-10 px-4">
    <div class="flex justify-between items-center mb-6 px-18">
        <h1 class="font-bold">Data Makanan</h1>
        <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition" data-bs-toggle="modal" data-bs-target="#createFoodModal">+ Tambah Makanan</button>
    </div>

    {{-- Added justify-center max-w-7xl mx-auto like fishes page --}}
    <div class="flex flex-wrap gap-6 justify-center max-w-7xl mx-auto">
        @foreach($foods as $food)
        {{-- Applied card structure from fishes page: min-h, flex, flex-col --}}
        <div class="text-gray-800 w-64 min-h-[400px] rounded-lg shadow p-4 flex flex-col {{ $food['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-white' }}">

            <div class="overflow-hidden whitespace-nowrap mb-2 title-container">
                <h3 class="text-lg font-semibold inline-block" data-food-name="{{ $food['NAME'] }}">{{ $food['NAME'] }}</h3>
            </div>

            <div class="w-full h-40 bg-gray-200 rounded mb-4 flex items-center justify-center">
                @if(!empty($food['IMAGE']))
                <img src="{{ url($food['IMAGE']) }}" class="w-full h-full object-cover rounded" alt="food image">
                @else
                <p class="italic text-sm {{ $food['IS_DELETED'] == 1 ? 'text-white/80' : 'text-gray-500' }}">
                    Tidak ada gambar
                </p>
                @endif
            </div>

            {{-- Applied flex-grow and space-y like fishes page --}}
            <div class="space-y-2 mb-4 flex-grow">
                <p class="text-sm"><strong>ID:</strong> {{ $food['FOOD_ID'] }}</p>
                {{-- Added line-clamp-3 for description like fishes page --}}
                <p class="text-sm line-clamp-3"><strong>Deskripsi:</strong> {{ $food['DESCRIPTION'] }}</p>
                <p class="text-sm"><strong>Status Deletion:</strong> {{ $food['IS_DELETED'] == 1 ? 'Dihapus' : 'Aktif' }}</p>
            </div>

            {{-- Applied button container structure from fishes page --}}
            <div class="flex justify-between items-center gap-2 mt-auto">
                <button class="bg-yellow-500 text-white py-1 rounded text-sm hover:bg-yellow-600 flex-1 text-center"
                        data-bs-toggle="modal" data-bs-target="#editFoodModal{{ $food->FOOD_ID }}">
                    Edit
                </button>

                <form action="{{ $food['IS_DELETED'] == 1
                                ? route('admin.food.recover', $food->FOOD_ID)
                                : route('admin.food.softDelete', $food->FOOD_ID) }}" method="POST"
                      onsubmit="return confirm('{{ $food['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')" class="inline flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="{{ $food['IS_DELETED'] == 1
                                    ? 'bg-green-600 hover:bg-green-700'
                                    : 'bg-red-600 hover:bg-red-700' }} text-white py-1 rounded text-sm w-full text-center">
                        {{ $food['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
                    </button>
                </form>
            </div>
        </div>

        {{-- Modal Edit Food --}}
        <div class="modal fade" id="editFoodModal{{ $food->FOOD_ID }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST" action="{{ route('admin.food.update', $food->FOOD_ID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-black">Edit Makanan: {{ $food->NAME }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-black">
                            <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required value="{{ old('NAME', $food->NAME) }}">
                            <div class="mb-4 mt-2">
                                <label class="block text-gray-700 font-semibold mb-2" for="imageEditFood{{ $food->FOOD_ID }}">Gambar Makanan (kosongkan jika tidak ingin ganti)</label>
                                <input type="file" id="imageEditFood{{ $food->FOOD_ID }}" name="IMAGE" accept="image/*" class="w-full p-2 border rounded">
                                @if(!empty($food->IMAGE))
                                <img src="{{ url($food->IMAGE) }}" class="w-full h-40 object-cover rounded mt-2" alt="food image">
                                @endif
                            </div>
                            <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi">{{ old('DESCRIPTION', $food->DESCRIPTION) }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Modal Create Food --}}
<div class="modal fade" id="createFoodModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.food.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black">Tambah Makanan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required>

                    <div class="mb-4 mt-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="imageFood">Gambar Makanan</label>
                        <input type="file" id="imageFood" name="IMAGE" accept="image/*" class="w-full p-2 border rounded" required> {{-- Kept required based on previous food page logic --}}
                    </div>

                    <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .title-container {
        position: relative;
        overflow: hidden;
    }

    .title-container h3 {
        white-space: nowrap;
        display: inline-block;
    }

    .marquee {
        animation: marquee 5s linear infinite;
    }

    .title-container:hover h3.overflow {
        animation: marquee 5s linear infinite;
    }

    .title-container:not(:hover) h3.overflow {
        animation: none;
        transform: translateX(0);
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }
        10% {
            transform: translateX(0); /* Delay awal */
        }
        90% {
            transform: translateX(calc(-100%));
        }
        100% {
            transform: translateX(calc(-100%)); /* Delay akhir */
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const titleContainers = document.querySelectorAll('.title-container h3');
        titleContainers.forEach(h3 => {
            const container = h3.parentElement;
            const isOverflowing = h3.scrollWidth > container.offsetWidth;
            if (isOverflowing) {
                h3.classList.add('overflow');
            }
        });
    });
</script>

@endsection
