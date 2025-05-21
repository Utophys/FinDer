@extends('layouts.app')

@section('content')
    <div class="flex w-full h-screen">
        <!-- Sidebar kiri -->
        <div class="bg-white w-[30%] h-full p-6 flex flex-col items-center justify-center">
            <img src="{{ asset('img/finder-logo.png') }}" alt="finder-logo" class="w-1/2 mb-4">
            <h1 class="text-2xl font-semibold text-center">Hello, admin! :D</h1>
        </div>

        <!-- Konten kanan -->
        <div class="bg-[#0E87CC] w-[70%] h-full overflow-y-auto p-8 text-white">
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
                                                            {{ $fish['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-white' }}">

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
                    @endforeach
                </div>
            </div>

            <!-- Data Makanan -->
            <div class="mt-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Data Makanan</h2>
                    <button class="bg-white text-[#0E87CC] px-4 py-2 rounded hover:bg-gray-200 transition"
                        data-bs-toggle="modal" data-bs-target="#createFoodModal">+ Tambah Makanan</button>
                </div>

                <div class="flex flex-wrap gap-6">
                    @foreach($foods as $food)
                                <div
                                    class="text-gray-800 w-64 rounded-lg shadow p-4 
                                                                                                                                    {{ $food['IS_DELETED'] == 1 ? 'bg-red-500 text-white' : 'bg-white' }}">
                                    <h3 class="text-lg font-semibold">{{ $food['NAME'] }}</h3>
                                    <p class="text-sm"><strong>ID:</strong> {{ $food['FOOD_ID'] }}</p>
                                    <p class="text-sm"><strong>Deskripsi:</strong> {{ $food['DESCRIPTION'] }}</p>
                                    <p class="text-sm"><strong>Status:</strong> {{ $food['IS_DELETED'] }}</p>

                                    <div class="my-3">
                                        @if(!empty($food['IMAGE']))
                                            <img src="{{ asset('storage/' . $food['IMAGE']) }}" class="w-full rounded" alt="food image">
                                        @else
                                            <p class="italic text-sm text-gray-500 {{ $food['IS_DELETED'] == 1 ? 'text-white/80' : '' }}">
                                                Tidak ada gambar
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex justify-between">
                                        <!-- Edit button -->
                                        <button class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600"
                                            data-bs-toggle="modal" data-bs-target="#editFoodModal{{ $food->FOOD_ID }}">
                                            Edit
                                        </button>

                                        <!-- Delete/Recover form -->
                                        <form action="{{ $food['IS_DELETED'] == 1
                        ? route('admin.food.recover', $food->FOOD_ID)
                        : route('admin.food.softDelete', $food->FOOD_ID) }}" method="POST"
                                            onsubmit="return confirm('{{ $food['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="{{ $food['IS_DELETED'] == 1
                        ? 'bg-green-600 hover:bg-green-700'
                        : 'bg-red-600 hover:bg-red-700' }} text-white px-3 py-1 rounded text-sm">
                                                {{ $food['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                <!-- Edit Food Modal (opsional ditambahkan jika perlu) -->
                    @endforeach
                </div>
            </div>

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


    <div class="modal fade" id="createFoodModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.food.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Makanan Baru</h5>
                    </div>
                    <div class="modal-body text-black">
                        <input type="text" name="NAME" class="form-control mt-2" placeholder="Nama" required>
                        <input type="text" name="IMAGE" class="form-control mt-2" placeholder="Image URL (opsional)">
                        <textarea name="DESCRIPTION" class="form-control mt-2"
                            placeholder="Deskripsi (opsional)"></textarea>
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