<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FinDer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Fade-in animation for buttons */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in forwards;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Include Header -->
    @include('partials.header')

    <!-- Hero Section -->
    <section id="hero" class="relative bg-cover bg-no-repeat bg-center h-screen w-full pt-16" style="background-image: url('{{ asset('assets/images/ikan-hias.svg') }}')">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="container mx-auto px-6 h-full flex flex-col justify-center items-center text-center text-white relative z-10 max-w-full">
            <h1 class="text-5xl font-bold mb-4">About Us</h1>
            <p class="text-lg max-w-2xl mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <a href="#more-info" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300" onclick="smoothScrollWithOffset('#more-info', 96)">
                Selengkapnya
            </a>
        </div>
    </section>

    <!-- More Info Section -->
    <section id="more-info" class="bg-gray-100  relative" style="height: calc(100vh - 96px);">
        <div class="container mx-auto h-full flex flex-col justify-center max-w-full">
            <!-- Top: FinDer Info -->
            <div class="flex flex-col md:flex-row items-center mb-24">
                <!-- Left: Logo with Tagline -->
                <div class="md:w-1/2 flex-1 md:mb-0 flex items-center justify-center pl-24">
                    <img src="{{ asset('assets/images/about-logo-tagline.svg') }}" alt="FinDer Logo with Tagline" class="max-w-full h-auto">
                </div>
                <!-- Right: FinDer Description -->
                <div class="md:w-1/2 flex-1 md:pl-8 flex flex-col items-center justify-center pr-24">
                    <h2 class="text-3xl font-bold mb-3 text-center">FinDer</h2>
                    <p class="text-gray-600 text-justify text-base">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>
            <!-- Bottom: MOORA Info -->
            <div class="flex flex-col md:flex-row items-center mb-4">
                <!-- Left: MOORA Description -->
                <div class="md:w-1/2 flex-1 md:mb-0 flex flex-col items-center justify-center pl-24">
                    <h3 class="text-2xl font-semibold mb-3 text-center">What is the MOORA Method?</h3>
                    <p class="text-gray-600 text-justify text-base">
                        The MOORA (Multi-Objective Optimization by Ratio Analysis) method is a decision-making technique used in Decision Support Systems to rank alternatives based on multiple criteria, ensuring optimal and efficient solutions.
                    </p>
                </div>
                <!-- Right: MOORA Logo -->
                <div class="md:w-1/2 flex-1 md:pl-8 flex items-center justify-center pr-24">
                    <img src="{{ asset('assets/images/logo-moora.svg') }}" alt="MOORA Logo" class="max-w-full h-auto">
                </div>
            </div>

            <div class="flex justify-center">
                <a href="#about-developer" class="absolute bottom-6 right-6 bg-blue-800 hover:bg-blue-700 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg transition duration-300 z-20 more-info-button" style="display: none;" title="Lihat Developer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 more-info-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- About Developer Section -->
    <section id="about-developer" class="bg-blue-800 relative" style="height: calc(100vh - 96px);">
        <div class="container mx-auto px-8 h-full flex flex-col max-w-full">
            <h2 class="text-4xl font-bold text-center text-white pt-8 mb-6">About Developer</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <!-- Developer 1 -->
                <div class="relative group">
                    <img src="{{ asset('assets/images/thinkerman.jpg') }}" alt="Developer 1" class="w-full h-80 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex flex-col justify-center items-center text-white rounded-lg transition duration-300">
                        <p class="text-lg font-semibold">Orang 1</p>
                        <p class="text-sm">NIM: 230741101</p>
                    </div>
                </div>
                <!-- Developer 2 -->
                <div class="relative group">
                    <img src="{{ asset('assets/images/thinkerman.jpg') }}" alt="Developer 2" class="w-full h-80 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex flex-col justify-center items-center text-white rounded-lg transition duration-300">
                        <p class="text-lg font-semibold">Orang 2</p>
                        <p class="text-sm">NIM: 230741102</p>
                    </div>
                </div>
                <!-- Developer 3 -->
                <div class="relative group">
                    <img src="{{ asset('assets/images/thinkerman.jpg') }}" alt="Developer 3" class="w-full h-80 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex flex-col justify-center items-center text-white rounded-lg transition duration-300">
                        <p class="text-lg font-semibold">Orang 3</p>
                        <p class="text-sm">NIM: 230741103</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <a href="#hero" class="absolute bottom-6 right-6 bg-white hover:bg-gray-200 text-blue-800 w-12 h-12 flex items-center justify-center rounded-full shadow-lg transition duration-300 z-20 about-dev-button" style="display: none;" title="Kembali ke Hero">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <script>
    function smoothScrollWithOffset(targetId, offset = 96) {
        const target = document.querySelector(targetId);
        if (!target) return;

        const targetPosition = target.offsetTop - offset;
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    }

    function updateButtons() {
        const moreInfoSection = document.querySelector('#more-info');
        const aboutDevSection = document.querySelector('#about-developer');
        const moreInfoButton = document.querySelector('.more-info-button');
        const aboutDevButton = document.querySelector('.about-dev-button');
        const moreInfoSvg = document.querySelector('.more-info-svg');

        // Get section positions
        const moreInfoTop = moreInfoSection.offsetTop;
        const moreInfoBottom = moreInfoTop + moreInfoSection.offsetHeight;
        const aboutDevTop = aboutDevSection.offsetTop;
        const aboutDevBottom = aboutDevTop + aboutDevSection.offsetHeight;
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        const scrollCenter = scrollPosition + windowHeight / 2;

        // Track last scroll position to determine direction
        const lastScrollPosition = window.lastScrollPosition || 0;
        const scrollingUp = scrollPosition < lastScrollPosition;
        window.lastScrollPosition = scrollPosition;

        // More Info Button Visibility and Navigation
        if (scrollCenter >= moreInfoTop && scrollCenter <= moreInfoBottom) {
            // Show button with animation
            if (moreInfoButton.style.display !== 'flex') {
                moreInfoButton.style.display = 'flex';
                moreInfoButton.classList.remove('fade-in');
                void moreInfoButton.offsetWidth; // Trigger reflow
                moreInfoButton.classList.add('fade-in');
            }

            // Update SVG and href based on scroll direction
            if (scrollingUp) {
                moreInfoSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />';
                moreInfoButton.setAttribute('href', '#hero');
                moreInfoButton.setAttribute('title', 'Kembali ke Hero');
            } else {
                moreInfoSvg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>';
                moreInfoButton.setAttribute('href', '#about-developer');
                moreInfoButton.setAttribute('title', 'Lihat Developer');
            }
        } else {
            moreInfoButton.style.display = 'none';
        }

        // About Developer Button Visibility
        if (aboutDevTop >= scrollPosition && aboutDevBottom <= scrollPosition + windowHeight) {
            if (aboutDevButton.style.display !== 'flex') {
                aboutDevButton.style.display = 'flex';
                aboutDevButton.classList.remove('fade-in');
                void aboutDevButton.offsetWidth; // Trigger reflow
                aboutDevButton.classList.add('fade-in');
            }
        } else {
            aboutDevButton.style.display = 'none';
        }

        // Debug log to confirm visibility logic
        console.log('Scroll Position:', scrollPosition, 'More Info Visible:', scrollCenter >= moreInfoTop && scrollCenter <= moreInfoBottom, 'About Dev Fully Visible:', aboutDevTop >= scrollPosition && aboutDevBottom <= scrollPosition + windowHeight);
    }

    // Add scroll event listener
    window.addEventListener('scroll', updateButtons);

    // Initial call to set button states on page load
    updateButtons();

    // Event listener for Selengkapnya button in Hero section
    document.querySelector('a[href="#more-info"]').addEventListener('click', function(e) {
        e.preventDefault();
        smoothScrollWithOffset('#more-info', 96);
    });

    // Event listener for More Info button
    document.querySelector('.more-info-button').addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        smoothScrollWithOffset(href, 96);
    });

    // Event listener for About Developer button
    document.querySelector('.about-dev-button').addEventListener('click', function(e) {
        e.preventDefault();
        smoothScrollWithOffset('#hero', 96);
    });
</script>
</body>
</html>
