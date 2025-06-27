<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Reseporia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logoreseporia.png') }}" />

    <style>
        /* Font Configuration */
        * {
            font-family: 'Poppins', 'Rubik', sans-serif;
        }
        
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        
        .font-rubik {
            font-family: 'Rubik', sans-serif;
        }
        
        /* Custom Styles */
        .navbar-green { 
            background: linear-gradient(135deg, #537D5D 0%, #8FBC8F 100%); 
        }
        .card-hover:hover { 
            transform: translateY(-2px); 
            transition: all 0.3s ease; 
        }

        /* Mobile Menu Animation */
        .mobile-menu {
            transition: all 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
        }
        
        .mobile-menu.active {
            max-height: 400px;
        }
        
        /* Active nav indicator */
        .nav-active {
            background: rgba(255, 255, 255, 0.2);
            border-bottom: 3px solid white;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Main Navbar -->
    <nav class="navbar-green text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo & Brand -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 lg:space-x-4 hover:opacity-80 transition-opacity">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-full overflow-hidden bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-8 h-8 lg:w-10 lg:h-10 object-contain" />
                    </div>
                    <div>
                        <h1 class="text-lg lg:text-xl font-bold">Reseporia</h1>
                        <p class="text-white/80 text-xs lg:text-sm hidden sm:block">Admin Panel</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                        <i class="fas fa-chart-pie"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.users.*') ? 'nav-active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span class="font-medium">User</span>
                    </a>
                    <a href="{{ route('admin.saran.index') }}" 
                       class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.saran.*') ? 'nav-active' : '' }}">
                        <i class="fas fa-comment-dots"></i>
                        <span class="font-medium">Saran</span>
                    </a>
                    <a href="{{ route('admin.recipes.index') }}" 
                       class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.recipes.*') ? 'nav-active' : '' }}">
                        <i class="fas fa-utensils"></i>
                        <span class="font-medium">Resep</span>
                    </a>
                    <a href="{{ route('admin.comments.index') }}" 
                       class="flex items-center space-x-2 px-4 py-2 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.comments.*') ? 'nav-active' : '' }}">
                        <i class="fas fa-comments"></i>
                        <span class="font-medium">Komentar</span>
                    </a>
                </div>

                <!-- Right Side Items -->
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <!-- Back to Website -->
                    <a href="{{ route('home') }}" 
                       class="hidden lg:flex items-center space-x-2 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span class="font-medium">Website</span>
                    </a>
                    
                    <!-- Date -->
                    <span class="text-white/80 text-xs lg:text-sm hidden sm:block">{{ date('d M Y') }}</span>
                    
                    <!-- Admin Icon -->
                    <div class="w-8 h-8 lg:w-10 lg:h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white"></i>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-md hover:bg-white/20 transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu lg:hidden bg-white/10 backdrop-blur-sm border-t border-white/20">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-chart-pie w-4"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-users w-4"></i>
                    <span class="font-medium">User</span>
                </a>
                <a href="{{ route('admin.saran.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm {{ request()->routeIs('admin.saran.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-comment-dots w-4"></i>
                    <span class="font-medium">Saran</span>
                </a>
                <a href="{{ route('admin.recipes.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm {{ request()->routeIs('admin.recipes.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-utensils w-4"></i>
                    <span class="font-medium">Resep</span>
                </a>
                <a href="{{ route('admin.comments.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm {{ request()->routeIs('admin.comments.*') ? 'bg-white/20' : '' }}">
                    <i class="fas fa-comments w-4"></i>
                    <span class="font-medium">Komentar</span>
                </a>
                
                <!-- Mobile Only Links -->
                <hr class="border-white/20 my-2">
                <a href="{{ route('home') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-colors text-sm">
                    <i class="fas fa-arrow-left w-4"></i>
                    <span class="font-medium">Kembali ke Website</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-4 lg:py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-gray-600 mt-1 text-sm lg:text-base">@yield('page-subtitle', 'Overview Statistik Reseporia')</p>
                </div>
                <div class="hidden lg:flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ date('l') }}</p>
                        <p class="text-lg font-semibold text-gray-700">{{ date('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 lg:px-6 py-6 lg:py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 lg:px-6 py-3 lg:py-4 rounded-lg mb-4 lg:mb-6 text-sm lg:text-base">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 lg:px-6 py-3 lg:py-4 rounded-lg mb-4 lg:mb-6 text-sm lg:text-base">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            function toggleMobileMenu() {
                mobileMenu.classList.toggle('active');
                
                // Change hamburger icon
                const icon = mobileMenuBtn.querySelector('i');
                if (mobileMenu.classList.contains('active')) {
                    icon.className = 'fas fa-times text-lg';
                } else {
                    icon.className = 'fas fa-bars text-lg';
                }
            }

            // Event listeners
            mobileMenuBtn?.addEventListener('click', toggleMobileMenu);

            // Close mobile menu when clicking nav links
            const mobileNavLinks = mobileMenu.querySelectorAll('a');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.querySelector('i').className = 'fas fa-bars text-lg';
                });
            });

            // Close mobile menu on resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.querySelector('i').className = 'fas fa-bars text-lg';
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>