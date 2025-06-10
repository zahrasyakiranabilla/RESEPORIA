<x-layouts.app>
    <x-slot name="title">Hasil Pencarian: {{ $query ?? 'Search' }} - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50 py-10">
        <div class="max-w-6xl mx-auto px-5">
            
            <!-- Search Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    Hasil Pencarian: "{{ $query }}"
                </h1>
                <p class="text-gray-600">
                    Ditemukan {{ $recipes->count() ?? 0 }} resep
                </p>
            </div>
            
            @if(isset($recipes) && $recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recipes as $recipe)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 cursor-pointer group" onclick="window.location.href='{{ route('recipes.show', $recipe) }}'">
                            <!-- Recipe Image -->
                            <div class="overflow-hidden">
                                @if($recipe->image)
                                    <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <i class="fas fa-utensils text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Recipe Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-700 transition-colors">
                                    @if(function_exists('highlightSearch'))
                                        {!! highlightSearch($recipe->title, $query) !!}
                                    @else
                                        {{ $recipe->title }}
                                    @endif
                                </h3>
                                
                                <!-- Recipe Description -->
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    @if(function_exists('highlightSearch'))
                                        {!! highlightSearch(Str::limit($recipe->description, 80), $query) !!}
                                    @else
                                        {{ Str::limit($recipe->description, 80) }}
                                    @endif
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

                                <!-- Category Badge -->
                                <div class="mt-4">
                                    <span class="bg-[#9EBC8A] text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ $recipe->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Search Match Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                                    <i class="fas fa-search mr-1"></i>
                                    Match
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Search Tips -->
                <div class="mt-16 bg-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">💡 Tips Pencarian</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Kata Kunci:</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li>• Coba kata kunci yang lebih spesifik</li>
                                <li>• Gunakan nama bahan makanan</li>
                                <li>• Cari berdasarkan jenis masakan</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Contoh:</h4>
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('recipes.search', ['q' => 'ayam']) }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">ayam</a>
                                <a href="{{ route('recipes.search', ['q' => 'pedas']) }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">pedas</a>
                                <a href="{{ route('recipes.search', ['q' => 'dessert']) }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">dessert</a>
                                <a href="{{ route('recipes.search', ['q' => '30 menit']) }}" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full transition-colors">30 menit</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Results State -->
                <div class="text-center py-20">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-lg mx-auto">
                        <i class="fas fa-search text-gray-300 text-8xl mb-6"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tidak Ada Hasil</h2>
                        <p class="text-gray-600 mb-6">Maaf, tidak ditemukan resep untuk <strong>"{{ $query }}"</strong></p>
                        
                        <div class="space-y-4">
                            <!-- Search Again -->
                            <form action="{{ route('recipes.search') }}" method="GET" class="flex">
                                <input type="text" name="q" placeholder="Coba kata kunci lain..." 
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <button type="submit" class="bg-[#9EBC8A] hover:bg-[#8BAA79] text-white px-6 py-3 rounded-r-lg font-medium transition-colors">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>

                            <!-- Suggestions -->
                            <div class="text-left">
                                <h4 class="font-semibold text-gray-700 mb-3">Saran Pencarian:</h4>
                                <div class="space-y-2">
                                    <div class="flex flex-wrap gap-2">
                                        <span class="text-sm text-gray-500">Populer:</span>
                                        <a href="{{ route('recipes.search', ['q' => 'nasi']) }}" class="text-sm bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-full transition-colors">nasi</a>
                                        <a href="{{ route('recipes.search', ['q' => 'ayam']) }}" class="text-sm bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-full transition-colors">ayam</a>
                                        <a href="{{ route('recipes.search', ['q' => 'sayur']) }}" class="text-sm bg-green-100 hover:bg-green-200 text-green-700 px-3 py-1 rounded-full transition-colors">sayur</a>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="text-sm text-gray-500">Kategori:</span>
                                        <a href="{{ route('recipes.category', 'appetizer') }}" class="text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-full transition-colors">Appetizer</a>
                                        <a href="{{ route('recipes.category', 'main-course') }}" class="text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-full transition-colors">Main Course</a>
                                        <a href="{{ route('recipes.category', 'dessert') }}" class="text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 px-3 py-1 rounded-full transition-colors">Dessert</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Back to Home -->
                            <a href="{{ route('home') }}" class="block bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium transition-colors">
                                <i class="fas fa-home mr-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>