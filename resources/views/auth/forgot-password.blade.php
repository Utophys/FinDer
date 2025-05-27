@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto pt-32">
    <h2 class="text-2xl font-bold mb-4">Forgot Password</h2>

    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mb-4" required>

        <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">Send Reset Link</button>
    </form>
</div>
@endsection
