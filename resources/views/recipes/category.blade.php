<x-layouts.app>
    <x-slot name="title">{{ $categoryName }} - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50">
        <!-- Category Header -->
        <div class="bg-[#9EBC8A] text-white py-8">
            <div class="max-w-6xl mx-auto px-5">
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

        <!-- Recipe Cards Container -->
        <div class="max-w-6xl mx-auto px-5 py-10">
            @if($recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recipes as $recipe)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer group relative" onclick="goToDetail('{{ route('recipes.show', $recipe) }}')">
                            <!-- Recipe Image -->
                            <div class="overflow-hidden">
                                @if($recipe->image)
                                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-utensils text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Recipe Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-green-700 transition-colors">
                                    {{ $recipe->title }}
                                </h3>

                                <!-- Recipe Description (limited) -->
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ Str::limit($recipe->description, 80) }}
                                </p>

                                <!-- Recipe Stats -->
                                <div class="flex justify-between items-center text-gray-600 text-sm">
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500 text-lg"></i>
                                        <span class="font-bold text-base">{{ $recipe->rating }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-heart text-red-500 text-lg"></i>
                                        <span class="font-bold text-base">{{ $recipe->likes }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-clock text-blue-500 text-lg"></i>
                                        <span class="font-bold text-base">{{ $recipe->cooking_time }}m</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-[#9EBC8A] text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
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
                            <a href="{{ route('home') }}" class="block bg-[#9EBC8A] hover:bg-[#8BAA79] text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Kembali ke Beranda
                            </a>

                            <!-- Quick Category Links -->
                            <div class="flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('recipes.category', 'appetizer') }}" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Appetizer
                                </a>
                                <a href="{{ route('recipes.category', 'main-course') }}" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Main Course
                                </a>
                                <a href="{{ route('recipes.category', 'dessert') }}" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
                                    Dessert
                                </a>
                                <a href="{{ route('recipes.category', 'drinks') }}" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">
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

    // Sort functionality
    document.getElementById('sortSelect').addEventListener('change', function() {
        const sortBy = this.value;
        const currentUrl = new URL(window.location.href);

        if (sortBy) {
            currentUrl.searchParams.set('sort', sortBy);
        } else {
            currentUrl.searchParams.delete('sort');
        }

        window.location.href = currentUrl.toString();
    });
    </script>
</x-layouts.app>
