<x-layouts.app>
    <x-slot name="title">{{ $recipe->title }} - Reseporia</x-slot>

    <div class="min-h-screen bg-amber-50 pb-20">
        <!-- Header with Back Button -->
        <div class="bg-[#9EBC8A] px-6 py-4 flex items-center justify-center relative">
            <a href="javascript:history.back()" class="absolute left-6 p-2 rounded-full hover:bg-amber-200 transition-colors">
                <i class="fas fa-chevron-left text-gray-700 text-xl"></i>
            </a>
            <h1 class="text-xl font-bold text-gray-800">{{ $recipe->title }}</h1>
        </div>

     <!-- Recipe Image -->
        <div class="px-6 py-6 flex justify-center">
            <div class="w-96 h-64 bg-white rounded-2xl shadow-lg overflow-hidden flex items-center justify-center">
                @if($recipe->image)
                    <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-full object-cover">
                @else
                    <div class="text-gray-400 text-lg">gambar</div>
                @endif
            </div>
        </div>

        <!-- About Section -->
        <div class="mx-6 mb-6">
            <div class="bg-[#9EBC8A] rounded-2xl px-6 py-8 text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Tentang makanan</h2>
                <p class="text-gray-700 leading-relaxed">{{ $recipe->description }}</p>
            </div>
        </div>

        <!-- Ingredients Section -->
        <div class="mx-6 mb-6">
            <div class="bg-white rounded-2xl px-6 py-8 shadow-lg">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Bahan-Bahan</h2>
                <div class="space-y-3">
                    @if(is_array($recipe->ingredients))
                        @foreach($recipe->ingredients as $ingredient)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-700">{{ trim($ingredient) }}</span>
                            </div>
                        @endforeach
                    @else
                        @foreach(explode(';', $recipe->ingredients) as $ingredient)
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-gray-700">{{ trim($ingredient) }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="mx-6 mb-6">
            <div class="bg-white rounded-2xl px-6 py-8 shadow-lg">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Cara membuat</h2>
                <div class="space-y-4">
                    @foreach(explode('.', $recipe->instructions) as $index => $instruction)
                        @if(trim($instruction))
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ trim($instruction) }}.</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="mx-6 mb-6">
            <div class="bg-white rounded-2xl px-6 py-8 shadow-lg">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Video</h2>
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
                        <div class="w-full h-64 bg-gray-100 rounded-xl overflow-hidden">
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen class="w-full h-full">
                            </iframe>
                        </div>
                    @else
                        <div class="w-full h-64 bg-gray-100 rounded-xl flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-play-circle text-6xl mb-4"></i>
                                <p class="text-lg">Format URL video tidak dikenali</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="w-full h-64 bg-gray-100 rounded-xl flex items-center justify-center">
                        <div class="text-center text-gray-400">
                            <i class="fas fa-play-circle text-6xl mb-4"></i>
                            <p class="text-lg">Video belum tersedia</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mx-6 mb-6">
            <div class="bg-[#9EBC8A] rounded-2xl px-6 py-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">
                    Ulasan ({{ $recipe->totalComments() }})
                    @if($recipe->averageRating() > 0)
                        - Rating: {{ number_format($recipe->averageRating(), 1) }}/5 ⭐
                    @endif
                </h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Comment Form -->
                <div class="bg-white rounded-xl p-4 mb-4">
                    <form action="{{ route('comments.store', $recipe) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Tulis ulasan Anda:</label>
                            <textarea
                                id="comment"
                                name="comment"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                                placeholder="Bagikan pengalaman Anda tentang resep ini..."
                                required>{{ old('comment') }}</textarea>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <label for="rating" class="text-sm font-medium text-gray-700">Rating:</label>
                                <select id="rating" name="rating" class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-2 focus:ring-green-500">
                                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐</option>
                                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐</option>
                                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐</option>
                                </select>
                            </div>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Existing Comments -->
                <div class="space-y-3">
                    @forelse($comments as $comment)
                        <div class="bg-white rounded-xl p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-800">{{ $comment->user_name }}</span>
                                <div class="flex items-center space-x-1">
                                    <span class="text-yellow-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $comment->rating)
                                                ⭐
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl p-4 text-center text-gray-500">
                            Belum ada ulasan. Jadilah yang pertama memberikan ulasan!
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    @if($comments->hasPages())
                        <div class="mt-4 flex justify-center">
                            <div class="bg-white rounded-lg px-4 py-2">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Floating Save Button -->
        <div class="fixed bottom-6 right-6">
            <button onclick="toggleFavorite({{ $recipe->id }})" class="w-16 h-16 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center {{ $isFavorited ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                <i class="fas fa-bookmark text-xl"></i>
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
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-xl"></i>';
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
            btn.innerHTML = '<i class="fas fa-bookmark text-xl"></i>';

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

    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'error' ? 'bg-red-500' : 'bg-green-500';

        toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
        toast.textContent = message;

        document.body.appendChild(toast);

        // Show toast
        setTimeout(() => {
            toast.classList.remove('translate-x-full');
        }, 100);

        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
    </script>
</x-layouts.app>