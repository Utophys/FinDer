@extends('layouts.app')

@section('content')
<div id="page-wrapper" class="pt-24 transition-colors duration-500" style="background: transparent;">
    <section class="relative bg-white overflow-hidden h-[500px] md:h-[600px]">
        <img
            src="{{ $randomFish->image ?: asset('img/placeholder.png') }}"
            alt="{{ $randomFish->NAME }}"
            class="absolute inset-0 w-full h-full object-cover z-0">

        <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/30 to-transparent z-10"></div>

        <div class="relative z-20 max-w-7xl mx-auto px-6 h-full flex items-center">
            <div class="max-w-md text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-12">{{ $randomFish->NAME }}</h1>
                <p class="text-lg md:text-xl mb-16">{{ $randomFish->DESCRIPTION }}</p>
                <div class="flex flex-col space-y-8">
                    <a href="#" class="inline-flex items-center space-x-2 text-white hover:underline">
                        <span class="font-medium">Lihat Detail</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#" class="inline-flex bg-white text-blue-600 px-4 py-2 rounded-full font-semibold shadow hover:bg-gray-100 max-w-max">
                        Ubah Preferensi
                    </a>
                </div>
            </div>
        </div>
    </section>




    <!-- Ikan lainnya -->
    <div id="ikan-lainnya" class="sticky top-23 z-10 bg-gradient-to-r from-blue-600 to-blue-500 shadow-sm py-4" style="border-bottom-left-radius: 36px; border-bottom-right-radius: 36px;">
        <div class="max-w-7xl mx-auto px-6 flex justify-center">
            <h2 class="text-xl md:text-2xl font-semibold text-white text-center">Ikan Lainnya</h2>
        </div>
    </div>



    <section class="max-w-7xl mx-auto px-6 py-8 md:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($alternativeFishes as $fish)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow p-4">
                <div class="w-full h-40 bg-gray-100 rounded-lg mb-3 flex items-center justify-center overflow-hidden">
                    @if($fish->image)
                    <img src="{{ $fish->image }}" alt="{{ $fish->NAME }}" class="w-full h-full object-cover">
                    @else
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16l4-4-4-4m16 8l-4-4 4-4M12 20V4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    @endif
                </div>
                <h3 class="text-lg font-semibold text-gray-800">{{ $fish->NAME }}</h3>
                <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $fish->DESCRIPTION }}</p>
                <a href="{{ route('user.fish_detail', $fish->FISH_ID) }}" class="mt-3 inline-block text-sm text-blue-600 hover:underline">
                    Lihat detail
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    const ikanLainnya = document.getElementById('ikan-lainnya');
    const wrapper = document.getElementById('page-wrapper');

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = 600;
        const startScroll = maxScroll * 0.5;

        if (scrollTop < startScroll) {
            ikanLainnya.style.background = 'linear-gradient(to right, #2563eb, #3b82f6)';
            return;
        }

        let opacity = (scrollTop - startScroll) / (maxScroll - startScroll);
        opacity = Math.min(opacity, 1);
        const darkOverlayOpacity = opacity * 0.6;

        ikanLainnya.style.background = `
        linear-gradient(
            to right,
            rgba(0, 0, 0, ${darkOverlayOpacity}),
            rgba(0, 0, 0, ${darkOverlayOpacity})
        ),
        linear-gradient(to right, #2563eb, #3b82f6)
    `;
    });

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = 600;
        const startScroll = maxScroll * 0.5;

        if (scrollTop < startScroll) {
            wrapper.style.background = 'transparent';
            return;
        }

        let opacity = (scrollTop - startScroll) / (maxScroll - startScroll);
        opacity = Math.min(opacity, 1);

        const blackShade = `rgba(10, 10, 15, ${opacity})`;
        const blueShade = `rgba(20, 40, 90, ${opacity})`;

        wrapper.style.background = `linear-gradient(to bottom, ${blackShade}, ${blueShade})`;
    });
</script>

@endsection