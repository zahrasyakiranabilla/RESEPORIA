@extends('admin.layouts.app')

@section('title', 'Kelola Komentar')
@section('page-title', 'Kelola Komentar')
@section('page-subtitle', 'Moderasi komentar dari seluruh resep')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500">Total Komentar</h3>
                <p class="text-xl lg:text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-comments text-blue-600 text-sm lg:text-base"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500">Hari Ini</h3>
                <p class="text-xl lg:text-2xl font-bold text-green-600">{{ $stats['today'] }}</p>
            </div>
            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-green-600 text-sm lg:text-base"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500">Minggu Ini</h3>
                <p class="text-xl lg:text-2xl font-bold text-purple-600">{{ $stats['this_week'] }}</p>
            </div>
            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-week text-purple-600 text-sm lg:text-base"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500">Bulan Ini</h3>
                <p class="text-xl lg:text-2xl font-bold text-orange-600">{{ $stats['this_month'] }}</p>
            </div>
            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-orange-600 text-sm lg:text-base"></i>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 lg:p-6 mb-6">
    <form method="GET" action="{{ route('admin.comments.index') }}" class="space-y-4">
        <!-- Mobile-first Search Input -->
        <div class="w-full">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari isi komentar atau nama user..." 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
        </div>
        
        <!-- Filters Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- Rating Filter -->
            <select name="rating" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                <option value="">Semua Rating</option>
                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2)</option>
                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐ (1)</option>
            </select>
            
            <!-- Sort with Direction -->
            <div class="flex">
                <select name="sort" class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal</option>
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
                    <option value="user_name" {{ request('sort') == 'user_name' ? 'selected' : '' }}>Nama User</option>
                </select>
                
                <button type="button" 
                        onclick="toggleSortDirection()" 
                        class="px-3 py-3 border border-l-0 border-gray-300 rounded-r-lg hover:bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        title="Toggle Sort Direction">
                    <i class="fas fa-sort-{{ request('direction') == 'asc' ? 'up' : 'down' }} text-sm"></i>
                </button>
                <input type="hidden" name="direction" value="{{ request('direction', 'desc') }}" id="sortDirection">
            </div>
            
            <!-- Date From -->
            <input type="date" 
                   name="date_from" 
                   value="{{ request('date_from') }}"
                   placeholder="Dari tanggal"
                   class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
            
            <!-- Date To -->
            <input type="date" 
                   name="date_to" 
                   value="{{ request('date_to') }}"
                   placeholder="Sampai tanggal"
                   class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" 
                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                <i class="fas fa-search mr-2"></i>Cari
            </button>
            
            @if(request()->hasAny(['search', 'rating', 'sort', 'date_from', 'date_to']))
                <a href="{{ route('admin.comments.index') }}" 
                   class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-sm font-medium text-center">
                    <i class="fas fa-times mr-2"></i>Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Comments List -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <!-- Header -->
    <div class="px-4 lg:px-6 py-4 border-b border-gray-200">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">
            Daftar Komentar 
            <span class="text-sm font-normal text-gray-500">({{ $comments->total() }} total)</span>
        </h3>
    </div>

    <div class="divide-y divide-gray-200">
        @forelse($comments as $comment)
        <div class="p-4 lg:p-6 hover:bg-gray-50 transition-colors">
            <!-- Mobile Layout -->
            <div class="block lg:hidden">
                <!-- User Info -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            @if($comment->user_name && $comment->user_name !== 'Anonim')
                                <span class="text-green-600 font-medium text-xs">
                                    {{ strtoupper(substr($comment->user_name, 0, 2)) }}
                                </span>
                            @else
                                <i class="fas fa-user-secret text-gray-500 text-xs"></i>
                            @endif
                        </div>
                        
                        <h4 class="font-medium text-gray-900 text-sm">
                            @if($comment->user_name)
                                {{ $comment->user_name }}
                            @elseif(isset($comment->user))
                                {{ $comment->user->name }}
                            @else
                                Anonim
                            @endif
                        </h4>
                    </div>
                    
                    <!-- Mobile Actions -->
                    <div class="flex space-x-2">
                        @if($comment->recipe)
                            <a href="{{ route('recipes.show', $comment->recipe) }}#comment-{{ $comment->id }}" 
                               target="_blank"
                               class="px-2 py-1 bg-blue-100 text-blue-600 rounded text-xs">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" 
                              class="inline" 
                              onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-2 py-1 bg-red-100 text-red-600 rounded text-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Recipe Info -->
                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                    <p class="text-xs text-gray-600 mb-1">Komentar pada resep:</p>
                    @if($comment->recipe)
                        <a href="{{ route('recipes.show', $comment->recipe) }}" 
                           class="font-medium text-blue-600 hover:text-blue-700 text-sm block truncate" 
                           target="_blank">
                            {{ $comment->recipe->title }}
                        </a>
                    @else
                        <span class="text-gray-500 text-sm">Resep tidak ditemukan</span>
                    @endif
                </div>
                
                <!-- Rating -->
                @if(isset($comment->rating))
                    <div class="flex items-center mb-3">
                        <span class="text-xs text-gray-600 mr-2">Rating:</span>
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $comment->rating)
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                @else
                                    <i class="far fa-star text-gray-300 text-xs"></i>
                                @endif
                            @endfor
                            <span class="ml-2 text-xs font-medium text-gray-700">
                                ({{ $comment->rating }}/5)
                            </span>
                        </div>
                    </div>
                @endif
                
                <!-- Comment Content -->
                <div class="bg-white border border-gray-200 rounded-lg p-3 mb-3">
                    <p class="text-gray-700 leading-relaxed text-sm">{{ $comment->comment }}</p>
                </div>
                
                <!-- Timestamp -->
                <div class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $comment->created_at->format('d M Y H:i') }}</span>
                    <span class="ml-2">({{ $comment->created_at->diffForHumans() }})</span>
                </div>
            </div>

            <!-- Desktop Layout -->
            <div class="hidden lg:flex items-start justify-between">
                <div class="flex-1">
                    <!-- User Info -->
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            @if($comment->user_name && $comment->user_name !== 'Anonim')
                                <span class="text-green-600 font-medium text-sm">
                                    {{ strtoupper(substr($comment->user_name, 0, 2)) }}
                                </span>
                            @else
                                <i class="fas fa-user-secret text-gray-500"></i>
                            @endif
                        </div>
                        
                        <h4 class="font-medium text-gray-900">
                            @if($comment->user_name)
                                {{ $comment->user_name }}
                            @elseif(isset($comment->user))
                                {{ $comment->user->name }}
                            @else
                                Anonim
                            @endif
                        </h4>
                    </div>
                    
                    <!-- Recipe Info -->
                    <div class="bg-gray-50 rounded-lg p-3 mb-3">
                        <p class="text-sm text-gray-600">Komentar pada resep:</p>
                        @if($comment->recipe)
                            <a href="{{ route('recipes.show', $comment->recipe) }}" 
                               class="font-medium text-blue-600 hover:text-blue-700" 
                               target="_blank">
                                {{ $comment->recipe->title }}
                            </a>
                        @else
                            <span class="text-gray-500">Resep tidak ditemukan</span>
                        @endif
                    </div>
                    
                    <!-- Rating -->
                    @if(isset($comment->rating))
                        <div class="flex items-center mb-3">
                            <span class="text-sm text-gray-600 mr-2">Rating:</span>
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $comment->rating)
                                        <i class="fas fa-star text-yellow-400"></i>
                                    @else
                                        <i class="far fa-star text-gray-300"></i>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm font-medium text-gray-700">
                                    ({{ $comment->rating }}/5)
                                </span>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Comment Content -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-3">
                        <p class="text-gray-700 leading-relaxed">{{ $comment->comment }}</p>
                    </div>
                    
                    <!-- Timestamp -->
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ $comment->created_at->format('d M Y H:i') }} ({{ $comment->created_at->diffForHumans() }})</span>
                    </div>
                </div>
                
                <!-- Desktop Actions -->
                <div class="ml-6 flex flex-col space-y-2">
                    @if($comment->recipe)
                        <a href="{{ route('recipes.show', $comment->recipe) }}#comment-{{ $comment->id }}" 
                           target="_blank"
                           class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm text-center">
                            <i class="fas fa-external-link-alt mr-1"></i>Lihat
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" 
                          class="inline" 
                          onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full px-3 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors text-sm">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 lg:p-12 text-center text-gray-500">
            <i class="fas fa-comments text-3xl lg:text-4xl mb-4 text-gray-300"></i>
            <p class="text-base lg:text-lg mb-2">Tidak ada komentar yang ditemukan</p>
            @if(request()->hasAny(['search', 'rating', 'sort', 'date_from', 'date_to']))
                <a href="{{ route('admin.comments.index') }}" class="text-green-600 hover:text-green-700 text-sm">
                    Lihat semua komentar
                </a>
            @else
                <p class="text-sm">Belum ada komentar dari user</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($comments->hasPages())
        <div class="px-4 lg:px-6 py-4 border-t border-gray-200">
            <div class="pagination-wrapper">
                {{ $comments->withQueryString()->links() }}
            </div>
        </div>
    @endif
</div>

<style>
/* Custom pagination styles for mobile */
@media (max-width: 640px) {
    .pagination-wrapper .flex {
        flex-wrap: wrap;
        gap: 0.25rem;
    }
    
    .pagination-wrapper .pagination {
        font-size: 0.875rem;
    }
    
    .pagination-wrapper .pagination .page-link {
        padding: 0.5rem 0.75rem;
        min-width: 2rem;
        text-align: center;
    }
}

/* Better responsive form layout */
@media (max-width: 640px) {
    .grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-4 {
        gap: 0.75rem;
    }
}
</style>
@endsection

@section('scripts')
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
    const selects = document.querySelectorAll('select[name="rating"], select[name="sort"]');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            document.querySelector('form').submit();
        });
    });
});
</script>
@endsection