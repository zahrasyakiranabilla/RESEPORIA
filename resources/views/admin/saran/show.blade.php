@extends('admin.layouts.app')

@section('title', 'Detail Saran')
@section('page-title', 'Detail Saran')
@section('page-subtitle', 'Saran dari ' . $saran->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-2xl text-green-600"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $saran->name }}</h2>
                    <p class="text-gray-500">{{ $saran->email }}</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                @if(!$saran->is_read)
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-circle mr-1"></i>Belum Dibaca
                    </span>
                @else
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i>Sudah Dibaca
                    </span>
                @endif
                
                <span class="text-sm text-gray-500">
                    {{ $saran->created_at->format('d M Y H:i') }}
                </span>
            </div>
        </div>
        
        <div class="text-sm text-gray-500">
            <i class="fas fa-clock mr-2"></i>
            Dikirim {{ $saran->created_at->diffForHumans() }}
        </div>
    </div>

    <!-- Saran Content -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Isi Saran</h3>
        
        <div class="bg-gray-50 rounded-lg p-6 border-l-4 border-green-500">
            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $saran->message }}</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
        
        <div class="flex flex-wrap gap-3">
            @if(!$saran->is_read)
                <form method="POST" action="{{ route('admin.saran.mark-read', $saran) }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="px-4 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-check mr-2"></i>Tandai Sebagai Dibaca
                    </button>
                </form>
            @endif
            
            <a href="mailto:{{ $saran->email }}?subject=Re: Saran untuk Reseporia&body=Halo {{ $saran->name }},%0D%0A%0D%0ATerima kasih atas saran Anda untuk Reseporia.%0D%0A%0D%0ASaran Anda: {{ urlencode($saran->message) }}%0D%0A%0D%0A" 
               class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors">
                <i class="fas fa-reply mr-2"></i>Balas via Email
            </a>
            
            <form method="POST" action="{{ route('admin.saran.destroy', $saran) }}" 
                  class="inline" 
                  onsubmit="return confirm('Yakin ingin menghapus saran ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                    <i class="fas fa-trash mr-2"></i>Hapus Saran
                </button>
            </form>
            
            <a href="{{ route('admin.saran.index') }}" 
               class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Saran
            </a>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kontak</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-user text-gray-500"></i>
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-900">{{ $saran->name }}</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-envelope text-gray-500"></i>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $saran->email }}</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-calendar text-gray-500"></i>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Kirim</p>
                    <p class="font-medium text-gray-900">{{ $saran->created_at->format('d F Y') }}</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-clock text-gray-500"></i>
                <div>
                    <p class="text-sm text-gray-500">Waktu Kirim</p>
                    <p class="font-medium text-gray-900">{{ $saran->created_at->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection