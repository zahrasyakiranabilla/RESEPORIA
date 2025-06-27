@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview Statistik Reseporia')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Resep -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Resep</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalRecipes }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-utensils text-blue-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            <span class="text-green-600">+{{ $todayStats['recipes'] }}</span> hari ini
        </div>
    </div>

    <!-- Total User -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Total User</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            <span class="text-green-600">+{{ $todayStats['users'] }}</span> hari ini
        </div>
    </div>

    <!-- Total Kategori -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Kategori</h3>
                <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Recipe::distinct()->count('category') }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-tags text-purple-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            <span class="text-blue-600">Aktif</span>
        </div>
    </div>

    <!-- Total Saran -->
    <div class="bg-white rounded-xl shadow-sm p-6 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Saran</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $totalSaran }}</p>
            </div>
            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-comment-dots text-orange-600 text-xl"></i>
            </div>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            <span class="text-green-600">+{{ $todayStats['saran'] }}</span> hari ini
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Saran User Terbaru -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">User Terbaru</h3>
            </div>
            <div class="p-6">
                @if($latestUsers->isNotEmpty())
                    @foreach($latestUsers->take(3) as $user)
                    <div class="flex items-start space-x-4 mb-6 last:mb-0">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900">{{ $user->name }}</h4>
                                <span class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm mt-1">
                                "User baru bergabung dengan {{ $user->recipes_count ?? 0 }} resep"
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada user terbaru</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="space-y-6">
        <!-- Resep Populer -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Resep Populer</h3>
            </div>
            <div class="p-6">
                @if($popularRecipes->isNotEmpty())
                    @foreach($popularRecipes->take(3) as $recipe)
                    <div class="flex items-center justify-between mb-4 last:mb-0">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 text-sm">{{ Str::limit($recipe->title, 30) }}</h4>
                            <p class="text-gray-500 text-xs">Resep Admin</p>
                        </div>
                        <div class="text-right">
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs">
                                <i class="fas fa-heart mr-1"></i>{{ $recipe->likes }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-sm">Belum ada data</p>
                @endif
            </div>
        </div>

        <!-- Aktivitas Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Aktivitas Hari Ini</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Resep Baru</span>
                    <span class="font-semibold text-gray-900">{{ $todayStats['recipes'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">User Baru</span>
                    <span class="font-semibold text-gray-900">{{ $todayStats['users'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Komentar</span>
                    <span class="font-semibold text-gray-900">{{ $todayStats['comments'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Saran</span>
                    <span class="font-semibold text-gray-900">{{ $todayStats['saran'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Resep Terbaru -->
<div class="mt-8">
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Resep Terbaru</h3>
            <a href="{{ route('admin.recipes.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="p-6">
            @if($latestRecipes->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($latestRecipes as $recipe)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <h4 class="font-medium text-gray-900 mb-2">{{ Str::limit($recipe->title, 40) }}</h4>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="fas fa-utensils mr-2"></i>
                            <span>Resep by Admin</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $recipe->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs">
                                {{ $recipe->category }}
                            </span>
                            <a href="{{ route('admin.recipes.show', $recipe) }}" 
                               class="text-blue-600 hover:text-blue-700 text-sm">
                                Detail <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Belum ada resep</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any dashboard-specific JavaScript here
    console.log('Dashboard loaded');
</script>
@endsection