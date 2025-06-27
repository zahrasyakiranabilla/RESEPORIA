<x-layouts.app>

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-[#76916d] text-white w-full max-w-md p-8 rounded-3xl shadow-xl animate-slideUp hover:shadow-2xl transition-all duration-300">

            <!-- Logo -->
            <div class="w-16 h-16 bg-white rounded-full mx-auto mb-3 overflow-hidden hover:rotate-12 transition-transform duration-300">
                <img src="{{ asset('images/logoreseporia.png') }}" alt="Logo Reseporia" class="w-full h-full object-contain">
            </div>

            <!-- Notifikasi Berhasil -->
           @if (session('success'))
<script>
    // Custom alert yang mirip SweetAlert
    const showAlert = () => {
        const alertDiv = document.createElement('div');
        alertDiv.innerHTML = `
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="customAlert">
                <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-sm w-full mx-4 text-center transform scale-95 opacity-0 transition-all duration-300">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-green-500 text-2xl"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-2">Berhasil!</h2>
                    <p class="text-gray-600 mb-6">{{ session('success') }}</p>
                    <button onclick="closeCustomAlert()" class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-all duration-200 hover:scale-105">
                        OK
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(alertDiv);

        // Show animation
        setTimeout(() => {
            const modal = document.querySelector('#customAlert > div');
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    const closeCustomAlert = () => {
        const alert = document.getElementById('customAlert');
        const modal = alert.querySelector('div');
        modal.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            alert.remove();
        }, 300);
    };

    // Show alert when page loads
    showAlert();
</script>
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
