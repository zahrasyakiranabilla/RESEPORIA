<div class="min-h-screen flex items-center justify-center bg-[#e6e2c7] px-4 py-12 relative">
    <a href="{{ route('home') }}"
       class="absolute top-8 left-8 text-white bg-black/20 rounded-full p-3 hover:bg-black/40 transition-colors duration-300"
       aria-label="Kembali ke halaman utama">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>



    <div class="bg-[#73946B] rounded-3xl shadow-xl w-full max-w-md px-10 py-12">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logoreseporia.png') }}" class="mx-auto h-20 w-20 rounded-full" alt="Logo">
            <h2 class="text-white text-3xl font-bold mt-4">Log In</h2>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-8">
            @csrf

            {{-- Email --}}
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    class="peer w-full px-4 pt-5 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                    placeholder="Email"
                />
                <label
                    for="email"
                    class="absolute left-3 -top-2.5 bg-[#73946B] px-1 text-sm text-white transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-white/70 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-white"
                >
                    Email
                </label>
            </div>

            {{-- Password --}}
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="peer w-full px-4 pt-5 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                    placeholder="Password"
                />
                <label
                    for="password"
                    class="absolute left-3 -top-2.5 bg-[#73946B] px-1 text-sm text-white transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-base peer-placeholder-shown:text-white/70 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-white"
                >
                    Password
                </label>
            </div>

            {{-- Remember & Forgot --}}
            <div class="flex items-center justify-between text-white/90 text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-white">
                    Remember Me
                </label>
                @if (Route::has('password.request'))
                    <a class="hover:underline text-yellow-200 font-medium" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>

            {{-- Tombol --}}
            <button
                type="submit"
                class="w-full bg-white text-[#2f3e2a] font-semibold py-3 rounded-full hover:bg-gray-200 transition duration-300">
                Log In
            </button>

            {{-- Register --}}
            <p class="text-center text-sm text-white/80 mt-4">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-yellow-200 font-medium hover:underline">Sign up here!</a>
            </p>
        </form>
    </div>
</div>
