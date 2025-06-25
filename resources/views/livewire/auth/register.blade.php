@php
    $iconRight = 'absolute right-3 top-1/2 -translate-y-1/2 text-white text-lg';
    $inputPaddingRight = 'pr-10';
@endphp

<div>
      <a href="{{ route('login') }}"
       class="absolute top-8 left-8 text-white bg-black/20 rounded-full p-3 hover:bg-black/40 transition-colors duration-300"
       aria-label="Kembali ke halaman utama">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="bg-[#73946B] rounded-3xl shadow-xl w-full max-w-md px-10 py-12 relative">
            <div class="text-center mb-10">
                <img src="{{ asset('images/logoreseporia.png') }}" class="mx-auto h-16 w-16 rounded-full" alt="Logo">
                <h2 class="text-white text-3xl font-bold mt-4">Create Account</h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Full Name --}}
                <div class="relative mb-4">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        required
                        value="{{ old('name') }}"
                        class="peer w-full {{ $inputPaddingRight }} px-4 pt-3 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                        placeholder="Full Name"
                    />
                    <label for="name" class="label-floating">Full Name</label>
                    <i class="fa fa-user {{ $iconRight }}"></i>
                    @error('name')
                    <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="relative mb-4">
                    <input
                        type="text"
                        name="username"
                        id="username"
                        required
                        value="{{ old('username') }}"
                        class="peer w-full {{ $inputPaddingRight }} px-4 pt-3 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                        placeholder="Username"
                    />
                    <label for="username" class="label-floating">Username</label>
                    <i class="fa fa-user-circle {{ $iconRight }}"></i>
                    @error('username')
                    <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="relative mb-4">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        value="{{ old('email') }}"
                        class="peer w-full {{ $inputPaddingRight }} px-4 pt-3 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                        placeholder="Email"
                    />
                    <label for="email" class="label-floating">Email</label>
                    <i class="fa fa-envelope {{ $iconRight }}"></i>
                    @error('email')
                    <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="relative mb-4">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="peer w-full {{ $inputPaddingRight }} px-4 pt-3 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                        placeholder="Password"
                    />
                    <label for="password" class="label-floating">Password</label>
                    <button
                        type="button"
                        class="{{ $iconRight }} focus:outline-none"
                        onclick="togglePassword('password', this)">
                        <i class="fa fa-eye-slash"></i>
                    </button>
                    @error('password')
                    <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="relative mb-4">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        class="peer w-full {{ $inputPaddingRight }} px-4 pt-3 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                        placeholder="Confirm Password"
                    />
                    <label for="password_confirmation" class="label-floating">Confirm Password</label>
                    <button
                        type="button"
                        class="{{ $iconRight }} focus:outline-none"
                        onclick="togglePassword('password_confirmation', this)">
                        <i class="fa fa-eye-slash"></i>
                    </button>
                </div>

                {{-- Sign Up Button --}}
                <button
                    type="submit"
                    class="w-full bg-white text-[#2f3e2a] font-semibold py-3 rounded-full hover:bg-gray-200 transition duration-300">
                    Sign Up
                </button>

                {{-- Login Link --}}
                <p class="text-center text-sm text-white/80 mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-yellow-200 font-medium hover:underline">Log In here!</a>
                </p>
            </form>
        </div>
    </div>

    <style>
    .label-floating {
        position: absolute;
        left: 0.75rem;
        top: 0.875rem;
        background-color: #73946B;
        padding: 0 0.25rem;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .peer:focus ~ .label-floating,
    .peer:not(:placeholder-shown) ~ .label-floating {
        top: -0.6rem;
        font-size: 0.75rem;
        color: white;
    }
    </style>

    <script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
    </script>
</div>
