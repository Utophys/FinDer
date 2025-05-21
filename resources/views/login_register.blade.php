<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FINder Auth</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slide-in-left {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-out-right {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes slide-in-right {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-out-left {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        .slide-in-left {
            animation: slide-in-left 0.5s ease-out forwards;
        }

        .slide-out-right {
            animation: slide-out-right 0.5s ease-out forwards;
        }

        .slide-in-right {
            animation: slide-in-right 0.5s ease-out forwards;
        }

        .slide-out-left {
            animation: slide-out-left 0.5s ease-out forwards;
        }
    </style>
</head>

<body class="bg-white w-screen h-screen overflow-hidden">
    @php
    $activePanel = session('active_panel', 'login');
    @endphp
    <div class="flex h-full w-full" id="auth-container">

        <!-- Login Panel -->
        <div id="login-panel" class="flex h-full w-full transition-transform duration-500 {{ $activePanel === 'login' ? '' : 'hidden' }}">
            <div class="w-[60%] bg-white text-black flex flex-col justify-center items-center text-center p-8 relative">
                <img id="logo-left" src="{{ asset('assets/images/logo-finder.svg') }}" alt="FINder Logo" class="absolute top-4 left-6 h-24" />

                <!-- Login Form -->
                <form action="{{ route('login') }}" method="POST" class="w-full max-w-md border border-gray-300 rounded-lg p-6">
                    @csrf
                    <h1 class="text-3xl font-bold text-center mb-2">Selamat Datang Kembali!</h1>
                    <p class="text-center text-gray-500 mb-2">Login Terlebih Dahulu</p>

                    <label class="block text-sm font-medium text-gray-700 mb-1 text-left">Email</label>
                    <input type="email" name="email" placeholder="Your email" class="w-full p-3 border rounded mb-4" value="{{ old('email') }}" required />

                    <label class="block text-sm font-medium text-gray-700 mb-1 text-left">Password</label>
                    <div class="relative mb-2">
                        <input type="password" id="login-password" name="password" placeholder="Your password" class="w-full p-3 border rounded pr-10" required />
                        <span id="login-password-toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer hidden" onclick="togglePassword('login-password')">
                            <!-- SVG Icons -->
                        </span>
                    </div>
                    @error('email', 'login')
                    <p class="flex justify-start text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-end mt-2 mb-8">
                        <label class="flex items-center space-x-2 cursor-pointer text-sm">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-gray-700">Remember Me</span>
                        </label>
                    </div>



                    <button type="submit" class="w-full bg-black text-white py-3 rounded-full font-semibold mb-4">Sign In</button>

                    <div class="text-center mb-4 text-gray-500">Or</div>

                    <a href="{{ route('google.redirect') }}" class="w-full bg-black text-white py-3 rounded-full flex items-center justify-center">
                        <img src="{{ asset('assets/images/icon-google.svg') }}" class="h-5 mr-2" alt="Google Icon">
                        Continue with Google
                    </a>


                </form>
            </div>

            <div class="w-[40%] bg-[#0E87CC] text-white flex flex-col justify-center items-center text-center p-8">
                <h2 class="text-3xl font-bold mb-4">Belum Punya Akun?</h2>
                <p class="mb-6 text-lg">Sign Up Sekarang, Dunia Ikan Menunggumu!</p>
                <button onclick="switchToRegister()" class="bg-white text-[#0E87CC] px-6 py-3 rounded-full text-lg font-semibold">
                    Sign Up
                </button>
            </div>
        </div>

        <!-- Register Panel -->
        <div id="register-panel" class="flex h-full w-full transition-transform duration-500 {{ $activePanel === 'register' ? '' : 'hidden' }}">
            <div class="w-[40%] bg-[#0E87CC] text-white flex flex-col justify-center items-center text-center p-8">
                <h2 class="text-3xl font-bold mb-4">Sudah Punya Akun?</h2>
                <p class="mb-6 text-lg">Cepat Login, Ikan-Ikan sudah Siap Untuk Dipelihara</p>
                <button onclick="switchToLogin()" class="bg-white text-[#0E87CC] px-6 py-3 rounded-full text-lg font-semibold">
                    Sign In
                </button>
            </div>

            <div class="w-[60%] bg-white flex flex-col justify-center items-center p-12 relative">
                <img src="{{ asset('assets/images/logo-finder.svg') }}" alt="FINder Logo" class="absolute top-4 right-6 h-24" />

                <!-- Register Form -->
                <form action="{{ route('register') }}" method="POST" class="w-full max-w-md border border-gray-300 rounded-lg p-6">
                    @csrf
                    <h1 class="text-3xl font-bold text-center mb-2">Selamat Datang!</h1>
                    <p class="text-center text-gray-500 mb-2">Register Terlebih Dahulu</p>

                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border rounded mb-4" value="{{ old('name') }}" required />
                    @error('name', 'register')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="Your Email" class="w-full p-3 border rounded mb-4" value="{{ old('email') }}" required />
                    @error('email', 'register')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative mb-4">
                        <input type="password" id="register-password" name="password" placeholder="Your Password" class="w-full p-3 border rounded pr-10" required />
                        <span id="register-password-toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer hidden" onclick="toggleRegisterPasswords()">
                            <!-- SVG Icons -->
                        </span>
                    </div>
                    @error('password', 'register')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <div class="relative mb-6">
                        <input type="password" id="register-confirm-password" name="password_confirmation" placeholder="Confirm Password" class="w-full p-3 border rounded pr-10" required />
                        <span id="register-confirm-password-toggle" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer hidden" onclick="toggleRegisterPasswords()">
                            <!-- SVG Icons -->
                        </span>
                    </div>
                    @error('password_confirmation', 'register')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="w-full bg-black text-white py-3 rounded-full font-semibold mb-4">Sign Up</button>

                </form>
            </div>
        </div>
    </div>



    <script>
        let isAnimating = false;

        // Slide transition between login and register
        function switchToRegister() {
            if (isAnimating) return;

            isAnimating = true;
            const loginPanel = document.getElementById('login-panel');
            const registerPanel = document.getElementById('register-panel');

            loginPanel.classList.add('slide-out-left');
            setTimeout(() => {
                loginPanel.classList.add('hidden');
                loginPanel.classList.remove('slide-out-left');
                registerPanel.classList.remove('hidden');
                registerPanel.classList.add('slide-in-right');
                setTimeout(() => {
                    registerPanel.classList.remove('slide-in-right');
                    isAnimating = false;
                }, 500);
            }, 500);
        }

        function switchToLogin() {
            if (isAnimating) return;

            isAnimating = true;
            const loginPanel = document.getElementById('login-panel');
            const registerPanel = document.getElementById('register-panel');

            registerPanel.classList.add('slide-out-right');
            setTimeout(() => {
                registerPanel.classList.add('hidden');
                registerPanel.classList.remove('slide-out-right');
                loginPanel.classList.remove('hidden');
                loginPanel.classList.add('slide-in-left');
                setTimeout(() => {
                    loginPanel.classList.remove('slide-in-left');
                    isAnimating = false;
                }, 500);
            }, 500);
        }

        // Toggle password visibility for login form
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeSlash = document.getElementById(`${inputId}-eye-slash`);
            const eye = document.getElementById(`${inputId}-eye`);

            if (input.type === 'password') {
                input.type = 'text';
                eyeSlash.classList.add('hidden');
                eye.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeSlash.classList.remove('hidden');
                eye.classList.add('hidden');
            }
        }

        // Synchronized toggle for register form (both password fields)
        function toggleRegisterPasswords() {
            const passwordInput = document.getElementById('register-password');
            const confirmPasswordInput = document.getElementById('register-confirm-password');
            const passwordEyeSlash = document.getElementById('register-password-eye-slash');
            const passwordEye = document.getElementById('register-password-eye');
            const confirmPasswordEyeSlash = document.getElementById('register-confirm-password-eye-slash');
            const confirmPasswordEye = document.getElementById('register-confirm-password-eye');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
                passwordEyeSlash.classList.add('hidden');
                passwordEye.classList.remove('hidden');
                confirmPasswordEyeSlash.classList.add('hidden');
                confirmPasswordEye.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
                passwordEyeSlash.classList.remove('hidden');
                passwordEye.classList.add('hidden');
                confirmPasswordEyeSlash.classList.remove('hidden');
                confirmPasswordEye.classList.add('hidden');
            }
        }

        // Show/hide toggle icon based on input content
        document.addEventListener('DOMContentLoaded', () => {
            // Login form password
            const loginPassword = document.getElementById('login-password');
            const loginPasswordToggle = document.getElementById('login-password-toggle');
            loginPassword.addEventListener('input', () => {
                loginPasswordToggle.classList.toggle('hidden', loginPassword.value === '');
            });

            // Register form passwords
            const registerPassword = document.getElementById('register-password');
            const registerConfirmPassword = document.getElementById('register-confirm-password');
            const registerPasswordToggle = document.getElementById('register-password-toggle');
            const registerConfirmPasswordToggle = document.getElementById('register-confirm-password-toggle');

            // Show toggle icons based on input in either field
            const updateRegisterToggles = () => {
                const hasInput = registerPassword.value !== '' || registerConfirmPassword.value !== '';
                registerPasswordToggle.classList.toggle('hidden', !hasInput);
                registerConfirmPasswordToggle.classList.toggle('hidden', !hasInput);
            };

            registerPassword.addEventListener('input', updateRegisterToggles);
            registerConfirmPassword.addEventListener('input', updateRegisterToggles);
        });
    </script>
</body>

</html>