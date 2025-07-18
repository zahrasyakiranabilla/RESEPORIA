@extends('admin.layouts.app')

@section('title', 'Kelola User')
@section('page-title', 'Kelola User')
@section('page-subtitle', 'Manajemen dan monitoring user Reseporia')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 lg:p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500">Total User</h3>
                <p class="text-xl lg:text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
            <div class="w-8 h-8 lg:w-10 lg:h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-blue-600 text-sm lg:text-base"></i>
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
                <i class="fas fa-user-plus text-green-600 text-sm lg:text-base"></i>
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
    <form method="GET" action="{{ route('admin.users.index') }}" class="space-y-4">
        <!-- Search Input -->
        <div class="w-full">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari nama atau email user..." 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
        </div>
        
        <!-- Date Range -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input type="date" 
                   name="date_from" 
                   value="{{ request('date_from') }}"
                   placeholder="Dari tanggal"
                   class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm">
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
            @if(request()->hasAny(['search', 'date_from', 'date_to']))
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors text-sm font-medium text-center">
                    <i class="fas fa-times mr-2"></i>Reset
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Active Filters Display -->
@if(request()->hasAny(['search', 'date_from', 'date_to']))
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
            
            @if(request('date_from'))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Dari: {{ \Carbon\Carbon::parse(request('date_from'))->format('d M Y') }}
                    <a href="{{ request()->fullUrlWithQuery(['date_from' => null]) }}" class="ml-2 text-green-600 hover:text-green-800">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            @endif
            
            @if(request('date_to'))
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    Sampai: {{ \Carbon\Carbon::parse(request('date_to'))->format('d M Y') }}
                    <a href="{{ request()->fullUrlWithQuery(['date_to' => null]) }}" class="ml-2 text-purple-600 hover:text-purple-800">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            @endif
        </div>
    </div>
@endif

<!-- Users List -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <!-- Header -->
    <div class="px-4 lg:px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h3 class="text-base lg:text-lg font-semibold text-gray-800">
            Daftar User
            <span class="text-sm font-normal text-gray-500">({{ $users->total() }} total)</span>
        </h3>
        <div class="flex items-center space-x-2 text-xs lg:text-sm text-gray-500">
            <i class="fas fa-info-circle"></i>
            <span>{{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }}</span>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="lg:hidden divide-y divide-gray-200">
        @forelse($users as $user)
        <div class="p-4 hover:bg-gray-50 transition-colors">
            <div class="flex items-center space-x-4">
                <!-- Avatar -->
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-green-600 font-medium text-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </span>
                </div>
                
                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle mr-1 text-xs"></i>
                            Aktif
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 truncate mb-2">{{ $user->email }}</p>
                    <div class="flex items-center text-xs text-gray-400">
                        <i class="fas fa-calendar mr-1"></i>
                        <span>{{ $user->created_at->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="p-8 text-center text-gray-500">
            <i class="fas fa-users text-3xl mb-4 text-gray-300"></i>
            <p class="text-base mb-2">Tidak ada user yang ditemukan</p>
            @if(request()->hasAny(['search', 'date_from', 'date_to']))
                <a href="{{ route('admin.users.index') }}" class="text-green-600 hover:text-green-700 inline-flex items-center text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Lihat semua user
                </a>
            @else
                <p class="text-sm text-gray-400">Belum ada user yang terdaftar</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center space-x-1">
                            <span>User</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center space-x-1">
                            <span>Status</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center space-x-1">
                            <span>Bergabung</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-green-600 font-medium text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle mr-1 text-xs"></i>
                            Aktif
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="flex flex-col">
                            <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                            <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                        <p class="text-lg font-medium mb-2">Tidak ada user yang ditemukan</p>
                        @if(request()->hasAny(['search', 'date_from', 'date_to']))
                            <a href="{{ route('admin.users.index') }}" class="text-green-600 hover:text-green-700 inline-flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Lihat semua user
                            </a>
                        @else
                            <p class="text-sm text-gray-400">Belum ada user yang terdaftar</p>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="px-4 lg:px-6 py-4 border-t border-gray-200">
            <div class="pagination-wrapper">
                {{ $users->withQueryString()->links() }}
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
        justify-content: center;
    }
    
    .pagination-wrapper .pagination {
        font-size: 0.875rem;
    }
    
    .pagination-wrapper .pagination .page-link {
        padding: 0.5rem 0.75rem;
        min-width: 2.5rem;
        text-align: center;
    }
}

/* Better responsive spacing */
@media (max-width: 640px) {
    .grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-4 {
        gap: 1rem;
    }
}
</style>
@endsection