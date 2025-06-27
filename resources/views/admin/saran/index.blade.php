@extends('admin.layouts.app')

@section('title', 'Kelola Saran')
@section('page-title', 'Kelola Saran')
@section('page-subtitle', 'Manajemen saran dan feedback dari user')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Total Saran</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-comment-dots text-blue-600"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Belum Dibaca</h3>
                <p class="text-2xl font-bold text-red-600">{{ $stats['unread'] }}</p>
            </div>
            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-envelope text-red-600"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Hari Ini</h3>
                <p class="text-2xl font-bold text-purple-600">{{ $stats['today'] }}</p>
            </div>
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-day text-purple-600"></i>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
    <form method="GET" action="{{ route('admin.saran.index') }}" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-64">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Cari nama, email, atau isi saran..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <option value="">Semua Status</option>
            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
        </select>
        <button type="submit" 
                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            <i class="fas fa-search mr-2"></i>Cari
        </button>
        @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.saran.index') }}" 
               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-times mr-2"></i>Reset
            </a>
        @endif
    </form>
</div>

<!-- Saran List -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-800">
            Daftar Saran ({{ $saran->total() }} total)
        </h3>
    </div>

    <div class="divide-y divide-gray-200">
        @forelse($saran as $item)
        <div class="p-6 hover:bg-gray-50 transition-colors {{ !$item->is_read ? 'bg-blue-50 border-l-4 border-blue-400' : '' }}">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $item->email }}</p>
                        </div>
                        @if(!$item->is_read)
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-medium">
                                <i class="fas fa-circle mr-1"></i>Baru
                            </span>
                        @endif
                    </div>
                    
                    <div class="mt-3">
                        <p class="text-gray-700 leading-relaxed">{{ Str::limit($item->message, 200) }}</p>
                        @if(strlen($item->message) > 200)
                            <a href="{{ route('admin.saran.show', $item) }}" class="text-blue-600 hover:text-blue-700 text-sm mt-1 inline-block">
                                Baca selengkapnya...
                            </a>
                        @endif
                    </div>
                    
                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ $item->created_at->format('d M Y H:i') }} ({{ $item->created_at->diffForHumans() }})</span>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-2 ml-4">
                    <a href="{{ route('admin.saran.show', $item) }}" 
                       class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm text-center">
                        <i class="fas fa-eye mr-1"></i>Detail
                    </a>
                    
                    @if(!$item->is_read)
                        <form method="POST" action="{{ route('admin.saran.mark-read', $item) }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-3 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors text-sm">
                                <i class="fas fa-check mr-1"></i>Tandai Baca
                            </button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.saran.destroy', $item) }}" 
                          class="inline" 
                          onsubmit="return confirm('Yakin ingin menghapus saran ini?')">
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
        <div class="p-12 text-center text-gray-500">
            <i class="fas fa-comment-dots text-4xl mb-4 text-gray-300"></i>
            <p class="text-lg mb-2">Tidak ada saran yang ditemukan</p>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.saran.index') }}" class="text-green-600 hover:text-green-700">
                    Lihat semua saran
                </a>
            @else
                <p class="text-sm">Belum ada saran dari user</p>
            @endif
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($saran->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $saran->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection