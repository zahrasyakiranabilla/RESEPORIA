@extends('admin.layouts.app')

@section('title', 'Detail User - ' . $user->name)
@section('page-title', 'Detail User')
@section('page-subtitle', 'Informasi lengkap dan aktivitas user')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- User Profile -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <!-- Profile Header -->
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-3xl text-green-600"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
                <div class="mt-2">
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                        Bergabung {{ $user->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            <!-- User Stats -->
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-utensils text-blue-600 mr-3"></i>
                        <span class="text-gray-700">Total Resep</span>
                    </div>
                    <span class="font-bold text-blue-600">{{ $userStats['total_recipes'] }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-comments text-green-600 mr-3"></i>
                        <span class="text-gray-700">Total Komentar</span>
                    </div>
                    <span class="font-bold text-green-600">{{ $userStats['total_comments'] }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-heart text-red-600 mr-3"></i>
                        <span class="text-gray-700">Like Diberikan</span>
                    </div>
                    <span class="font-bold text-red-600">{{ $userStats['total_likes_given'] }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-thumbs-up text-purple-600 mr-3"></i>
                        <span class="text-gray-700">Like Diterima</span>
                    </div>
                    <span class="font-bold text-purple-600">{{ $userStats['total_likes_received'] }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 space-y-3">
                <a href="{{ route('admin.users.edit', $user) }}" 
                   class="w-full px-4 py-2 bg-yellow-100 text-yellow-600 rounded-lg hover:bg-yellow-200 transition-colors text-center block">
                    <i class="fas fa-edit mr-2"></i>Edit User
                </a>
                
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan ikut terhapus.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors">
                        <i class="fas fa-trash mr-2"></i>Hapus User
                    </button>
                </form>
                
                <a href="{{ route('admin.users.index') }}" 
                   class="w-full px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors text-center block">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Latest Recipes -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Resep Terbaru</h3>
                <span class="text-sm text-gray-500">{{ $latestRecipes->count() }} dari {{ $userStats['total_recipes'] }} resep</span>
            </div>
            <div class="p-6">
                @if($latestRecipes->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($latestRecipes as $recipe)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 mb-2">{{ $recipe->title }}</h4>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $recipe->description }}</p>
                                    
                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ ucfirst($recipe->category) }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-heart text-red-500 mr-1"></i>
                                            {{ $recipe->likes_count }} likes
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-comment text-blue-500 mr-1"></i>
                                            {{ $recipe->comments_count }} komentar
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $recipe->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="ml-4 flex space-x-2">
                                    <a href="{{ route('admin.recipes.show', $recipe) }}" 
                                       class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                    <a href="{{ route('recipes.show', $recipe) }}" 
                                       target="_blank"
                                       class="px-3 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors text-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i>Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($userStats['total_recipes'] > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.recipes.index', ['user_id' => $user->id]) }}" 
                               class="text-green-600 hover:text-green-700 font-medium">
                                Lihat semua resep dari {{ $user->name }}
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-utensils text-3xl mb-2 text-gray-300"></i>
                        <p>Belum ada resep yang dibuat</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Latest Comments -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Komentar Terbaru</h3>
                <span class="text-sm text-gray-500">{{ $latestComments->count() }} dari {{ $userStats['total_comments'] }} komentar</span>
            </div>
            <div class="p-6">
                @if($latestComments->isNotEmpty())
                    <div class="space-y-4">
                        @foreach($latestComments as $comment)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="mb-3">
                                <a href="{{ route('recipes.show', $comment->recipe) }}" 
                                   target="_blank"
                                   class="font-medium text-blue-600 hover:text-blue-700">
                                    {{ $comment->recipe->title }}
                                </a>
                                <span class="text-sm text-gray-500 ml-2">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-gray-700">{{ $comment->comment }}</p>
                            </div>
                            
                            <div class="mt-3 flex justify-end">
                                <a href="{{ route('recipes.show', $comment->recipe) }}#comment-{{ $comment->id }}" 
                                   target="_blank"
                                   class="px-3 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors text-sm">
                                    <i class="fas fa-external-link-alt mr-1"></i>Lihat Komentar
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($userStats['total_comments'] > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.comments.index', ['user_id' => $user->id]) }}" 
                               class="text-green-600 hover:text-green-700 font-medium">
                                Lihat semua komentar dari {{ $user->name }}
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-comments text-3xl mb-2 text-gray-300"></i>
                        <p>Belum ada komentar yang dibuat</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
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
@endsection