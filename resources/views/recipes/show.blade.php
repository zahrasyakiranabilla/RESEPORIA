<x-layouts.app>
    <x-slot name="title">{{ $recipe->title }} - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50 pb-20 sm:pb-24">
        <!-- Header with Back Button -->
        <div class="bg-[#9EBC8A] px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-center relative">
            <a href="javascript:history.back()" class="absolute left-4 sm:left-6 p-2 rounded-full hover:bg-amber-200 transition-colors">
                <i class="fas fa-chevron-left text-gray-700 text-lg sm:text-xl"></i>
            </a>
            <h1 class="text-lg sm:text-xl font-bold text-gray-800 px-12 text-center leading-tight">{{ $recipe->title }}</h1>
        </div>

        <!-- Recipe Image -->
        <div class="px-4 sm:px-6 py-4 sm:py-6 flex justify-center">
            <div class="w-full max-w-sm sm:max-w-md lg:max-w-lg h-48 sm:h-64 lg:h-72 bg-white rounded-2xl shadow-lg overflow-hidden flex items-center justify-center">
                @if($recipe->image)
                    <img src="{{ asset($recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="text-gray-400 text-base sm:text-lg">gambar</div>
                @endif
            </div>
        </div>

        <!-- About Section -->
        <div class="mx-4 sm:mx-6 mb-6">
            <div class="bg-[#9EBC8A] rounded-2xl px-4 sm:px-6 py-6 sm:py-8 text-center">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4">Tentang makanan</h2>
                <p class="text-gray-700 leading-relaxed text-sm sm:text-base">{{ $recipe->description }}</p>
            </div>
        </div>

        <!-- Ingredients Section -->
        <div class="mx-4 sm:mx-6 mb-6">
            <div class="bg-white rounded-2xl px-4 sm:px-6 py-6 sm:py-8 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Bahan-Bahan</h2>
                <div class="space-y-3">
                    @if($recipe->ingredients && count($recipe->ingredients) > 0)
                        @foreach($recipe->ingredients as $ingredient)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-700">{{ $ingredient }}</span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center">Bahan-bahan belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="mx-4 sm:mx-6 mb-6">
            <div class="bg-white rounded-2xl px-4 sm:px-6 py-6 sm:py-8 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Cara membuat</h2>
                <div class="space-y-4">
                    @if($recipe->instructions && count($recipe->instructions) > 0)
                        @foreach($recipe->instructions as $index => $instruction)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <p class="text-gray-700 pt-1">{{ $instruction }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center">Instruksi belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="mx-4 sm:mx-6 mb-6">
            <div class="bg-white rounded-2xl px-4 sm:px-6 py-6 sm:py-8 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Video</h2>
                @if($recipe->video_url)
                    @php
    $videoId = null;
    if (Str::contains($recipe->video_url, 'youtube.com/watch?v=')) {
        $videoId = Str::after($recipe->video_url, 'v=');
    } elseif (Str::contains($recipe->video_url, 'youtu.be/')) {
        $videoId = Str::after($recipe->video_url, 'youtu.be/');
    }

                    @endphp

                    @if($videoId)
                        <div class="w-full h-48 sm:h-64 lg:h-80 bg-gray-100 rounded-xl overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen class="w-full h-full">
                            </iframe>
                        </div>
                    @else
                        <div class="w-full h-48 sm:h-64 lg:h-80 bg-gray-100 rounded-xl flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-play-circle text-4xl sm:text-6xl mb-2 sm:mb-4"></i>
                                <p class="text-sm sm:text-lg">Format URL video tidak dikenali</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="w-full h-48 sm:h-64 lg:h-80 bg-gray-100 rounded-xl flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-play-circle text-4xl sm:text-6xl mb-2 sm:mb-4"></i>
                            <p class="text-sm sm:text-lg">Video belum tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mx-4 sm:mx-6 mb-6">
            <div class="bg-[#9EBC8A] rounded-2xl px-4 sm:px-6 py-6 sm:py-8">
                <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">
                    <span class="block sm:inline">Ulasan ({{ $comments->total() ?? $comments->count() }})</span>
                    @if($recipe->averageRating() > 0)
                        <span class="block sm:inline text-sm sm:text-base mt-1 sm:mt-0">
                            - Rating: {{ number_format($recipe->averageRating(), 1) }}/5 ⭐
                        </span>
                    @endif
                </h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-3 sm:px-4 py-2 sm:py-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-3 sm:px-4 py-2 sm:py-3 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Comment Form -->
                <div class="bg-white rounded-xl p-3 sm:p-4 mb-4">
                    <form action="{{ route('comments.store', $recipe) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Tulis ulasan Anda:</label>
                            <textarea
                                id="comment"
                                name="comment"
                                rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none text-sm sm:text-base"
                                placeholder="Bagikan pengalaman Anda tentang resep ini..."
                                required>{{ old('comment') }}</textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
                            <div class="flex items-center space-x-2">
                                <label for="rating" class="text-sm font-medium text-gray-700">Rating:</label>
                                <select id="rating" name="rating" class="border border-gray-300 rounded px-2 sm:px-3 py-1 text-xs sm:text-sm focus:ring-2 focus:ring-green-500">
                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐</option>
                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐</option>
                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-4 sm:px-6 py-2 rounded-lg font-medium transition-colors text-sm sm:text-base">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Comments -->
                <div class="space-y-3">
                    @forelse($comments as $comment)
                        <div class="bg-white rounded-xl p-3 sm:p-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2 space-y-1 sm:space-y-0">
                                <span class="font-medium text-gray-800 text-sm sm:text-base">{{ $comment->user_name }}</span>
                                <div class="flex items-center space-x-2">
                                    <span class="text-yellow-500 text-sm">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $comment->rating)
                                                ⭐
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-xs sm:text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p class="text-gray-700 text-xs sm:text-sm leading-relaxed">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl p-4 text-center text-gray-500">
                            <div class="text-gray-400 mb-2">
                                <i class="fas fa-comment-slash text-2xl sm:text-3xl"></i>
                            </div>
                            <p class="text-sm sm:text-base">Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($comments->hasPages())
                        <div class="mt-4 flex justify-center">
                            <div class="bg-white rounded-lg px-3 sm:px-4 py-2 text-sm">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Floating Save Button -->
        <div class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 z-40">
            <button onclick="toggleFavorite({{ $recipe->id }})" class="w-12 h-12 sm:w-16 sm:h-16 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center {{ $isFavorited ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                <i class="fas fa-bookmark text-lg sm:text-xl"></i>
            </button>
        </div>
    </div>

    <script>
    function toggleFavorite(recipeId) {
        console.log('Button clicked, recipeId:', recipeId);

        const btn = event.currentTarget;
        const originalContent = btn.innerHTML;

        // Check CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        console.log('CSRF token found:', csrfToken ? 'Yes' : 'No');

        if (!csrfToken) {
            alert('CSRF token tidak ditemukan!');
            return;
        }

        // Add loading state
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-lg sm:text-xl"></i>';
        btn.disabled = true;

        fetch(`/recipe/${recipeId}/favorite`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return response.json();
        })
        .then(data => {
            console.log('Success data:', data);

            // Always show bookmark icon
            btn.innerHTML = '<i class="fas fa-bookmark text-lg sm:text-xl"></i>';

            if (data.favorited) {
                // Added to favorites - yellow/golden color
                btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                btn.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                showToast('Ditambahkan ke favorit! 🔖');
            } else {
                // Removed from favorites - blue color
                btn.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                btn.classList.add('bg-blue-500', 'hover:bg-blue-600');
                showToast('Dihapus dari favorit');
            }

            btn.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            btn.innerHTML = originalContent;
            btn.disabled = false;
            showToast('Gagal mengubah favorit: ' + error.message, 'error');
        });
    }

    // Toast notification function with responsive positioning
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';

        // Responsive positioning
        const isMobile = window.innerWidth < 640;
        const positionClass = isMobile ? 'top-4 left-4 right-4' : 'top-4 right-4';

        toast.className = `fixed ${positionClass} ${bgColor} text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 text-sm sm:text-base ${isMobile ? 'translate-y-[-100%]' : 'translate-x-full'}`;
        toast.textContent = message;

        document.body.appendChild(toast);

        // Show toast
        setTimeout(() => {
            if (isMobile) {
                toast.classList.remove('translate-y-[-100%]');
            } else {
                toast.classList.remove('translate-x-full');
            }
        }, 100);

        // Hide toast after 3 seconds
        setTimeout(() => {
            if (isMobile) {
                toast.classList.add('translate-y-[-100%]');
            } else {
                toast.classList.add('translate-x-full');
            }
            setTimeout(() => {
                if (document.body.contains(toast)) {
                    document.body.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }

    // Handle window resize for toast positioning
    window.addEventListener('resize', function() {
        // Remove any existing toasts on resize to prevent positioning issues
        const existingToasts = document.querySelectorAll('[class*="fixed"][class*="z-50"]');
        existingToasts.forEach(toast => {
            if (toast.textContent.includes('favorit') || toast.textContent.includes('Gagal')) {
                toast.remove();
            }
        });
    });
    </script>
</x-layouts.app>