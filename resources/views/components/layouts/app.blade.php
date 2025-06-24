<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Reseporia' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/logoreseporia.png') }}" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Mobile-first background */
        @media (max-width: 768px) {
            body {
                background-attachment: scroll;
                background-size: cover;
            }
        }

        /* Ensure full width green section */
        .full-width-green {
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            width: 100vw;
        }

        /* Mobile menu animation */
        .mobile-menu {
            transition: all 0.3s ease-in-out;
            transform: translateX(-100%);
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Search results responsive */
        @media (max-width: 640px) {
            #searchResults {
                left: -1rem;
                right: -1rem;
                margin-top: 0.25rem;
            }
        }
    </style>
</head>
@if (!request()->is('login') && !request()->is('register') && !request()->is('reset-password'))
<body class="min-h-screen">
    <!-- Navbar -->
    <!-- Navbar -->
    <header class="text-white relative z-50" style="background-color: #73946B;">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo Section with Mobile Menu Button -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- Mobile Menu Button (next to logo) -->
                    <button id="mobileMenuBtn" class="md:hidden text-white p-2 rounded-md hover:bg-white hover:bg-opacity-20 transition-colors">
                        <i class="fas fa-bars text-lg sm:text-xl"></i>
                    </button>
                    
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo" class="w-8 h-8 sm:w-12 sm:h-12 rounded-full">
                        <span class="text-lg sm:text-2xl font-bold">Reseporia</span>
                    </a>
                </div>

                <!-- Desktop Search Section -->
                <div class="hidden md:flex flex-1 max-w-lg mx-8 relative">
                    <form action="{{ route('recipes.search') }}" method="GET" class="flex w-full bg-white rounded-full overflow-hidden shadow-sm focus-within:ring-2 focus-within:ring-[#9bbd84]">
                        <input
                            type="text"
                            name="q"
                            id="searchInput"
                            placeholder="Cari resep..."
                            class="flex-grow py-2 px-4 text-gray-700 border-none outline-none bg-transparent"
                            value="{{ request('q') }}"
                            autocomplete="off"
                        >
                        <button
                            type="submit"
                            class="bg-[#73946B] hover:bg-[#5f7e59] text-white px-4 flex items-center justify-center"
                        >
                            <i class="fas fa-search text-sm"></i>
                        </button>

                        <!-- Loading Spinner -->
                        <div id="searchLoading" class="absolute right-14 top-1/2 transform -translate-y-1/2 hidden">
                            <i class="fas fa-spinner fa-spin text-gray-400"></i>
                        </div>
                    </form>

                    <!-- AJAX Search Results Dropdown -->
                    <div id="searchResults" class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-xl mt-1 max-h-96 overflow-y-auto z-50 hidden">
                        <!-- Results will be inserted here -->
                    </div>
                </div>

                <!-- Desktop Navigation Icons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('recipes.favorites') }}" class="text-white hover:text-green-200 transition-colors p-2">
                        <i class="fas fa-heart text-xl"></i>
                    </a>
                    
                    @auth
                        <!-- Profile Icon untuk user yang sudah login -->
                        <a href="{{ route('profile.show') }}" class="text-white hover:text-green-200 transition-colors p-2">
                            <i class="fas fa-user text-xl"></i>
                        </a>
                    @else
                        <!-- Login/Register untuk guest -->
                        <a href="{{ route('login') }}" data-turbo="false" class="bg-white text-green-700 px-6 py-2 rounded-full font-semibold hover:bg-green-50 transition-colors whitespace-nowrap">
                            Login/Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile Right Icons -->
                <div class="flex md:hidden items-center space-x-2">
                    <button id="mobileSearchBtn" class="text-white p-2 rounded-md hover:bg-white hover:bg-opacity-20 transition-colors">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <a href="{{ route('recipes.favorites') }}" class="text-white p-2 rounded-md hover:bg-white hover:bg-opacity-20 transition-colors">
                        <i class="fas fa-heart text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div id="mobileSearchBar" class="md:hidden mt-3 hidden">
                <form action="{{ route('recipes.search') }}" method="GET" class="relative">
                    <input
                        type="text"
                        name="q"
                        id="mobileSearchInput"
                        placeholder="Cari resep..."
                        class="w-full py-3 px-4 pr-12 text-gray-700 bg-white rounded-lg border-none outline-none shadow-sm"
                        value="{{ request('q') }}"
                        autocomplete="off"
                    >
                    <button
                        type="submit"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-[#73946B] hover:bg-[#5f7e59] text-white p-2 rounded-md"
                    >
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>

                <!-- Mobile Search Results -->
                <div id="mobileSearchResults" class="bg-white border border-gray-200 rounded-lg shadow-xl mt-2 max-h-80 overflow-y-auto z-50 hidden">
                    <!-- Results will be inserted here -->
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu fixed top-0 left-0 w-80 max-w-[85vw] h-full bg-[#73946B] z-50 md:hidden">
            <div class="p-6">
                <!-- Mobile Menu Header -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
                        <span class="text-xl font-bold text-white">Reseporia</span>
                    </div>
                    <button id="closeMobileMenu" class="text-white p-2 rounded-md hover:bg-white hover:bg-opacity-20">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Menu Items -->
                <nav class="space-y-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-white bg-opacity-20' : '' }}">
                        <i class="fas fa-home text-lg"></i>
                        <span class="font-medium">Beranda</span>
                    </a>
                    
                    <a href="{{ route('recipes.category', 'appetizer') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-cookie-bite text-lg"></i>
                        <span class="font-medium">Appetizer</span>
                    </a>
                    
                    <a href="{{ route('recipes.category', 'main-course') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-drumstick-bite text-lg"></i>
                        <span class="font-medium">Main Course</span>
                    </a>
                    
                    <a href="{{ route('recipes.category', 'dessert') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-ice-cream text-lg"></i>
                        <span class="font-medium">Dessert</span>
                    </a>
                    
                    <a href="{{ route('recipes.category', 'drinks') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-coffee text-lg"></i>
                        <span class="font-medium">Drinks</span>
                    </a>

                    <hr class="border-white border-opacity-30 my-4">
                    
                    <a href="{{ route('recipes.favorites') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-heart text-lg"></i>
                        <span class="font-medium">Favorit Saya</span>
                    </a>
                    
                    <a href="{{ route('saran.create') }}" class="flex items-center space-x-3 text-white hover:bg-white hover:bg-opacity-20 p-3 rounded-lg transition-colors">
                        <i class="fas fa-flag text-lg"></i>
                        <span class="font-medium">Saran & Masukan</span>
                    </a>
                </nav>

                <!-- Mobile Login Button -->
                <div class="mt-8 pt-6 border-t border-white border-opacity-30">
                    <a href="{{ route('login') }}" class="block w-full bg-white text-[#73946B] text-center py-3 px-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Login / Register
                    </a>
                </div>
            </div>
        </div>
    </header>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>
        
    <!-- Footer -->
    @if (!request()->is('login') && !request()->is('register'))
    <footer class="bg-[#73946B] text-white py-8 sm:py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

                <!-- Logo & Description Section -->
                <div class="sm:col-span-2 lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-4 sm:mb-6">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full">
                        <h3 class="text-2xl sm:text-3xl font-bold">Reseporia</h3>
                    </div>
                    <p class="text-green-100 leading-relaxed mb-4 sm:mb-6 max-w-md text-sm sm:text-base">
                        Platform resep masakan terbaik Indonesia. Temukan ribuan resep lezat dari berbagai daerah,
                        mulai dari makanan tradisional hingga kreasi modern yang menggugah selera.
                    </p>

                    <!-- Social Media Icons -->
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <a href="#" class="w-8 h-8 sm:w-10 sm:h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                            <i class="fab fa-x-twitter text-white text-sm sm:text-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition-all">
                            <i class="fab fa-instagram text-white text-sm sm:text-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f text-white text-sm sm:text-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 sm:w-10 sm:h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                            <i class="fab fa-tiktok text-white text-sm sm:text-lg"></i>
                        </a>
                        <a href="#" class="w-8 h-8 sm:w-10 sm:h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube text-white text-sm sm:text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Kategori Section -->
                <div>
                    <h4 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6">Kategori</h4>
                    <ul class="space-y-2 sm:space-y-3">
                        <li><a href="{{ route('recipes.category', 'appetizer') }}" class="text-green-100 hover:text-white transition-colors text-sm sm:text-base">Appetizer</a></li>
                        <li><a href="{{ route('recipes.category', 'main-course') }}" class="text-green-100 hover:text-white transition-colors text-sm sm:text-base">Main Course</a></li>
                        <li><a href="{{ route('recipes.category', 'dessert') }}" class="text-green-100 hover:text-white transition-colors text-sm sm:text-base">Dessert</a></li>
                        <li><a href="{{ route('recipes.category', 'drinks') }}" class="text-green-100 hover:text-white transition-colors text-sm sm:text-base">Drinks</a></li>
                    </ul>
                </div>

                <!-- Pengaduan Section -->
                <div>
                    <h4 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6">Pengaduan</h4>
                    <ul class="space-y-2 sm:space-y-3">
                        <li>
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=reseporia@gmail.com" class="text-green-100 hover:text-white transition-colors flex items-center text-sm sm:text-base">
                                <i class="fas fa-envelope mr-2 text-xs sm:text-sm"></i>
                                Lapor Konten
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('saran.create') }}" class="text-green-100 hover:text-white transition-colors flex items-center text-sm sm:text-base">
                                <i class="fas fa-flag mr-2 text-xs sm:text-sm"></i>
                                Saran & Masukan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-green-100 hover:text-white transition-colors flex items-center text-sm sm:text-base">
                                <i class="fas fa-question-circle mr-2 text-xs sm:text-sm"></i>
                                Bantuan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-green-100 hover:text-white transition-colors flex items-center text-sm sm:text-base">
                                <i class="fas fa-shield-alt mr-2 text-xs sm:text-sm"></i>
                                Privasi
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-green-600 my-6 sm:my-8"></div>

            <!-- Bottom Section -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    <p class="text-green-100 text-xs sm:text-sm text-center sm:text-left">
                        © 2025 Reseporia. Semua hak cipta dilindungi.
                    </p>
                </div>

                <div class="flex flex-wrap justify-center sm:justify-end gap-4 sm:gap-6 text-xs sm:text-sm">
                    <a href="#" class="text-green-100 hover:text-white transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="text-green-100 hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="{{ route('home') }}" class="text-green-100 hover:text-white transition-colors">Beranda</a>
                    <a href="{{ route('recipes.favorites') }}" class="text-green-100 hover:text-white transition-colors">Favorit</a>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- Scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        function openMobileMenu() {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenuFunc() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        }

        // Mobile search functionality
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        const mobileSearchBar = document.getElementById('mobileSearchBar');

        if (mobileSearchBtn && mobileSearchBar) {
            mobileSearchBtn.addEventListener('click', function() {
                mobileSearchBar.classList.toggle('hidden');
                if (!mobileSearchBar.classList.contains('hidden')) {
                    document.getElementById('mobileSearchInput').focus();
                }
            });
        }

        // Search functionality
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        const searchResults = document.getElementById('searchResults');
        const mobileSearchResults = document.getElementById('mobileSearchResults');
        const searchLoading = document.getElementById('searchLoading');

        function performSearch(input, resultsContainer) {
            const query = input.value.trim();

            if (query.length < 2) {
                if (resultsContainer) {
                    resultsContainer.innerHTML = '';
                    resultsContainer.classList.add('hidden');
                }
                return;
            }

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                if (searchLoading) searchLoading.classList.remove('hidden');

                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (searchLoading) searchLoading.classList.add('hidden');
                        displayResults(data, query, resultsContainer);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        if (searchLoading) searchLoading.classList.add('hidden');
                        if (resultsContainer) {
                            resultsContainer.innerHTML = '<div class="p-4 text-red-500 text-sm">Terjadi kesalahan saat mencari</div>';
                            resultsContainer.classList.remove('hidden');
                        }
                    });
            }, 300);
        }

        function displayResults(recipes, query, resultsContainer) {
            if (!resultsContainer) return;

            if (recipes.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="p-4 text-gray-500 text-center">
                        <i class="fas fa-search text-xl sm:text-2xl mb-2"></i>
                        <p class="text-sm sm:text-base">Tidak ada resep ditemukan untuk "<strong>${query}</strong>"</p>
                        <button onclick="document.querySelector('form').submit()" class="mt-2 text-blue-500 hover:underline text-xs sm:text-sm">
                            Lihat semua hasil pencarian
                        </button>
                    </div>
                `;
            } else {
                const resultsHtml = recipes.slice(0, 6).map(recipe => `
                    <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0" onclick="goToRecipe(${recipe.id})">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                ${recipe.image
                                    ? `<img src="/${recipe.image}" alt="${recipe.title}" class="w-full h-full object-cover">`
                                    : '<i class="fas fa-utensils text-gray-400 w-full h-full flex items-center justify-center text-xs"></i>'
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-gray-900 truncate text-sm sm:text-base">${highlightText(recipe.title, query)}</h4>
                                <p class="text-xs sm:text-sm text-gray-500 truncate">${highlightText(recipe.description.substring(0, 40) + '...', query)}</p>
                                <div class="flex items-center space-x-2 sm:space-x-4 text-xs text-gray-400 mt-1">
                                    <span><i class="fas fa-star text-yellow-500"></i> ${recipe.rating}</span>
                                    <span><i class="fas fa-heart text-red-500"></i> ${recipe.likes}</span>
                                    <span><i class="fas fa-clock text-blue-500"></i> ${recipe.cooking_time}m</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">${recipe.category}</span>
                            </div>
                        </div>
                    </div>
                `).join('');

                const footerHtml = `
                    <div class="p-3 bg-gray-50 text-center border-t">
                        <button onclick="document.querySelector('form').submit()" class="text-blue-500 hover:underline text-xs sm:text-sm font-medium">
                            Lihat semua hasil untuk "${query}" →
                        </button>
                    </div>
                `;

                resultsContainer.innerHTML = resultsHtml + footerHtml;
            }

            resultsContainer.classList.remove('hidden');
        }

        function highlightText(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
        }

        window.goToRecipe = function(recipeId) {
            window.location.href = `/recipe/${recipeId}`;
        };

        // Desktop search
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                performSearch(this, searchResults);
            });

            searchInput.addEventListener('focus', function() {
                if (this.value.length >= 2) {
                    performSearch(this, searchResults);
                }
            });
        }

        // Mobile search
        if (mobileSearchInput) {
            mobileSearchInput.addEventListener('input', function() {
                performSearch(this, mobileSearchResults);
            });

            mobileSearchInput.addEventListener('focus', function() {
                if (this.value.length >= 2) {
                    performSearch(this, mobileSearchResults);
                }
            });
        }

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (searchResults && !e.target.closest('#searchInput') && !e.target.closest('#searchResults')) {
                searchResults.classList.add('hidden');
            }
            if (mobileSearchResults && !e.target.closest('#mobileSearchInput') && !e.target.closest('#mobileSearchResults')) {
                mobileSearchResults.classList.add('hidden');
            }
        });
    });
    </script>

    <script src="{{ asset('js/reseporia.js') }}"></script>
</body>
</html>