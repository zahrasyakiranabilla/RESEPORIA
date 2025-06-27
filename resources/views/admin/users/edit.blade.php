@extends('admin.layouts.app')

@section('title', 'Edit User - ' . $user->name)
@section('page-title', 'Edit User')
@section('page-subtitle', 'Update informasi user: ' . $user->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white rounded-xl shadow-sm p-8">
        @csrf
        @method('PATCH')
        
        <div class="space-y-6">
            <!-- Current Info Banner -->
            <div class="bg-gray-50 rounded-lg p-4 border">
                <h4 class="font-medium text-gray-900 mb-2">Informasi Saat Ini</h4>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Email:</span>
                        <span class="ml-2 font-medium">{{ $user->email }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Bergabung:</span>
                        <span class="ml-2 font-medium">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}"
                       required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-300 @enderror"
                       placeholder="Masukkan nama lengkap">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}"
                       required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-300 @enderror"
                       placeholder="user@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Section -->
            <div class="border-t pt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Update Password</h4>
                <p class="text-sm text-gray-600 mb-4">Kosongkan jika tidak ingin mengubah password</p>
                
                <!-- New Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('password') border-red-300 @enderror"
                           placeholder="Minimal 8 karakter (opsional)">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Ulangi password baru">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex space-x-4 pt-6">
                <button type="submit" 
                        class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition-colors font-medium">
                    <i class="fas fa-save mr-2"></i>Update User
                </button>
                
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="flex-1 px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:ring-4 focus:ring-gray-200 transition-colors font-medium text-center">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </div>
    </form>

    <!-- Warning Card -->
    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-medium text-yellow-900 mb-1">Peringatan</h4>
                <ul class="text-sm text-yellow-800 space-y-1">
                    <li>• Mengubah email akan mempengaruhi login user</li>
                    <li>• User perlu login ulang jika password diubah</li>
                    <li>• Pastikan email baru belum digunakan user lain</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection