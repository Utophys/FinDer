<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>@yield('title', 'My App')</title>
       <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <style>
           .active {
               background: linear-gradient(to right, #0E87CC, #2563eb);
               color: white;
           }
           .active img {
               filter: brightness(0) invert(1);
           }
           .active:hover {
               background: linear-gradient(to right, #0A6CA3, #1e40af);
           }
           .active:hover img {
               filter: brightness(0) invert(1);
           }
       </style>
   </head>
   <body>
       <div class="flex w-full h-screen">
           <!-- Sidebar kiri -->
           <div class="bg-white w-[20%] h-full p-4 flex flex-col border-r border-gray-200">
               <!-- Logo -->
               <div class="my-4 flex justify-center">
                   <img src="{{ asset('assets/images/logo-finder.svg') }}" alt="finder-logo" class="w-30">
               </div>
               <hr class="border-t border-gray-300">

               <!-- Navigasi -->
               <nav class="flex flex-col space-y-2">
                   <button onclick="setActive(this); window.location.href='/admin/fishes'" class="text-gray-700 px-4 py-3 rounded flex items-center hover:bg-gray-100 transition text-lg">
                       <img src="{{ asset('assets/images/fish-icon.svg') }}" alt="fish-icon" class="w-6 h-6 mr-3">
                       Kelola Alternatif Ikan
                   </button>

                   <button onclick="setActive(this); window.location.href='/admin/foods'" class="text-gray-700 px-4 py-3 rounded flex items-center hover:bg-gray-100 transition text-lg">
                       <img src="{{ asset('assets/images/fish-food-icon.svg') }}" alt="fish-food-icon" class="w-6 h-6 mr-3">
                       Kelola Makanan
                   </button>

                   <button onclick="setActive(this); window.location.href='/admin/user-results'" class="text-gray-700 px-4 py-3 rounded flex items-center hover:bg-gray-100 transition text-lg">
                       <img src="{{ asset('assets/images/history-icon.svg') }}" alt="history-icon" class="w-6 h-6 mr-3">
                       Kelola Histori
                   </button>

                   <button onclick="setActive(this); window.location.href='/admin/varieties'" class="text-gray-700 px-4 py-3 rounded flex items-center hover:bg-gray-100 transition text-lg">
                       <img src="{{ asset('assets/images/fish-icon.svg') }}" alt="fish-icon" class="w-6 h-6 mr-3">
                       Kelola Varietas Ikan
                   </button>

                   <hr class="border-t border-gray-300">

                   <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                       @csrf
                       <button type="submit" class="text-gray-700 px-4 py-3 rounded flex items-center hover:bg-gray-100 transition w-full text-lg">
                           <img src="{{ asset('assets/images/logout-icon.svg') }}" alt="logout-icon" class="w-6 h-6 mr-3">
                           Logout
                       </button>
                   </form>
               </nav>
           </div>

           <!-- Konten kanan -->
           <div class="bg-gradient-to-r from-[#2563eb] to-[#0E87CC] w-[80%] h-full overflow-y-auto p-8 text-white">
               <main>
                   @yield('content')
               </main>
           </div>
       </div>

       <script>
           function setActive(button) {
               // Remove active class from all buttons
               document.querySelectorAll('nav button').forEach(btn => {
                   btn.classList.remove('active');
               });
               // Add active class to the clicked button
               button.classList.add('active');
           }

           // Set active button based on current URL
           document.addEventListener('DOMContentLoaded', () => {
               const currentPath = window.location.pathname;
               document.querySelectorAll('nav button').forEach(button => {
                   const href = button.getAttribute('onclick').match(/\/admin\/[^']+/)[0];
                   if (currentPath === href) {
                       button.classList.add('active');
                   }
               });
           });
       </script>
   </body>
   </html>
