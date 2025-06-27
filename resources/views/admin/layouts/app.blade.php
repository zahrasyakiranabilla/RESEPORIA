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
        .sidebar-green { background: linear-gradient(135deg, #537D5D 0%, #8FBC8F 100%); }
        .card-hover:hover { transform: translateY(-2px); transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-80 sidebar-green text-white fixed h-full shadow-xl">
            <!-- Logo & Brand -->
            <div class="p-8 border-b border-white/20">
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-white flex items-center justify-center">
                        <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-12 h-12 object-contain" />
                    </div>
                    
                    <!-- Brand Text -->
                    <div>
                        <h1 class="text-2xl font-bold">Reseporia</h1>
                        <p class="text-white/80 text-sm">Admin Panel</p>
                    </div>
                </div>
            </div>


            <!-- Navigation -->
            <nav class="p-6">
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                            <i class="fas fa-chart-pie w-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : '' }}">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium">User</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.saran.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.saran.*') ? 'bg-white/20' : '' }}">
                            <i class="fas fa-comment-dots w-5"></i>
                            <span class="font-medium">Saran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.recipes.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.recipes.*') ? 'bg-white/20' : '' }}">
                            <i class="fas fa-utensils w-5"></i>
                            <span class="font-medium">Resep</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.comments.index') }}" 
                           class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors {{ request()->routeIs('admin.comments.*') ? 'bg-white/20' : '' }}">
                            <i class="fas fa-comments w-5"></i>
                            <span class="font-medium">Komentar</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-6 border-t border-white/20">
                <a href="{{ route('home') }}" 
                   class="flex items-center space-x-3 px-4 py-3 rounded-lg text-white hover:bg-white/20 transition-colors">
                    <i class="fas fa-arrow-left w-5"></i>
                    <span class="font-medium">Kembali ke Website</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-80">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-gray-600 mt-1">@yield('page-subtitle', 'Overview Statistik Reseporia')</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ date('d F Y') }}</span>
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-shield text-green-600"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>