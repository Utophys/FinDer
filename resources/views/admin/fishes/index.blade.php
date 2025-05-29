<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

@extends('layouts.admin.app')

@section('content')
<div class="mt-10 px-4">
    <div class="flex justify-between items-center mb-6 px-18">
        <h1 class="font-bold">Data Alternatif Ikan</h1>
        <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition" data-bs-toggle="modal" data-bs-target="#createIkanModal">+ Tambah Ikan</button>
    </div>

    <div class="flex flex-wrap gap-6 justify-center max-w-7xl mx-auto">
        @foreach($fishes as $fish)
        <div class="w-64 rounded-lg shadow p-4 flex flex-col min-h-[400px]
            {{
                $fish['IS_DELETED'] == 1 && $fish['IS_VERIFIED'] == 1 ? 'bg-red-500 text-white' :
                ($fish['IS_DELETED'] == 0 && $fish['IS_VERIFIED'] == 1 ? 'bg-white text-black' :
                ($fish['IS_DELETED'] == 0 && $fish['IS_VERIFIED'] == 0 ? 'bg-yellow-200 text-black' : 'bg-red-500 text-white'))
            }}">

            <div class="overflow-hidden whitespace-nowrap mb-2 title-container">
                <h3 class="text-lg font-semibold inline-block" data-fish-name="{{ $fish['NAME'] }}">{{ $fish['NAME'] }}</h3>
            </div>

            <div class="w-full h-40 bg-gray-200 rounded mb-4 flex items-center justify-center">
                @if(!empty($fish['IMAGE']))
                <img src="{{ url($fish['IMAGE']) }}" class="w-full h-full object-cover rounded" alt="fish image">
                @else
                <p class="italic text-sm {{ $fish['IS_DELETED'] == 1 ? 'text-white/80' : 'text-gray-500' }}">Tidak ada gambar</p>
                @endif
            </div>

            <div class="space-y-2 mb-4 flex-grow">
                <p class="text-sm"><strong>ID:</strong> {{ $fish['FISH_ID'] }}</p>
                <p class="text-sm"><strong>Deskripsi:</strong> {{ Str::limit($fish['DESCRIPTION'], 70) }}</p>
                <p class="text-sm"><strong>Makanan Terkait:</strong> {{ $fish['FOOD_ID'] }}</p>
            </div>

            <div class="flex justify-between items-center gap-2">
                <button class="bg-yellow-500 text-white py-1 rounded text-sm hover:bg-yellow-600 flex-1 text-center"
                    data-bs-toggle="modal" data-bs-target="#editIkanModal{{ $fish->FISH_ID }}">
                    Edit
                </button>
                @if($fish['IS_VERIFIED'] == 0)
                <button class="bg-[#0E87CC] hover:bg-gradient-to-r hover:from-[#1e40af] hover:to-[#0A6CA3] text-white py-1 rounded text-sm flex-1 text-center"
                    data-bs-toggle="modal" data-bs-target="#verifyIkanModal{{ $fish['FISH_ID'] }}">
                    Verify
                </button>
                @else
                <button class="bg-gray-400 text-white py-1 rounded text-sm cursor-not-allowed flex-1 text-center" disabled>
                    Verified
                </button>
                @endif
                @if($fish['IS_DELETED'] == 0)
                <form action="{{ route('admin.ikan.softDelete', $fish->FISH_ID) }}" method="POST"
                    onsubmit="return confirm('Hapus data ini?')" class="inline flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white py-1 rounded text-sm w-full text-center">
                        Delete
                    </button>
                </form>
                @else
                <form action="{{ route('admin.ikan.recover', $fish->FISH_ID) }}" method="POST"
                    onsubmit="return confirm('Pulihkan data ini?')" class="inline flex-1">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm w-full text-center">
                        Recover
                    </button>
                </form>
                @endif
            </div>
        </div>

        {{-- Modal Verify --}}
        <div class="modal fade" id="verifyIkanModal{{ $fish['FISH_ID'] }}" tabindex="-1" aria-labelledby="verifyIkanModalLabel{{ $fish['FISH_ID'] }}" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.ikan.verify', $fish['FISH_ID']) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-black" id="verifyIkanModalLabel{{ $fish['FISH_ID'] }}">Verifikasi Ikan: {{ $fish->NAME }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-black" style="max-height: 60vh; overflow-y: auto;">
                            @foreach($criterias as $criteria)
                            <div class="mb-3">
                                <label class="form-label font-semibold">Kriteria {{ $criteria['NAME'] }}</label>
                                <select name="criteria[{{ $criteria['CRITERIA_ID'] }}]" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Jawaban --</option>
                                    @switch(strtolower($criteria['NAME']))
                                    @case('harga')
                                    @case('biaya pemeliharaan')
                                    <option value="1">Sangat Mahal</option>
                                    <option value="2">Mahal</option>
                                    <option value="3">Menengah</option>
                                    <option value="4">Murah</option>
                                    @break

                                    @case('kompleksitas pemeliharaan')
                                    <option value="1">Sangat Sulit</option>
                                    <option value="2">Sulit</option>
                                    <option value="3">Standar</option>
                                    <option value="4">Mudah</option>
                                    @break

                                    @case('kelangkaan')
                                    <option value="1">Umum</option>
                                    <option value="2">Kadang</option>
                                    <option value="3">Jarang</option>
                                    <option value="4">Sangat Jarang</option>
                                    @break

                                    @case('ukuran')
                                    <option value="1">Besar</option>
                                    <option value="2">Sedang</option>
                                    <option value="3">Kecil</option>
                                    @break

                                    @case('estetika')
                                    <option value="1">Biasa saja</option>
                                    <option value="2">Indah</option>
                                    <option value="3">Mencolok</option>
                                    @break

                                    @case('perilaku')
                                    <option value="1">Liar/Agresif</option>
                                    <option value="2">Biasa saja</option>
                                    <option value="3">Jinak</option>
                                    @break

                                    @default
                                    <option value="1">Ya</option>
                                    <option value="2">Tidak</option>
                                    <option value="3">Tidak Tahu</option>
                                    @endswitch
                                </select>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Submit Verifikasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Edit Ikan --}}
        <div class="modal fade" id="editIkanModal{{ $fish->FISH_ID }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form method="POST" action="{{ route('admin.ikan.update', $fish->FISH_ID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-black">Edit Ikan: {{ $fish->NAME }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-black">
                            <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required value="{{ old('NAME', $fish->NAME) }}">

                            <div class="mb-4 mt-2">
                                <label class="block text-gray-700 font-semibold mb-2" for="imageEdit{{ $fish->FISH_ID }}">Gambar Ikan (kosongkan jika tidak ingin ganti)</label>
                                <input type="file" id="imageEdit{{ $fish->FISH_ID }}" name="IMAGE" accept="image/*" class="w-full p-2 border rounded">
                                @if(!empty($fish->IMAGE))
                                <img src="{{ url($fish->IMAGE) }}" class="w-full h-40 object-cover rounded mt-2" alt="fish image">
                                @endif
                            </div>

                            <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi">{{ old('DESCRIPTION', $fish->DESCRIPTION) }}</textarea>

                            <select name="FOOD_ID" class="form-control mt-2" required>
                                @foreach ($foods as $food)
                                <option value="{{ $food->FOOD_ID }}" {{ $food->FOOD_ID == old('FOOD_ID', $fish->FOOD_ID) ? 'selected' : '' }}>
                                    {{ $food->NAME }}
                                </option>
                                @endforeach
                            </select>
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

{{-- Modal Create Ikan --}}
<div class="modal fade" id="createIkanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.ikan.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-black">Tambah Ikan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required>

                    <div class="mb-4 mt-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="image">Gambar Ikan</label>
                        <input type="file" id="image" name="IMAGE" accept="image/*" class="w-full p-2 border rounded">
                    </div>

                    <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi"></textarea>
                    <select name="FOOD_ID" class="form-control mt-2">
                        <option value="" disabled selected>-- Pilih Makanan --</option>
                        @foreach ($foods as $food)
                        <option value="{{ $food->FOOD_ID }}">{{ $food->NAME }}</option>
                        @endforeach
                    </select>
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
