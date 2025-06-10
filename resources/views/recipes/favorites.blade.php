<x-layouts.app>
    <x-slot name="title">Resep Favorit - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50 pb-10">
        <!-- Page Header -->
        <div class="bg-[#9EBC8A] text-white py-16">
            <div class="max-w-6xl mx-auto px-5 text-center">
                <h1 class="text-4xl font-bold mb-4">
                    <i class="fas fa-heart text-red-600 mr-3"></i>
                    Resep Favorit Saya
                </h1>
                <p class="text-white text-lg">Koleksi resep terbaik yang sudah Anda bookmark</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="max-w-6xl mx-auto px-5 py-10">
            @if($recipes->count() > 0)
                <!-- Recipe Count -->
                <div class="mb-8">
                    <p class="text-gray-600 text-lg">
                        <i class="fas fa-bookmark text-blue-500 mr-2"></i>
                        Anda memiliki <span class="font-bold text-green-700">{{ $recipes->count() }}</span> resep favorit
                    </p>
                </div>

                <!-- Recipe Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recipes as $recipe)
                        <a href="{{ route('recipes.show', $recipe) }}" class="group block">
                            <div class="bg-white rounded-2xl overflow-hidden shadow-xl group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300 relative">
                                <!-- Favorite Badge -->
                                <div class="absolute top-4 right-4 z-10">
                                    <div class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                        <i class="fas fa-heart mr-1"></i>
                                        Favorit
                                    </div>
                                </div>

                                <!-- Recipe Image -->
                                <div class="overflow-hidden">
                                    @if($recipe->image)
                                        <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
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
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
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

                                <!-- Remove from Favorites Button -->
                                <div class="px-6 pb-6">
                                    <button 
                                        onclick="event.preventDefault(); removeFavorite({{ $recipe->id }}, this)"
                                        class="w-full bg-red-100 hover:bg-red-200 text-red-700 py-2 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2"
                                    >
                                        <i class="fas fa-bookmark-slash"></i>
                                        <span>Hapus dari Favorit</span>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Back to Home Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                        <i class="fas fa-heart-broken text-gray-300 text-8xl mb-6"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Resep Favorit</h2>
                        <p class="text-gray-600 mb-8">Anda belum menambahkan resep apapun ke dalam daftar favorit. Mari jelajahi resep-resep menarik!</p>
                        
                        <a href="{{ route('home') }}" class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                            <i class="fas fa-utensils"></i>
                            <span>Jelajahi Resep</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
    function removeFavorite(recipeId, button) {
        // Add loading state
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menghapus...</span>';
        button.disabled = true;

        fetch(`/recipe/${recipeId}/favorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.favorited) {
                // Remove the card with animation
                const card = button.closest('.group');
                card.style.opacity = '0';
                card.style.transform = 'scale(0.9)';
                
                setTimeout(() => {
                    card.remove();
                    
                    // Check if no more favorites
                    const remainingCards = document.querySelectorAll('.group').length;
                    if (remainingCards === 0) {
                        location.reload(); // Reload to show empty state
                    }
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Restore button state on error
            button.innerHTML = originalText;
            button.disabled = false;
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
    </script>
</x-layouts.app>