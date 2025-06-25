<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-[#76916d] text-white w-full max-w-md p-8 rounded-3xl shadow-xl animate-slideUp hover:shadow-2xl transition-all duration-300">

            <!-- Logo -->
            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-3 overflow-hidden hover:rotate-12 transition-transform duration-300">
                <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-full h-full object-contain">
            </div>

            <!-- Notifikasi Berhasil -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded-lg animate-slideDown">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Edit Profil -->
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                        class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white focus:scale-105 transition-all duration-200" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}"
                        class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white focus:scale-105 transition-all duration-200" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                        class="w-full px-4 py-3 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white focus:scale-105 transition-all duration-200" required>
                </div>

                <button type="submit"
                    class="w-full bg-white text-[#76916d] font-bold py-3 rounded-xl hover:bg-gray-100 hover:scale-105 active:scale-95 transition-all duration-200">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

    <style>
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slideUp { animation: slideUp 0.5s ease-out; }
        .animate-slideDown { animation: slideDown 0.3s ease-out; }
    </style>
</x-layouts.app>
