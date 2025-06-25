<x-layouts.app>
    <div class="min-h-screen bg-[#e6e2c7] flex items-center justify-center py-24 px-4">
        <div class="w-full max-w-3xl bg-[#73946B] rounded-3xl shadow-2xl px-10 md:px-20 py-20 text-white text-center relative">

            <!-- Tombol Back -->
            <a href="{{ route('home') }}"
               class="absolute left-6 top-6 md:left-8 md:top-8 text-white bg-black/20 hover:bg-black/40 p-3 rounded-full transition">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>

            <!-- Foto Profil -->
            <div class="flex justify-center mb-12">
                <div class="w-36 h-36 md:w-40 md:h-40 rounded-full bg-[#e6e2c7] flex items-center justify-center text-[#73946B] text-6xl shadow-inner">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <!-- Informasi Profil -->
            <div class="mb-16">
                <h2 class="text-5xl font-bold tracking-wide mb-4">{{ Auth::user()->name }}</h2>

                <!-- Username -->
                <p class="text-base italic text-white/70 mb-2 flex justify-center items-center gap-2">
                    <i class="fas fa-at text-sm"></i> {{Auth::user()->username }}
                </p>

                <!-- Bergabung Sejak -->
                <p class="text-sm text-white/60 flex justify-center items-center gap-2">
                    <i class="fas fa-calendar-alt text-sm"></i>
                    Bergabung sejak: {{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('F Y') }}
                </p>
            </div>

            <!-- Tombol Edit Profile -->
            <div class="mb-16">
                <a href="{{ route('profile.edit') }}"
                   class="bg-white text-[#2f3e2a] font-medium text-lg py-3 px-10 rounded-full border border-white hover:bg-gray-100 transition">
                    Edit Profile
                </a>
            </div>

            <!-- Navigasi Dua Kolom -->
            <div class="border-t border-white/30 pt-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-white/90 text-base">
                <a href="{{ route('recipes.favorites') }}" class="hover:underline flex justify-center items-center gap-2">
                    <i class="fas fa-heart text-lg"></i> Resep Favorit
                </a>
                <a href="{{ route('saran.create') }}" class="hover:underline flex justify-center items-center gap-2">
                    <i class="fas fa-comment-dots text-lg"></i> Saran & Pengaduan
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
