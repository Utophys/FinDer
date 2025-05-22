<!-- resources/views/partials/header.blade.php -->
<nav class="bg-white shadow-md py-6 px-8 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
    <!-- Left: FinDer Logo -->
    <div class="flex items-center">
        <img src="{{ asset('assets/images/FinDer-Logos.svg') }}" alt="FinDer Logo" class="h-12 max-h-full object-contain">
    </div>
    <!-- Right: User Info -->
    <div class="flex items-center space-x-4">
        <span class="text-gray-700 font-medium">Ask D. Question</span>
        <img src="{{ asset('assets/images/icon-user.svg') }}" alt="User Icon" class="h-8 w-8 rounded-full">
    </div>
</nav>
