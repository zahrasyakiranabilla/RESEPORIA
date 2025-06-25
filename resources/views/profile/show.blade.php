<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="relative bg-[#76916d] text-white w-full max-w-2xl p-10 rounded-3xl shadow-xl animate-slideUp hover:shadow-2xl transition-all duration-300">

            <!-- Tombol Back -->
            <a href="{{ route('home') }}"
               class="absolute left-4 top-4 md:left-6 md:top-6 text-white bg-black/20 hover:bg-black/40 p-3 rounded-full transition">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>

            <!-- Logo Profil -->
            <div class="flex justify-center mb-12">
                <div class="w-36 h-36 md:w-44 md:h-44 rounded-full bg-white overflow-hidden shadow-lg hover:rotate-6 transition-transform duration-300">
                    <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Informasi Profil -->
            <div class="text-center mb-14">
                <h2 class="text-5xl font-bold tracking-wide mb-3">{{ Auth::user()->name }}</h2>

                <p class="text-lg italic text-white/80 mb-2 flex justify-center items-center gap-2">
                    <i class="fas fa-at text-base"></i> {{ Auth::user()->username }}
                </p>

                <p class="text-sm text-white/60 flex justify-center items-center gap-2">
                    <i class="fas fa-calendar-alt text-sm"></i>
                    Bergabung sejak: {{ \Carbon\Carbon::parse(Auth::user()->created_at)->translatedFormat('F Y') }}
                </p>
            </div>

            <!-- Tombol Edit Profil -->
            <div class="text-center mb-16">
                <a href="{{ route('profile.edit') }}"
                   class="bg-white text-[#2f3e2a] font-semibold text-lg py-3 px-10 rounded-full border border-white hover:bg-gray-100 transition">
                    Edit Profil
                </a>
            </div>

            <!-- Navigasi -->
            <div class="border-t border-white/30 pt-8 grid grid-cols-1 md:grid-cols-2 gap-6 text-white/90 text-lg mb-14">
                <a href="{{ route('recipes.favorites') }}" class="hover:underline flex justify-center items-center gap-2">
                    <i class="fas fa-heart text-xl"></i> Resep Favorit
                </a>
                <a href="{{ route('saran.create') }}" class="hover:underline flex justify-center items-center gap-2">
                    <i class="fas fa-comment-dots text-xl"></i> Saran & Pengaduan
                </a>
            </div>

            <!-- Tombol Logout -->
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 text-red-600 font-semibold hover:text-red-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-layouts.app>
