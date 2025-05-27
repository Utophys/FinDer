<!-- Include Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<nav class="bg-white shadow-md py-6 px-8 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
    <!-- Left: FinDer Logo -->
    <a href="{{ route('homepage') }}" class="flex items-center">
        <img src="{{ asset('assets/images/FinDer-Logos.svg') }}" alt="FinDer Logo" class="h-12 max-h-full object-contain">
    </a>

    <!-- Right: User Info with Dropdown -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <span class="text-gray-700 font-medium">
                @auth
                {{ Auth::user()->DISPLAY_NAME }}
                @else
                Guest
                @endauth
            </span>
            <img src="{{ asset('assets/images/icon-user.svg') }}" alt="User Icon" class="h-8 w-8 rounded-full">
        </button>


        <!-- Dropdown Menu -->
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
            @auth

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
            @else
            <a href="{{ route('auth.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-black no-underline">
                Login
            </a>
            @endauth
        </div>
    </div>

</nav>