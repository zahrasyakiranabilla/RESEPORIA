@extends('admin.layouts.app')

@section('title', 'Kelola Resep - ' . $recipe->title)
@section('page-title', 'Kelola Resep')
@section('page-subtitle', 'Pengaturan admin untuk: ' . $recipe->title)

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    
    {{-- Recipe Preview Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-green-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Preview Resep</h3>
                    <p class="text-sm text-gray-500">Tampilan resep untuk pengguna</p>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Recipe Image --}}
                <div class="lg:col-span-1">
                    @if($recipe->image)
                        <img src="{{ asset($recipe->image) }}" 
                             alt="{{ $recipe->title }}" 
                             class="w-full h-64 object-cover rounded-xl shadow-sm">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-green-50 to-green-100 rounded-xl flex items-center justify-center border border-green-200">
                            <div class="text-center">
                                <i class="fas fa-utensils text-3xl text-green-400 mb-2"></i>
                                <p class="text-sm text-green-600 font-medium">Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                {{-- Recipe Info --}}
                <div class="lg:col-span-2">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $recipe->title }}</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $recipe->description }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wide">Informasi Resep</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tag text-blue-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Kategori</p>
                                        <p class="font-semibold text-gray-900">{{ ucfirst(str_replace('-', ' ', $recipe->category)) }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clock text-orange-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Waktu Masak</p>
                                        <p class="font-semibold text-gray-900">{{ $recipe->cooking_time }} menit</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-heart text-red-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Likes</p>
                                        <p class="font-semibold text-gray-900">{{ $recipe->likes ?? 0 }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-calendar text-purple-600 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">Dibuat</p>
                                        <p class="font-semibold text-gray-900">{{ $recipe->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Admin Note --}}
            <div class="mt-8 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl">
                <div class="flex items-start space-x-3">
                    <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mt-0.5">
                        <i class="fas fa-info text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">Catatan Admin:</span> Anda hanya dapat mengubah kategori dan status resep. Konten resep (bahan dan instruksi) adalah milik pengguna yang membuatnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Controls Section --}}
    <form method="POST" action="{{ route('admin.recipes.update', $recipe) }}">
        @csrf
        @method('PATCH')
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cog text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Pengaturan Admin</h3>
                        <p class="text-sm text-gray-500">Kelola kategori dan pengaturan resep</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                {{-- Category Selection --}}
                <div class="mb-8">
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-3">
                        Kategori Resep <span class="text-red-500">*</span>
                    </label>
                    <select id="category" 
                            name="category" 
                            required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('category') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $recipe->category) == $cat ? 'selected' : '' }}>
                                @if($cat == 'appetizer') 🥗 Appetizer
                                @elseif($cat == 'main-course') 🍽️ Main Course  
                                @elseif($cat == 'dessert') 🍰 Dessert
                                @elseif($cat == 'drinks') 🥤 Drinks
                                @else {{ ucfirst(str_replace('-', ' ', $cat)) }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">Pilih kategori yang sesuai untuk resep ini</p>
                </div>

                {{-- Action Buttons --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Update Settings --}}
                    <button type="submit" 
                            class="group relative px-6 py-4 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 font-semibold shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>Update Pengaturan</span>
                        </div>
                    </button>
                    
                    {{-- View Public --}}
                    <a href="{{ route('recipes.show', $recipe) }}" 
                       target="_blank"
                       class="group relative px-6 py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all duration-200 font-semibold shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Lihat Publik</span>
                        </div>
                    </a>
                    
                    {{-- Back Button --}}
                    <a href="{{ route('admin.recipes.show', $recipe) }}" 
                       class="group relative px-6 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 font-semibold shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </form>

    {{-- Danger Zone --}}
    <div class="bg-white rounded-2xl shadow-sm border-2 border-red-100 overflow-hidden">
        <div class="px-8 py-6 bg-gradient-to-r from-red-50 to-pink-50 border-b border-red-100">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-800">Danger Zone</h3>
                    <p class="text-sm text-red-600">Aksi berikut bersifat permanen dan tidak dapat dibatalkan</p>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <div class="bg-red-50 rounded-xl p-6 border border-red-200">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-trash text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-red-900 mb-1">Hapus Resep Permanen</h4>
                        <p class="text-sm text-red-700 mb-4">
                            Menghapus resep akan menghilangkan semua data termasuk gambar, bahan, dan instruksi. 
                            Tindakan ini tidak dapat dibatalkan.
                        </p>
                        
                        <form method="POST" 
                              action="{{ route('admin.recipes.destroy', $recipe) }}" 
                              onsubmit="return confirm('⚠️ KONFIRMASI PENGHAPUSAN ⚠️\n\nAnda akan menghapus resep: {{ $recipe->title }}\n\n• Semua data akan hilang permanen\n• Tindakan ini tidak dapat dibatalkan\n• Pengguna akan kehilangan resep mereka\n\nKetik HAPUS untuk melanjutkan:')"
                              class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold shadow-sm hover:shadow-md">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[method="POST"]:not([action*="destroy"])');
    const categorySelect = document.getElementById('category');
    
    // Form change tracking
    let formChanged = false;
    let originalCategory = categorySelect.value;
    
    // Track changes
    categorySelect.addEventListener('change', function() {
        formChanged = (this.value !== originalCategory);
        updateSaveButton();
    });
    
    // Update save button state
    function updateSaveButton() {
        const saveBtn = form.querySelector('button[type="submit"]');
        if (formChanged) {
            saveBtn.classList.add('animate-pulse');
            saveBtn.innerHTML = '<div class="flex items-center justify-center space-x-2"><i class="fas fa-save"></i><span>Simpan Perubahan</span></div>';
        } else {
            saveBtn.classList.remove('animate-pulse');
            saveBtn.innerHTML = '<div class="flex items-center justify-center space-x-2"><i class="fas fa-save"></i><span>Update Pengaturan</span></div>';
        }
    }
    
    // Unsaved changes warning
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'Ada perubahan yang belum disimpan. Yakin ingin keluar?';
        }
    });
    
    // Remove warning when form submitted
    form.addEventListener('submit', function() {
        formChanged = false;
    });
    
    // Enhanced delete confirmation
    const deleteForm = document.querySelector('form[action*="destroy"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const userConfirm = prompt(
                '⚠️ KONFIRMASI PENGHAPUSAN ⚠️\n\n' +
                'Untuk mengkonfirmasi penghapusan resep "{{ $recipe->title }}", ketik: HAPUS\n\n' +
                '⚠️ PERINGATAN:\n' +
                '• Semua data akan hilang permanen\n' +
                '• Tindakan ini tidak dapat dibatalkan\n' +
                '• Pengguna akan kehilangan resep mereka'
            );
            
            if (userConfirm === 'HAPUS') {
                this.submit();
            } else if (userConfirm !== null) {
                alert('Konfirmasi tidak sesuai. Penghapusan dibatalkan.');
            }
        });
    }
});
</script>
@endsection
@endsection