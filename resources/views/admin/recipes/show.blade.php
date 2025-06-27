@extends('admin.layouts.app')

@section('title', 'Detail Resep - ' . $recipe->title)
@section('page-title', 'Detail Resep')
@section('page-subtitle', $recipe->title)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recipe Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Recipe Image & Basic Info -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="h-64 bg-gray-200 relative">
                @if($recipe->image)
                    <img src="{{ asset($recipe->image) }}" 
                        alt="{{ $recipe->title }}" 
                        class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-green-100">
                        <i class="fas fa-utensils text-6xl text-green-400"></i>
                    </div>
                @endif
                
                <!-- Category Badge -->
                <div class="absolute top-4 left-4">
                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ ucfirst($recipe->category) }}
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $recipe->title }}</h1>
                
                <div class="flex items-center space-x-6 text-sm text-gray-600 mb-4">
                    <span class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        {{ $recipe->cooking_time }}m
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-heart text-red-500 mr-2"></i>
                        {{ $recipeStats['likes_count'] }} likes
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-comment text-blue-500 mr-2"></i>
                        {{ $recipeStats['comments_count'] }} komentar
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $recipe->created_at->format('d M Y') }}
                    </span>
                </div>
                
                <p class="text-gray-700 leading-relaxed">{{ $recipe->description }}</p>
            </div>
        </div>

        <!-- Ingredients -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-list-ul mr-2 text-green-600"></i>Bahan-bahan
            </h3>
            <div class="space-y-2">
                @foreach($recipe->ingredients as $ingredient)
                    <div class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3 text-sm"></i>
                        <span class="text-gray-700">{{ $ingredient }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-list-ol mr-2 text-green-600"></i>Cara Memasak
            </h3>
            <div class="space-y-4">
                @foreach($recipe->instructions as $index => $instruction)
                    <div class="flex">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                            <span class="text-green-600 font-semibold text-sm">{{ $index + 1 }}</span>
                        </div>
                        <p class="text-gray-700 pt-1">{{ $instruction }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <!-- Recipe Stats -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Resep</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-heart text-red-500 mr-3"></i>
                        <span class="text-gray-700">Total Likes</span>
                    </div>
                    <span class="font-bold text-red-600">{{ $recipeStats['likes_count'] }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-comments text-blue-500 mr-3"></i>
                        <span class="text-gray-700">Total Komentar</span>
                    </div>
                    <span class="font-bold text-blue-600">{{ $recipeStats['comments_count'] }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-eye text-purple-500 mr-3"></i>
                        <span class="text-gray-700">Views</span>
                    </div>
                    <span class="font-bold text-purple-600">{{ $recipeStats['views_count'] }}</span>
                </div>
            </div>
        </div>

        <!-- Recipe Info -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Resep</h3>
            
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">ID Resep:</span>
                    <span class="font-medium">#{{ $recipe->id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Kategori:</span>
                    <span class="font-medium">{{ ucfirst($recipe->category) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Waktu Masak:</span>
                    <span class="font-medium">{{ $recipe->cooking_time }} menit</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="font-medium">{{ $recipe->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Diupdate:</span>
                    <span class="font-medium">{{ $recipe->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
            
            <div class="space-y-3">
                <a href="{{ route('admin.recipes.edit', $recipe) }}" 
                   class="w-full px-4 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors text-center block">
                    <i class="fas fa-edit mr-2"></i>Edit Resep
                </a>
                
                <a href="{{ route('recipes.show', $recipe) }}" 
                   target="_blank"
                   class="w-full px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-center block">
                    <i class="fas fa-external-link-alt mr-2"></i>Lihat di Website
                </a>
                
                <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus resep ini? Data tidak bisa dikembalikan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                        <i class="fas fa-trash mr-2"></i>Hapus Resep
                    </button>
                </form>
                
                <a href="{{ route('admin.recipes.index') }}" 
                   class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors text-center block">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection