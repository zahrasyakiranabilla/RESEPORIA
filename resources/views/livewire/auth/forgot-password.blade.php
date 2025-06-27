{{-- @php
    $iconRight = 'absolute right-3 top-1/2 -translate-y-1/2 text-white text-lg';
@endphp

<div class="min-h-screen flex items-center justify-center bg-[#e6e2c7] px-4 py-12">
    <div class="bg-[#73946B] rounded-3xl shadow-xl w-full max-w-md px-10 py-12 relative">
        <div class="text-center mb-10">
            <img src="{{ asset('images/logoreseporia.png') }}" class="mx-auto h-20 w-20 rounded-full" alt="Logo">
            <h2 class="text-white text-3xl font-bold mt-4">Forgot Password</h2>
            <p class="text-white text-sm mt-2">Enter your email to receive a reset link</p>
        </div>

        @if (session('status'))
            <div class="mb-4 text-sm text-white text-center font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="sendPasswordResetLink" class="space-y-6">
            {{-- Email --}}
            <div class="relative">
                <input
                    type="email"
                    name="email"
                    id="email"
                    wire:model.defer="email"
                    required
                    placeholder="Email"
                    class="peer w-full pr-10 px-4 pt-5 pb-2 bg-transparent border border-white text-white rounded-md placeholder-transparent focus:outline-none focus:ring-2 focus:ring-white focus:border-white"
                />
                <label for="email" class="label-floating">Email</label>
                <i class="fa fa-envelope {{ $iconRight }}"></i>
                @error('email')
                    <p class="text-sm text-red-300 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full bg-white text-[#2f3e2a] font-semibold py-3 rounded-full hover:bg-gray-200 transition duration-300">
                Email password reset link
            </button>

            {{-- Back to login --}}
            <p class="text-center text-sm text-white/80 mt-4">
                Remember your password?
                <a href="{{ route('login') }}" class="text-yellow-200 font-medium hover:underline">Log in</a>
            </p>
        </form>
    </div>
    <style>
    .label-floating {
        position: absolute;
        left: 0.75rem;
        top: 0.75rem;
        background-color: #73946B;
        padding: 0 0.25rem;
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .peer:focus ~ .label-floating,
    .peer:not(:placeholder-shown) ~ .label-floating {
        top: 0;
        font-size: 0.875rem;
        color: #fff;
    }
</style>
</div>

 --}}
