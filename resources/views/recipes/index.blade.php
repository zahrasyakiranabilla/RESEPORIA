<x-layouts.app>
    <div class="pt-10 px-5">
        <!-- Dynamic Banner Section -->
        <div class="max-w-6xl mx-auto mb-10">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <!-- Banner Slides -->
                <div class="banner-slider relative h-96">
                    <!-- Banner 1 -->
                    <div class="banner-slide absolute inset-0 opacity-100 transition-opacity duration-500" data-banner="1">
                        <img src="{{ asset('images/banner1.png') }}" alt="Banner 1" class="w-full h-full object-cover">
                    </div>

                    <!-- Banner 2 -->
                    <div class="banner-slide absolute inset-0 opacity-0 transition-opacity duration-500" data-banner="2">
                        <img src="{{ asset('images/banner2.png') }}" alt="Banner 2" class="w-full h-full object-cover">
                    </div>

                    <!-- Banner 3 -->
                    <div class="banner-slide absolute inset-0 opacity-0 transition-opacity duration-500" data-banner="3">
                        <img src="{{ asset('images/banner3.png') }}" alt="Banner 3" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Banner Navigation Dots -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <button class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-80 transition-all" data-slide="1"></button>
                    <button class="dot w-3 h-3 rounded-full bg-white bg-opacity-100 hover:bg-opacity-80 transition-all" data-slide="2"></button>
                    <button class="dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-80 transition-all" data-slide="3"></button>
                </div>

                <!-- Banner Navigation Arrows -->
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full transition-all" id="prevBanner">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-3 rounded-full transition-all" id="nextBanner">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

    <!-- Filter Section with Green Background - Full Width Edge to Edge -->
    <div style="background-color: #73946B;" class="py-16 full-width-green">
        <div class="max-w-6xl mx-auto px-5">
            <div class="flex justify-center mb-16">
                <div class="bg-white rounded-full shadow-xl overflow-hidden">
                    <div class="flex">
                        <a href="{{ route('recipes.category', 'appetizer') }}" class="px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300" onmouseover="this.style.backgroundColor='#73946B'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                            Appetizer
                        </a>
                        <a href="{{ route('recipes.category', 'main-course') }}" class="px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300" onmouseover="this.style.backgroundColor='#73946B'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                            Main Course
                        </a>
                        <a href="{{ route('recipes.category', 'dessert') }}" class="px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300" onmouseover="this.style.backgroundColor='#73946B'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                            Dessert
                        </a>
                        <a href="{{ route('recipes.category', 'drinks') }}" class="px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300" onmouseover="this.style.backgroundColor='#73946B'; this.style.color='white';" onmouseout="this.style.backgroundColor=''; this.style.color='';">
                            Drinks
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recipe Cards Section -->
            <div class="max-w-6xl mx-auto px-5">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recipes->take(6) as $recipe)
                        <a href="{{ route('recipes.show', $recipe) }}" class="group block">
                            <div class="bg-white rounded-2xl overflow-hidden shadow-xl group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
                                <div class="overflow-hidden">
                                    <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 group-hover:text-green-700 transition-colors">
                                        {{ $recipe->title }}
                                    </h3>
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
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        // Banner Slider Functionality
        let currentSlide = 1;
        const totalSlides = 3;

        function showSlide(slideNumber) {
            // Hide all slides
            document.querySelectorAll('.banner-slide').forEach((slide, index) => {
                if (index + 1 === slideNumber) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                }
            });
            
            // Update dots
            document.querySelectorAll('.dot').forEach((dot, index) => {
                if (index + 1 === slideNumber) {
                    dot.classList.remove('bg-opacity-50');
                    dot.classList.add('bg-opacity-100');
                } else {
                    dot.classList.remove('bg-opacity-100');
                    dot.classList.add('bg-opacity-50');
                }
            });
            
            currentSlide = slideNumber;
        }

        function nextSlide() {
            const next = currentSlide >= totalSlides ? 1 : currentSlide + 1;
            showSlide(next);
        }

        function prevSlide() {
            const prev = currentSlide <= 1 ? totalSlides : currentSlide - 1;
            showSlide(prev);
        }

        // Event Listeners
        document.getElementById('nextBanner').addEventListener('click', nextSlide);
        document.getElementById('prevBanner').addEventListener('click', prevSlide);

        // Dot navigation
        document.querySelectorAll('.dot').forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index + 1);
            });
        });

        // Auto-slide every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
</x-layouts.app>