<x-layouts.app>
    <x-slot name="title">Saran&Masukan - Reseporia</x-slot>

    <div class="bg-[#f3f1de] p-6 rounded-xl shadow-md px-8">
        <h1 class="text-2xl font-bold text-center mb-4">Saran & Masukan</h1>
        <p class="text-justify max-w-full mx-auto mb-6">
            Reseporia senantiasa berinovasi untuk menyajikan resep terbaik bagi Anda. Kami menyadari pentingnya kontribusi Anda,
            oleh karena itu, setiap ide, kritik, dan saran akan kami terima dengan senang hati demi kemajuan Reseporia.
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mt-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('saran.store') }}" method="POST" class="mt-6">
            @csrf
            <textarea name="message" rows="6" placeholder="Tulis saran Anda di sini..."
                class="w-full p-4 rounded-xl bg-[#78976D] text-white placeholder-white focus:outline-none"></textarea>

            @error('message')
                <div class="text-red-600 mt-2">{{ $message }}</div>
            @enderror

            <div class="text-center mt-4">
                <button type="submit"
                    class="bg-[#4b6d52] hover:bg-[#3d5945] text-white px-6 py-2 rounded-full font-semibold transition">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
