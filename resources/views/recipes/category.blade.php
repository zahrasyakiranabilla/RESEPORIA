<x-layouts.app>
    <x-slot name="title">{{ $categoryName }} - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50">
        <!-- Category Header -->
        <div class="bg-[#9EBC8A] text-white py-6 sm:py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-5">
                
                <!-- Mobile Header Layout -->
                <div class="block sm:hidden">
                    <!-- Top Row: Back Button and Sort -->
                    <div class="flex items-center justify-between mb-4">
                        <!-- Back Button -->
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg transition-colors">
                            <i class="fas fa-chevron-left text-sm"></i>
                            <span class="text-sm font-medium">Kembali</span>
                        </a>

                        <!-- Sort Dropdown -->
                        <div class="relative">
                            <button id="mobileSortBtn" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-3 py-2 rounded-lg transition-colors">
                                <i class="fas fa-sort text-sm"></i>
                                <span class="text-sm font-medium">Urutkan</span>
                                <i class="fas fa-chevron-down text-xs" id="mobileSortIcon"></i>
                            </button>

                            <!-- Mobile Sort Dropdown -->
                            <div id="mobileSortDropdown" class="absolute top-full right-0 mt-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-30 hidden min-w-[160px]">
                                <button onclick="applySorting('')" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors text-sm {{ request('sort') == '' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                                    <i class="fas fa-list mr-2 w-4"></i>
                                    Default
                                </button>
                                <button onclick="applySorting('rating')" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors text-sm border-t border-gray-100 {{ request('sort') == 'rating' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                                    <i class="fas fa-star mr-2 w-4"></i>
                                    Rating Tertinggi
                                </button>
                                <button onclick="applySorting('likes')" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors text-sm border-t border-gray-100 {{ request('sort') == 'likes' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                                    <i class="fas fa-heart mr-2 w-4"></i>
                                    Paling Disukai
                                </button>
                                <button onclick="applySorting('time')" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors text-sm border-t border-gray-100 {{ request('sort') == 'time' ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
                                    <i class="fas fa-clock mr-2 w-4"></i>
                                    Waktu Tercepat
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Title (Centered) -->
                    <div class="text-center mb-4">
                        <h1 class="text-2xl sm:text-3xl font-bold">{{ $categoryName }}</h1>
                    </div>

                    <!-- Recipe Count -->
                    <div class="text-center">
                        <p class="text-white/90 text-sm">
                            Ditemukan <span class="font-bold text-white">{{ $recipes->count() }}</span> resep
                        </p>
                    </div>
                </div>

                <!-- Desktop Header Layout (Hidden on Mobile) -->
                <div class="hidden sm:block">
                    <div class="flex items-center justify-between">
                        <!-- Back Button -->
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-chevron-left"></i>
                            <span>Kembali</span>
                        </a>

                        <!-- Category Title -->
                        <h1 class="text-3xl font-bold">{{ $categoryName }}</h1>

                        <!-- Sort Dropdown -->
                        <div class="relative">
                            <select id="sortSelect" class="bg-white/20 border border-white/30 text-white rounded-lg px-4 py-2 focus:ring-2 focus:ring-white/50 focus:border-transparent appearance-none pr-8">
                                <option value="" class="text-gray-800">Urutkan</option>
                                <option value="rating" class="text-gray-800" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                                <option value="likes" class="text-gray-800" {{ request('sort') == 'likes' ? 'selected' : '' }}>Paling Disukai</option>
                                <option value="time" class="text-gray-800" {{ request('sort') == 'time' ? 'selected' : '' }}>Waktu Tercepat</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-white pointer-events-none"></i>
                        </div>
                    </div>

                    <!-- Recipe Count -->
                    <div class="mt-4">
                        <p class="text-white">
                            Ditemukan <span class="font-bold">{{ $recipes->count() }}</span> resep dalam kategori {{ $categoryName }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipe Cards Container -->
        <div class="max-w-6xl mx-auto px-4 sm:px-5 py-6 sm:py-10">
            @if($recipes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    @foreach($recipes as $recipe)
                        <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-lg sm:shadow-xl hover:shadow-2xl hover:-translate-y-1 sm:hover:-translate-y-2 transition-all duration-300 cursor-pointer group relative" onclick="goToDetail('{{ route('recipes.show', $recipe) }}')">
                            <!-- Recipe Image -->
                            <div class="overflow-hidden">
                                @if($recipe->image)
                                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-40 sm:h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-40 sm:h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-utensils text-gray-400 text-2xl sm:text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Recipe Info -->
                            <div class="p-4 sm:p-6">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 group-hover:text-green-700 transition-colors line-clamp-2">
                                    {{ $recipe->title }}
                                </h3>

                                <!-- Recipe Description (limited) -->
                                <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-3">
                                    {{ Str::limit($recipe->description, 80) }}
                                </p>

                                <!-- Recipe Stats -->
                                <div class="flex justify-between items-center text-gray-600 text-xs sm:text-sm">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500 text-sm sm:text-lg"></i>
                                        <span class="font-bold text-sm sm:text-base">{{ number_format($recipe->averageRating(), 1) }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-heart text-red-500 text-sm sm:text-lg"></i>
                                        <span class="font-bold text-sm sm:text-base">{{ $recipe->likes }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-clock text-blue-500 text-sm sm:text-lg"></i>
                                        <span class="font-bold text-sm sm:text-base">{{ $recipe->cooking_time }}m</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-3 sm:top-4 left-3 sm:left-4">
                                <span class="bg-[#9EBC8A] text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-bold shadow-lg">
                                    {{ $categoryName }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                        <i class="fas fa-search text-gray-300 text-8xl mb-6"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Resep</h2>
                        <p class="text-gray-600 mb-8">Belum ada resep dalam kategori <strong>{{ $categoryName }}</strong>. Coba kategori lain atau kembali ke beranda.</p>

                        <div class="space-y-3">
                            <a href="{{ route('home') }}" class="block bg-[#9EBC8A] hover:bg-[#8BAA79] text-white px-6 sm:px-8 py-3 rounded-lg font-medium transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Kembali ke Beranda
                            </a>

                            <!-- Quick Category Links -->
                            <div class="flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('recipes.category', 'appetizer') }}" class="text-xs sm:text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Appetizer
                                </a>
                                <a href="{{ route('recipes.category', 'main-course') }}" class="text-xs sm:text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Main Course
                                </a>
                                <a href="{{ route('recipes.category', 'dessert') }}" class="text-xs sm:text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Dessert
                                </a>
                                <a href="{{ route('recipes.category', 'drinks') }}" class="text-xs sm:text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Drinks
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
    function goToDetail(url) {
        window.location.href = url;
    }

    // Desktop Sort functionality
    const sortSelect = document.getElementById('sortSelect');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            applySorting(sortBy);
        });
    }

    // Mobile Sort functionality
    const mobileSortBtn = document.getElementById('mobileSortBtn');
    const mobileSortDropdown = document.getElementById('mobileSortDropdown');
    const mobileSortIcon = document.getElementById('mobileSortIcon');

    if (mobileSortBtn && mobileSortDropdown) {
        mobileSortBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isOpen = !mobileSortDropdown.classList.contains('hidden');
            
            if (isOpen) {
                mobileSortDropdown.classList.add('hidden');
                mobileSortIcon.style.transform = 'rotate(0deg)';
            } else {
                mobileSortDropdown.classList.remove('hidden');
                mobileSortIcon.style.transform = 'rotate(180deg)';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileSortBtn.contains(e.target) && !mobileSortDropdown.contains(e.target)) {
                mobileSortDropdown.classList.add('hidden');
                mobileSortIcon.style.transform = 'rotate(0deg)';
            }
        });
    }

    // Apply sorting function
    function applySorting(sortBy) {
        const currentUrl = new URL(window.location.href);

        if (sortBy) {
            currentUrl.searchParams.set('sort', sortBy);
        } else {
            currentUrl.searchParams.delete('sort');
        }

        window.location.href = currentUrl.toString();
    }

    // Add CSS for line clamp
    const style = document.createElement('style');
    style.textContent = `
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
    </script>
</x-layouts.app>