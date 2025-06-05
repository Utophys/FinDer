@extends('layouts.setpass')

@section('content')

<div class="max-w-md mx-auto pt-32 px-6">
    <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Reset Password</h2>

    @if(session('status'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-6 text-center font-medium">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="bg-white shadow-md rounded-lg p-8 space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div>
            <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                class="w-full border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed text-gray-600 px-4 py-2"
                required
                readonly
                value="{{ old('email', $email ?? '') }}">
        </div>

        <div>
            <label for="password" class="block mb-2 font-medium text-gray-700">New Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div>
            <label for="password_confirmation" class="block mb-2 font-medium text-gray-700">Confirm Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-md transition duration-300">
            Reset Password
        </button>
    </form>
</div>
@endsection