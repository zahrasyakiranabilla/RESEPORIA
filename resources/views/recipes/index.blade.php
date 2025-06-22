<x-layouts.app>
    <div class="pt-6 sm:pt-10 px-4 sm:px-5">
        <!-- Dynamic Banner Section -->
        <div class="max-w-6xl mx-auto mb-6 sm:mb-10">
            <div class="relative rounded-xl sm:rounded-2xl overflow-hidden shadow-lg sm:shadow-2xl">
                <!-- Banner Slides -->
                <div class="banner-slider relative h-48 sm:h-64 md:h-80 lg:h-96">
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
                <div class="absolute bottom-2 sm:bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    <button class="dot w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-80 transition-all" data-slide="1"></button>
                    <button class="dot w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-white bg-opacity-100 hover:bg-opacity-80 transition-all" data-slide="2"></button>
                    <button class="dot w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-80 transition-all" data-slide="3"></button>
                </div>

                <!-- Banner Navigation Arrows -->
                <button class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-2 sm:p-3 rounded-full transition-all" id="prevBanner">
                    <i class="fas fa-chevron-left text-sm sm:text-base"></i>
                </button>
                <button class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 hover:bg-opacity-50 text-white p-2 sm:p-3 rounded-full transition-all" id="nextBanner">
                    <i class="fas fa-chevron-right text-sm sm:text-base"></i>
                </button>
            </div>
        </div>

        <!-- Filter Section with Green Background - Full Width Edge to Edge -->
        <div style="background-color: #73946B;" class="py-8 sm:py-16 full-width-green">
            <div class="max-w-6xl mx-auto px-4 sm:px-5">
                
                <!-- Desktop Filter (Hidden on Mobile) -->
                <div class="hidden lg:flex justify-center mb-8 sm:mb-16">
                    <div class="bg-white rounded-full shadow-xl overflow-hidden">
                        <div class="flex">
                            <a href="{{ route('recipes.category', 'appetizer') }}" 
                               class="category-filter-btn px-8 xl:px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300 hover:bg-[#73946B] hover:text-white {{ request()->is('category/appetizer') ? 'bg-[#73946B] text-white' : '' }}">
                                Appetizer
                            </a>
                            <a href="{{ route('recipes.category', 'main-course') }}" 
                               class="category-filter-btn px-8 xl:px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300 hover:bg-[#73946B] hover:text-white {{ request()->is('category/main-course') ? 'bg-[#73946B] text-white' : '' }}">
                                Main Course
                            </a>
                            <a href="{{ route('recipes.category', 'dessert') }}" 
                               class="category-filter-btn px-8 xl:px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300 hover:bg-[#73946B] hover:text-white {{ request()->is('category/dessert') ? 'bg-[#73946B] text-white' : '' }}">
                                Dessert
                            </a>
                            <a href="{{ route('recipes.category', 'drinks') }}" 
                               class="category-filter-btn px-8 xl:px-12 py-4 text-gray-800 font-bold text-lg transition-all duration-300 hover:bg-[#73946B] hover:text-white {{ request()->is('category/drinks') ? 'bg-[#73946B] text-white' : '' }}">
                                Drinks
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile/Tablet Filter -->
                <div class="lg:hidden mb-8">
                    <!-- Category Selector Button -->
                    <div class="relative mb-4">
                        <button id="mobileFilterBtn" 
                                class="w-full bg-white rounded-xl p-4 shadow-xl flex items-center justify-between text-gray-700 font-bold">
                            <div class="flex items-center">
                                <i class="fas fa-filter mr-3 text-[#73946B]"></i>
                                <span id="selectedCategory">
                                    @if(request()->is('category/appetizer'))
                                        <i class="fas fa-cookie-bite mr-2"></i>Appetizer
                                    @elseif(request()->is('category/main-course'))
                                        <i class="fas fa-drumstick-bite mr-2"></i>Main Course
                                    @elseif(request()->is('category/dessert'))
                                        <i class="fas fa-ice-cream mr-2"></i>Dessert
                                    @elseif(request()->is('category/drinks'))
                                        <i class="fas fa-coffee mr-2"></i>Drinks
                                    @else
                                        Pilih Kategori
                                    @endif
                                </span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-200" id="dropdownIcon"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="mobileFilterDropdown" 
                             class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-20 hidden">
                            <a href="{{ route('home') }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100 {{ request()->is('/') ? 'bg-[#73946B] bg-opacity-10 text-[#73946B] font-bold' : '' }}">
                                <i class="fas fa-home mr-3 w-5"></i>
                                Semua Resep
                            </a>
                            <a href="{{ route('recipes.category', 'appetizer') }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100 {{ request()->is('category/appetizer') ? 'bg-[#73946B] bg-opacity-10 text-[#73946B] font-bold' : '' }}">
                                <i class="fas fa-cookie-bite mr-3 w-5"></i>
                                Appetizer
                            </a>
                            <a href="{{ route('recipes.category', 'main-course') }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100 {{ request()->is('category/main-course') ? 'bg-[#73946B] bg-opacity-10 text-[#73946B] font-bold' : '' }}">
                                <i class="fas fa-drumstick-bite mr-3 w-5"></i>
                                Main Course
                            </a>
                            <a href="{{ route('recipes.category', 'dessert') }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors border-b border-gray-100 {{ request()->is('category/dessert') ? 'bg-[#73946B] bg-opacity-10 text-[#73946B] font-bold' : '' }}">
                                <i class="fas fa-ice-cream mr-3 w-5"></i>
                                Dessert
                            </a>
                            <a href="{{ route('recipes.category', 'drinks') }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors {{ request()->is('category/drinks') ? 'bg-[#73946B] bg-opacity-10 text-[#73946B] font-bold' : '' }}">
                                <i class="fas fa-coffee mr-3 w-5"></i>
                                Drinks
                            </a>
                        </div>
                    </div>

                    <!-- Quick Filter Pills (Horizontal Scroll) -->
                    <div class="overflow-x-auto pb-2">
                        <div class="flex space-x-3 min-w-max px-1">
                            <a href="{{ route('home') }}" 
                               class="flex-shrink-0 px-4 py-2 bg-white rounded-full text-sm font-medium transition-all duration-200 {{ request()->is('/') ? 'bg-white text-[#73946B] shadow-md' : 'bg-white bg-opacity-70 text-gray-700 hover:bg-white hover:text-[#73946B]' }}">
                                <i class="fas fa-home mr-1"></i>
                                Semua
                            </a>
                            <a href="{{ route('recipes.category', 'appetizer') }}" 
                               class="flex-shrink-0 px-4 py-2 bg-white rounded-full text-sm font-medium transition-all duration-200 {{ request()->is('category/appetizer') ? 'bg-white text-[#73946B] shadow-md' : 'bg-white bg-opacity-70 text-gray-700 hover:bg-white hover:text-[#73946B]' }}">
                                <i class="fas fa-cookie-bite mr-1"></i>
                                Appetizer
                            </a>
                            <a href="{{ route('recipes.category', 'main-course') }}" 
                               class="flex-shrink-0 px-4 py-2 bg-white rounded-full text-sm font-medium transition-all duration-200 {{ request()->is('category/main-course') ? 'bg-white text-[#73946B] shadow-md' : 'bg-white bg-opacity-70 text-gray-700 hover:bg-white hover:text-[#73946B]' }}">
                                <i class="fas fa-drumstick-bite mr-1"></i>
                                Main Course
                            </a>
                            <a href="{{ route('recipes.category', 'dessert') }}" 
                               class="flex-shrink-0 px-4 py-2 bg-white rounded-full text-sm font-medium transition-all duration-200 {{ request()->is('category/dessert') ? 'bg-white text-[#73946B] shadow-md' : 'bg-white bg-opacity-70 text-gray-700 hover:bg-white hover:text-[#73946B]' }}">
                                <i class="fas fa-ice-cream mr-1"></i>
                                Dessert
                            </a>
                            <a href="{{ route('recipes.category', 'drinks') }}" 
                               class="flex-shrink-0 px-4 py-2 bg-white rounded-full text-sm font-medium transition-all duration-200 {{ request()->is('category/drinks') ? 'bg-white text-[#73946B] shadow-md' : 'bg-white bg-opacity-70 text-gray-700 hover:bg-white hover:text-[#73946B]' }}">
                                <i class="fas fa-coffee mr-1"></i>
                                Drinks
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recipe Cards Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    @foreach($recipes->take(6) as $recipe)
                        <a href="{{ route('recipes.show', $recipe) }}" class="group block">
                            <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-lg sm:shadow-xl group-hover:shadow-2xl group-hover:-translate-y-1 sm:group-hover:-translate-y-2 transition-all duration-300">
                                <div class="overflow-hidden">
                                    @if($recipe->image)
                                        <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-36 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-36 sm:h-48 bg-gray-200 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                            <i class="fas fa-utensils text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 sm:p-6">
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 group-hover:text-green-700 transition-colors line-clamp-2">
                                        {{ $recipe->title }}
                                    </h3>
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
        let isTransitioning = false;

        function showSlide(slideNumber) {
            if (isTransitioning) return;
            isTransitioning = true;

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
            
            setTimeout(() => {
                isTransitioning = false;
            }, 500);
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

        // Touch/swipe support for mobile
        let startX = 0;
        let endX = 0;
        const bannerSlider = document.querySelector('.banner-slider');

        if (bannerSlider) {
            bannerSlider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            bannerSlider.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });
        }

        function handleSwipe() {
            const threshold = 50;
            const diff = startX - endX;

            if (Math.abs(diff) > threshold) {
                if (diff > 0) {
                    nextSlide(); // Swipe left - next slide
                } else {
                    prevSlide(); // Swipe right - previous slide
                }
            }
        }

        // Auto-slide every 5 seconds
        let autoSlideInterval = setInterval(nextSlide, 5000);

        // Pause auto-slide on hover (desktop)
        if (bannerSlider) {
            bannerSlider.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });

            bannerSlider.addEventListener('mouseleave', () => {
                autoSlideInterval = setInterval(nextSlide, 5000);
            });
        }

        // Mobile Filter Dropdown
        const mobileFilterBtn = document.getElementById('mobileFilterBtn');
        const mobileFilterDropdown = document.getElementById('mobileFilterDropdown');
        const dropdownIcon = document.getElementById('dropdownIcon');

        if (mobileFilterBtn && mobileFilterDropdown) {
            mobileFilterBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                
                const isOpen = !mobileFilterDropdown.classList.contains('hidden');
                
                if (isOpen) {
                    mobileFilterDropdown.classList.add('hidden');
                    dropdownIcon.style.transform = 'rotate(0deg)';
                } else {
                    mobileFilterDropdown.classList.remove('hidden');
                    dropdownIcon.style.transform = 'rotate(180deg)';
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileFilterBtn.contains(e.target) && !mobileFilterDropdown.contains(e.target)) {
                    mobileFilterDropdown.classList.add('hidden');
                    dropdownIcon.style.transform = 'rotate(0deg)';
                }
            });

            // Close dropdown when selecting an option
            const dropdownLinks = mobileFilterDropdown.querySelectorAll('a');
            dropdownLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileFilterDropdown.classList.add('hidden');
                    dropdownIcon.style.transform = 'rotate(0deg)';
                });
            });
        }

        // Auto-scroll to active pill on mobile
        const pillsContainer = document.querySelector('.overflow-x-auto');
        if (pillsContainer) {
            const activePill = pillsContainer.querySelector('.shadow-md');
            if (activePill) {
                setTimeout(() => {
                    const containerRect = pillsContainer.getBoundingClientRect();
                    const pillRect = activePill.getBoundingClientRect();
                    const scrollLeft = activePill.offsetLeft - (containerRect.width - pillRect.width) / 2;
                    
                    pillsContainer.scrollTo({
                        left: Math.max(0, scrollLeft),
                        behavior: 'smooth'
                    });
                }, 100);
            }
        }

        // Hide scrollbar for webkit browsers
        const style = document.createElement('style');
        style.textContent = `
            .overflow-x-auto::-webkit-scrollbar {
                display: none;
            }
            .overflow-x-auto {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>
</x-layouts.app>