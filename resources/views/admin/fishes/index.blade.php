@extends('layouts.admin.app')

@section('content')
<div class="mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Data Ikan Alternatif</h2>
        <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition"
            data-bs-toggle="modal" data-bs-target="#createIkanModal">+ Tambah Ikan</button>
    </div>

    <div class="flex flex-wrap gap-6">
        @foreach($fishes as $fish)
        <div
            class="text-gray-800 w-64 rounded-lg shadow p-4 
                                                                                                                                                                                                    {{ 
                                                                                                                                            $fish['IS_DELETED'] == 1 && $fish['IS_VERIFIED'] == 1 ? 'bg-red-500 text-white' :
                        ($fish['IS_DELETED'] == 0 && $fish['IS_VERIFIED'] == 1 ? 'bg-white text-black' :
                            ($fish['IS_DELETED'] == 0 && $fish['IS_VERIFIED'] == 0 ? 'bg-yellow-200 text-black' :
                                'bg-red-500 text-white')) 
                                                                                                                                        }}">

            <h3 class="text-lg font-semibold">{{ $fish['NAME'] }}</h3>
            <div class="my-3">
                @if(!empty($fish['IMAGE']))
                <img src="{{ url($fish['IMAGE']) }}" class="w-full h-40 object-cover rounded" alt="fish image">
                @else
                <p class="italic text-sm {{ $fish['IS_DELETED'] == 1 ? 'text-white/80' : 'text-gray-500' }}">
                    Tidak ada gambar
                </p>
                @endif
            </div>
            <p class="text-sm"><strong>ID:</strong> {{ $fish['FISH_ID'] }}</p>
            <p class="text-sm"><strong>Deskripsi:</strong> {{ $fish['DESCRIPTION'] }}</p>
            <p class="text-sm"><strong>Makanan Terkait:</strong> {{ $fish['FOOD_ID'] }}</p>



            <div class="flex justify-between">
                <!-- Edit button -->
                <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600"
                    data-bs-toggle="modal" data-bs-target="#editIkanModal{{ $fish->FISH_ID }}">
                    Edit
                </button>
                <!-- Tombol Verify -->
                @if($fish['IS_VERIFIED'] == 0)
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm"
                    data-bs-toggle="modal" data-bs-target="#verifyIkanModal{{ $fish['FISH_ID'] }}">
                    Verify
                </button>
                @else
                <button class="bg-gray-400 text-white px-3 py-1 rounded text-sm cursor-not-allowed" disabled>
                    Verified
                </button>
                @endif
                <!-- Modal untuk verifikasi ikan ini -->
                <div class="modal fade" id="verifyIkanModal{{ $fish['FISH_ID'] }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="{{ route('admin.ikan.verify', $fish['FISH_ID']) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Verifikasi Ikan: {{ $fish->NAME }}</h5>
                                </div>
                                <div class="modal-body text-black">
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
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Submit Verifikasi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if($fish['IS_DELETED'] == 0)
                <!-- Delete form -->
                <form action="{{ route('admin.ikan.softDelete', $fish->FISH_ID) }}" method="POST"
                    onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                        Delete
                    </button>
                </form>
                @else
                <!-- Recover form -->
                <form action="{{ route('admin.ikan.recover', $fish->FISH_ID) }}" method="POST"
                    onsubmit="return confirm('Pulihkan data ini?')">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                        Recover
                    </button>
                </form>
                @endif
            </div>
        </div>
        <div class="modal fade" id="editIkanModal{{ $fish->FISH_ID }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.ikan.update', $fish->FISH_ID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Ikan: {{ $fish->NAME }}</h5>
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
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Create Ikan Modal -->
<div class="modal fade" id="createIkanModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.ikan.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Ikan Baru</h5>
                </div>
                <div class="modal-body text-black">
                    <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required>

                    <div class="mb-4 mt-2">
                        <label class="block text-gray-700 font-semibold mb-2" for="image">Gambar Ikan</label>
                        <input type="file" id="image" name="IMAGE" accept="image/*" class="w-full p-2 border rounded"
                            required>
                    </div>

                    <textarea name="DESCRIPTION" class="form-control mt-2" placeholder="Deskripsi"></textarea>
                    <select name="FOOD_ID" class="form-control mt-2">
                        @foreach ($foods as $food)
                        <option value="{{ $food->FOOD_ID }}">{{ $food->NAME }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection