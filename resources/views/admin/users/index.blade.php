@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">🗣️Kelola Pengguna</h1>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Deleted Items</h6>
                    </div>
                    <div class="card-body">
                        @if($users->isEmpty())
                            <p class="text-center text-muted">No deleted items found in the trash bin.</p>
                        @else
                            <div class="col">
                                @foreach($users as $user)
                                                <div class="mb-3">
                                                    <div class="card border-left-danger h-100 flex flex-row justify-between">
                                                        <div class="card-body flex flex-row">
                                                            <div class="flex-shrink-0 mr-3" style="width: 64px; height: 64px;">
                                                                @if($user->IMAGE)
                                                                    <img src="{{ $user->IMAGE }}" class="w-full h-full object-cover rounded"
                                                                        alt="{{ $user->NAME }} image" style="width: 100%; height: 100%;">
                                                                @else
                                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light rounded"
                                                                        style="width: 100%; height: 100%;">
                                                                        <span class="text-muted small">No Image</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div class="mb-2">
                                                                    <h4 class="font-extrabold">User Accounts - {{ $user->USER_ID }}</h4>
                                                                </div>
                                                                <div class="flex justify-between max-w-xl">
                                                                    <h6 class="card-title font-weight-bold">{{ $user->NAME }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ $user['IS_DELETED'] == 1
                                    ? route('admin.user.recover', $user->USER_ID)
                                    : route('admin.user.softDelete', $user->USER_ID) }}" method="POST"
                                                            onsubmit="return confirm('{{ $user['IS_DELETED'] == 1 ? 'Pulihkan data ini?' : 'Hapus data makanan ini?' }}')">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="{{ $user['IS_DELETED'] == 1
                                    ? 'bg-green-600 hover:bg-green-700'
                                    : 'bg-red-600 hover:bg-red-700' }} h-full px-3 py-1 rounded text-sm max-w-xs text-center">
                                                                {{ $user['IS_DELETED'] == 1 ? 'Recover' : 'Delete' }}
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
@endsection