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

        /* Ensure full width green section */
        .full-width-green {
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
            width: 100vw;
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <header class="text-white relative z-50" style="background-color: #73946B;">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo Section -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo" class="w-12 h-12 rounded-full">
                        <span class="text-2xl font-bold">Reseporia</span>
                    </a>
                </div>

                <!-- Search Section -->
                <div class="flex-1 max-w-lg mx-8 relative">
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

                <!-- Navigation Icons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('recipes.favorites') }}" class="text-white hover:text-green-200 transition-colors p-2">
                        <i class="fas fa-heart text-xl"></i>
                    </a>
                    <button class="bg-white text-green-700 px-6 py-2 rounded-full font-semibold hover:bg-green-50 transition-colors">
                        Login/Register
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>
        <!-- Footer -->
        <footer class="bg-[#73946B] text-white py-12 mt-20">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                    <!-- Logo & Description Section -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-16 h-16 rounded-full">
                            <h3 class="text-3xl font-bold">Reseporia</h3>
                        </div>
                        <p class="text-green-100 leading-relaxed mb-6 max-w-md">
                            Platform resep masakan terbaik Indonesia. Temukan ribuan resep lezat dari berbagai daerah,
                            mulai dari makanan tradisional hingga kreasi modern yang menggugah selera.
                        </p>

                        <!-- Social Media Icons -->
                        <div class="flex items-center space-x-4">
                            <a href="#" class="w-10 h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                <i class="fab fa-x-twitter text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:from-purple-600 hover:to-pink-600 transition-all">
                                <i class="fab fa-instagram text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors">
                                <i class="fab fa-tiktok text-white text-lg"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-youtube text-white text-lg"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Kategori Section -->
                    <div>
                        <h4 class="text-xl font-bold mb-6">Kategori</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('recipes.category', 'appetizer') }}" class="text-green-100 hover:text-white transition-colors">Appetizer</a></li>
                            <li><a href="{{ route('recipes.category', 'main-course') }}" class="text-green-100 hover:text-white transition-colors">Main Course</a></li>
                            <li><a href="{{ route('recipes.category', 'dessert') }}" class="text-green-100 hover:text-white transition-colors">Dessert</a></li>
                            <li><a href="{{ route('recipes.category', 'drinks') }}" class="text-green-100 hover:text-white transition-colors">Drinks</a></li>
                        </ul>
                    </div>

                    <!-- Pengaduan Section -->
                    <div>
                        <h4 class="text-xl font-bold mb-6">Pengaduan</h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=reseporia@gmail.com" class="text-green-100 hover:text-white transition-colors flex items-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Lapor Konten
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('saran.create') }}" class="text-green-100 hover:text-white transition-colors flex items-center">
                                    <i class="fas fa-flag mr-2"></i>
                                    Saran & Masukan
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-green-100 hover:text-white transition-colors flex items-center">
                                    <i class="fas fa-question-circle mr-2"></i>
                                    Bantuan
                                </a>
                            </li>
                            <li>
                                <a href="#" class="text-green-100 hover:text-white transition-colors flex items-center">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    Privasi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-green-600 my-8"></div>

                <!-- Bottom Section -->
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-green-100 text-sm">
                            © 2024 Reseporia. Semua hak cipta dilindungi.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-6 text-sm">
                        <a href="#" class="text-green-100 hover:text-white transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="text-green-100 hover:text-white transition-colors">Kebijakan Privasi</a>
                        <a href="{{ route('home') }}" class="text-green-100 hover:text-white transition-colors">Beranda</a>
                        <a href="{{ route('recipes.favorites') }}" class="text-green-100 hover:text-white transition-colors">Favorit</a>
                    </div>
                </div>
            </div>
        </footer>
    <script src="{{ asset('js/reseporia.js') }}"></script>

    <!-- AJAX Search Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchLoading = document.getElementById('searchLoading');

        // Search function
        function performSearch() {
            const query = searchInput.value.trim();

            if (query.length < 2) {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
                return;
            }

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                searchLoading.classList.remove('hidden');

                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchLoading.classList.add('hidden');
                        displayResults(data, query);
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        searchLoading.classList.add('hidden');
                        searchResults.innerHTML = '<div class="p-4 text-red-500">Terjadi kesalahan saat mencari</div>';
                        searchResults.classList.remove('hidden');
                    });
            }, 300); // Debounce 300ms
        }

        // Display search results
        function displayResults(recipes, query) {
            if (recipes.length === 0) {
                searchResults.innerHTML = `
                    <div class="p-4 text-gray-500 text-center">
                        <i class="fas fa-search text-2xl mb-2"></i>
                        <p>Tidak ada resep ditemukan untuk "<strong>${query}</strong>"</p>
                        <button onclick="document.querySelector('form').submit()" class="mt-2 text-blue-500 hover:underline text-sm">
                            Lihat semua hasil pencarian
                        </button>
                    </div>
                `;
            } else {
                const resultsHtml = recipes.map(recipe => `
                    <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0" onclick="goToRecipe(${recipe.id})">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                ${recipe.image
                                    ? `<img src="/images/recipes/${recipe.image}" alt="${recipe.title}" class="w-full h-full object-cover">`
                                    : '<i class="fas fa-utensils text-gray-400 w-full h-full flex items-center justify-center"></i>'
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-gray-900 truncate">${highlightText(recipe.title, query)}</h4>
                                <p class="text-sm text-gray-500 truncate">${highlightText(recipe.description.substring(0, 50) + '...', query)}</p>
                                <div class="flex items-center space-x-4 text-xs text-gray-400 mt-1">
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

                // Add "See all results" footer
                const footerHtml = `
                    <div class="p-3 bg-gray-50 text-center border-t">
                        <button onclick="document.querySelector('form').submit()" class="text-blue-500 hover:underline text-sm font-medium">
                            Lihat semua hasil untuk "${query}" →
                        </button>
                    </div>
                `;

                searchResults.innerHTML = resultsHtml + footerHtml;
            }

            searchResults.classList.remove('hidden');
        }

        // Highlight search terms
        function highlightText(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${query})`, 'gi');
            return text.replace(regex, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
        }

        // Navigate to recipe
        window.goToRecipe = function(recipeId) {
            window.location.href = `/recipe/${recipeId}`;
        };

        // Search input event
        if (searchInput) {
            searchInput.addEventListener('input', performSearch);

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#searchInput') && !e.target.closest('#searchResults')) {
                    searchResults.classList.add('hidden');
                }
            });

            // Show results when focusing if there's a query
            searchInput.addEventListener('focus', function() {
                if (this.value.length >= 2) {
                    performSearch();
                }
            });
        }
    });
    </script>
</body>
</html>
