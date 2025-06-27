@extends('admin.layouts.app')

@section('title', 'Kelola Resep')
@section('page-title', 'Kelola Resep')
@section('page-subtitle', 'Manajemen resep dari seluruh user')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Resep</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-utensils text-blue-600"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Hari Ini</h3>
                <p class="text-2xl font-bold text-green-600">{{ $stats['today'] }}</p>
            </div>
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-green-600"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Minggu Ini</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $stats['this_week'] }}</p>
            </div>
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-week text-purple-600"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Bulan Ini</h3>
                <p class="text-2xl font-bold text-orange-600">{{ $stats['this_month'] }}</p>
            </div>
            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-orange-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <form method="GET" action="{{ route('admin.recipes.index') }}" class="flex flex-wrap gap-4">
        <!-- Search Input -->
        <div class="flex-1 min-w-64">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari judul resep..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
        
        <!-- Category Filter -->
        <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                    {{ str_replace('-', ' ', ucwords($category, '-')) }}
                </option>
            @endforeach
        </select>
        
        <!-- Sort Options -->
        <div class="flex items-center space-x-2">
            <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal Dibuat</option>
                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul</option>
                <option value="category" {{ request('sort') == 'category' ? 'selected' : '' }}>Kategori</option>
                <option value="likes" {{ request('sort') == 'likes' ? 'selected' : '' }}>Likes</option>
            </select>
            
            <!-- Sort Direction Toggle -->
            <button type="button" 
                    onclick="toggleSortDirection()" 
                    class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    title="Toggle Sort Direction">
                <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }}"></i>
            </button>
            <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}" id="sortDirection">
        </div>
        
        <!-- Action Buttons -->
        <button type="submit" 
                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            <i class="fas fa-search mr-2"></i>Cari
        </button>
        
        @if(request()->hasAny(['search', 'category', 'sort']))
            <a href="{{ route('admin.recipes.index') }}" 
               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-times mr-2"></i>Reset
            </a>
        @endif
    </form>
</div>

<!-- Active Filters Display -->
@if(request()->hasAny(['search', 'category']))
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-sm text-gray-600 font-medium">Filter aktif:</span>
            
            @if(request('search'))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Pencarian: "{{ request('search') }}"
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-2 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            @endif
            
            @if(request('category'))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Kategori: {{ str_replace('-', ' ', ucwords(request('category'), '-')) }}
                    <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ml-2 text-green-600 hover:text-green-800">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            @endif
        </div>
    </div>
@endif

<!-- Recipes Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($recipes as $recipe)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
        <!-- Recipe Image -->
        <div class="h-48 bg-gray-200 relative">
            @if($recipe->image)
                <img src="{{ asset($recipe->image) }}" 
                    alt="{{ $recipe->title }}" 
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-green-100">
                    <i class="fas fa-utensils text-4xl text-green-400"></i>
                </div>
            @endif
            
            <!-- Category Badge -->
            <span class="absolute top-3 left-3 bg-green-600 text-white px-2 py-1 rounded-lg text-xs font-medium">
                {{ str_replace('-', ' ', ucwords($recipe->category, '-')) }}
            </span>
        </div>
        
        <!-- Recipe Info -->
        <div class="p-6">
            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $recipe->title }}</h3>
            
            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $recipe->description }}</p>
            
            <!-- Stats -->
            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                @if(isset($recipe->cooking_time))
                    <span class="flex items-center">
                        <i class="fas fa-clock text-gray-400 mr-1"></i>
                        {{ $recipe->cooking_time }}m
                    </span>
                @endif
                <span class="flex items-center">
                    <i class="fas fa-heart text-red-500 mr-1"></i>
                    {{ $recipe->likes ?? 0 }}
                </span>
                <span class="flex items-center">
                    <i class="fas fa-calendar text-gray-400 mr-1"></i>
                    {{ $recipe->created_at->format('d M') }}
                </span>
            </div>
            
            <!-- Actions -->
            <div class="flex space-x-2">
                <a href="{{ route('admin.recipes.show', $recipe) }}" 
                   class="flex-1 px-3 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm text-center">
                    <i class="fas fa-eye mr-1"></i>Detail
                </a>
                <a href="{{ route('admin.recipes.edit', $recipe) }}" 
                   class="flex-1 px-3 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors text-sm text-center">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" 
                      class="flex-1" 
                      onsubmit="return confirm('Yakin ingin menghapus resep ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-xl shadow-sm p-12 text-center">
        <i class="fas fa-utensils text-4xl mb-4 text-gray-300"></i>
        <p class="text-lg text-gray-500 mb-2">Tidak ada resep yang ditemukan</p>
        @if(request()->hasAny(['search', 'category', 'sort']))
            <a href="{{ route('admin.recipes.index') }}" class="text-green-600 hover:text-green-700">
                Lihat semua resep
            </a>
        @else
            <p class="text-sm text-gray-400">Belum ada resep yang dibuat oleh user</p>
        @endif
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($recipes->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $recipes->withQueryString()->links() }}
    </div>
@endif
@endsection

@section('scripts')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
function toggleSortDirection() {
    const directionInput = document.getElementById('sortDirection');
    const currentDirection = directionInput.value;
    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
    directionInput.value = newDirection;
    
    // Update icon
    const icon = event.target.querySelector('i') || event.target;
    icon.className = `fas fa-sort-${newDirection === 'asc' ? 'up' : 'down'}`;
    
    // Auto submit form
    document.querySelector('form').submit();
}

// Auto-submit form on select change
document.addEventListener('DOMContentLoaded', function() {
    const selects = document.querySelectorAll('select[name="category"], select[name="sort"]');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            document.querySelector('form').submit();
        });
    });
});
</script>
@endsection