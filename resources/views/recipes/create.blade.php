<x-layouts.app>

    @section('title', 'Upload Resep')
    <div class="bg-[#9EBC8A] px-6 py-4 flex items-center justify-center relative">
        <div class="container mx-auto px-4 flex items-center">
            {{-- Tombol kembali --}}
            <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800">
                <a href="javascript:history.back()" class="absolute left-6 p-2 rounded-full hover:bg-amber-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-left">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </a>
            <h1 class="text-xl font-semibold text-gray-800 flex-grow text-center mr-6">Upload Resep</h1>
        </div>
    </div>

    {{-- Konten Utama Formulir --}}
        <div class="max-w-3xl mx-auto space-y-4">

            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Bagian Upload Gambar--}}
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <label for="image" class="block text-gray-700 text-sm font-semibold mb-2 sr-only">Upload
                        Gambar</label>
                    <div
                        class="flex items-center justify-center border-2 border-dashed border-gray-300 rounded-md py-12 px-6 bg-white cursor-pointer hover:border-[#9bbd84] transition-colors">
                        <label for="image" class="flex flex-col items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucuce-image text-gray-400 mb-2">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                                <circle cx="9" cy="9" r="2" />
                                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21" />
                            </svg>
                            <span class="text-gray-600 text-sm font-medium" id="file-name">Unggah gambar (JPG/JPEG/PNG,
                                maks 5MB)</span>
                            <input type="file" id="image" name="image" class="hidden"
                                accept="image/jpeg, image/png, image/jpg" onchange="updateFileName(this)">
                        </label>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-2 text-left">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bagian Informasi Resep --}}
                <div class="bg-[#9EBC8A] p-6 rounded-lg shadow-sm space-y-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Resep</h2>

                    <div>
                        <label for="title" class="block text-gray-700 text-sm font-semibold mb-2">Nama Resep</label>
                        <input type="text" id="title" name="title"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800 @error('title') border-red-500 @enderror"
                            placeholder="Masukkan nama resep Anda" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-gray-700 text-sm font-semibold mb-2">Kategori
                            Resep</label>
                        <select id="category" name="category"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800 @error('category') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $categoryName)
                                <option value="{{ $categoryName }}" {{ old('category') == $categoryName ? 'selected' : '' }}>
                                    {{ $categoryName }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description"
                            class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800 @error('description') border-red-500 @enderror"
                            placeholder="Deskripsikan resep Anda secara detail"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cooking_time" class="block text-gray-700 text-sm font-semibold mb-2">Durasi Memasak
                            (menit)</label>
                        <input type="number" id="cooking_time" name="cooking_time"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800 @error('cooking_time') border-red-500 @enderror"
                            placeholder="Contoh: 30" value="{{ old('cooking_time') }}" min="1" required>
                        @error('cooking_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Bagian Bahan-bahan --}}
                <div class="bg-[#9EBC8A] p-6 rounded-lg shadow-sm space-y-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Bahan-Bahan</h2>
                    <div id="ingredients-container" class="space-y-3">
                        @if (old('ingredients'))
                            @foreach (old('ingredients') as $index => $ingredient)
                                <div class="flex space-x-2 items-center input-group">
                                    <input type="text" name="ingredients[{{ $index }}]" placeholder="Contoh: 200g Tepung Terigu"
                                        value="{{ $ingredient ?? '' }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                                    <button type="button"
                                        class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                                        onclick="addIngredient()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-plus">
                                            <path d="M12 5v14" />
                                            <path d="M5 12h14" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                                        onclick="removeInputGroup(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-trash-2">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            <line x1="10" x2="10" y1="11" y2="17" />
                                            <line x1="14" x2="14" y1="11" y2="17" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex space-x-2 items-center input-group">
                                <input type="text" name="ingredients[0]" placeholder="Contoh: 200g Tepung Terigu"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                                <button type="button"
                                    class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                                    onclick="addIngredient()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                                    onclick="removeInputGroup(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-trash-2">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    @error('ingredients')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bagian Langkah-langkah Memasak --}}
                <div class="bg-[#9EBC8A] p-6 rounded-lg shadow-sm space-y-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Langkah-Langkah</h2>
                    <div id="instructions-container" class="space-y-3">
                        @if (old('instructions_list'))
                            @foreach (old('instructions_list') as $index => $instruction)
                                <div class="flex space-x-2 items-center input-group">
                                    <input type="text" name="instructions_list[{{ $index }}]"
                                        placeholder="Tuliskan langkah-langkah memasak" value="{{ $instruction ?? '' }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                                    <button type="button"
                                        class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                                        onclick="addInstruction()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-plus">
                                            <path d="M12 5v14" />
                                            <path d="M5 12h14" />
                                        </svg>
                                    </button>
                                    <button type="button"
                                        class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                                        onclick="removeInputGroup(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="lucide lucide-trash-2">
                                            <path d="M3 6h18" />
                                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            <line x1="10" x2="10" y1="11" y2="17" />
                                            <line x1="14" x2="14" y1="11" y2="17" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex space-x-2 items-center input-group">
                                <input type="text" name="instructions_list[0]"
                                    placeholder="Tuliskan langkah-langkah memasak"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                                <button type="button"
                                    class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                                    onclick="addInstruction()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-plus">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                </button>
                                <button type="button"
                                    class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                                    onclick="removeInputGroup(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-trash-2">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                        <line x1="10" x2="10" y1="11" y2="17" />
                                        <line x1="14" x2="14" y1="11" y2="17" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    @error('instructions_list')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @error('instructions_list.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bagian Video Tutorial --}}
                <div class="bg-[#9EBC8A] p-6 rounded-lg shadow-sm space-y-4">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Video Tutorial</h2>
                    <div>
                        <label for="video_url" class="block text-gray-700 text-sm font-semibold mb-2 sr-only">Link
                            Video YouTube</label>
                        <input type="url" id="video_url" name="video_url"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800 @error('video_url') border-red-500 @enderror"
                            placeholder="Contoh: https://www.youtube.com/watch?v=video_id"
                            value="{{ old('video_url') }}">
                        @error('video_url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi (Simpan ke Draft dan Upload Resep) --}}
                <div class="flex justify-center space-x-4 mt-8">
                    <button type="submit" name="action" value="draft"
                        class="bg-gray-400 text-white font-bold py-3 px-6 rounded-full hover:bg-gray-500 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Simpan ke Draft
                    </button>
                    <button type="submit" name="action" value="publish"
                        class="bg-[#73946B] text-white font-bold py-3 px-6 rounded-full hover:bg-[#5f7e59] transition-colors focus:outline-none focus:ring-2 focus:ring-[#9bbd84]">
                        Upload Resep
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script JavaScript untuk update nama file dan manajemen input dinamis --}}
    <script>
        let ingredientIndex = {{ old('ingredients') ? count(old('ingredients')) : 1 }};
        let instructionIndex = {{ old('instructions_list') ? count(old('instructions_list')) : 1 }};

        function updateFileName(input) {
            const fileNameSpan = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameSpan.textContent = input.files[0].name;
            } else {
                fileNameSpan.textContent = 'Unggah gambar (JPG/JPEG/PNG, maks 5MB)';
            }
        }

        function addIngredient() {
            const container = document.getElementById('ingredients-container');
            const newDiv = document.createElement('div');
            newDiv.classList.add('flex', 'space-x-2', 'items-center', 'input-group');
            newDiv.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}]" placeholder="Contoh: 200g Tepung Terigu"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                <button type="button" class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn" onclick="addIngredient()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                </button>
                <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn" onclick="removeInputGroup(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
            `;
            container.appendChild(newDiv);
            ingredientIndex++;
            updateAddDeleteButtons('ingredients-container');
        }

        function addInstruction() {
            const container = document.getElementById('instructions-container');
            const newDiv = document.createElement('div');
            newDiv.classList.add('flex', 'space-x-2', 'items-center', 'input-group');
            newDiv.innerHTML = `
                <input type="text" name="instructions_list[${instructionIndex}]" placeholder="Tuliskan langkah-langkah memasak"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                <button type="button" class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn" onclick="addInstruction()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                </button>
                <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn" onclick="removeInputGroup(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                </button>
            `;
            container.appendChild(newDiv);
            instructionIndex++;
            updateAddDeleteButtons('instructions-container');
        }

        function removeInputGroup(button) {
            const inputGroup = button.closest('.input-group');
            if (inputGroup) {
                const container = inputGroup.parentNode;
                if (container.children.length > 1) {
                    inputGroup.remove();
                    updateAddDeleteButtons(container.id);
                    Array.from(container.children).forEach((el, idx) => {
                        if (container.id === 'ingredients-container') {
                            el.querySelector('[name^="ingredients"]').name = `ingredients[${idx}]`;
                        } else if (container.id === 'instructions-container') {
                            el.querySelector('[name^="instructions_list"]').name = `instructions_list[${idx}]`;
                        }
                    });
                    if (container.id === 'ingredients-container') {
                        ingredientIndex = container.children.length;
                    } else if (container.id === 'instructions-container') {
                        instructionIndex = container.children.length;
                    }
                } else {
                    alert('Minimal harus ada satu bahan dan satu langkah.');
                }
            }
        }

        function updateAddDeleteButtons(containerId) {
            const container = document.getElementById(containerId);
            const inputGroups = container.querySelectorAll('.input-group');

            container.querySelectorAll('.add-btn').forEach(btn => btn.style.display = 'none');

            if (inputGroups.length > 0) {
                const lastGroup = inputGroups[inputGroups.length - 1];
                lastGroup.querySelector('.add-btn').style.display = 'block';
            }

            inputGroups.forEach(group => {
                const deleteButton = group.querySelector('.delete-btn');
                if (inputGroups.length === 1) {
                    deleteButton.style.display = 'none';
                } else {
                    deleteButton.style.display = 'block';
                }
            });

            if (inputGroups.length === 0) {
                if (containerId === 'ingredients-container') {
                    const newDiv = document.createElement('div');
                    newDiv.className = 'flex space-x-2 items-center input-group';
                    newDiv.innerHTML = `
                        <input type="text" name="ingredients[0]" placeholder="Contoh: 200g Tepung Terigu"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                        <button type="button"
                            class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                            onclick="addIngredient()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                <path d="M12 5v14" />
                                <path d="M5 12h14" />
                            </svg>
                        </button>
                        <button type="button"
                            class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                            onclick="removeInputGroup(this)" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                        </button>
                    `;
                    container.appendChild(newDiv);
                    ingredientIndex = 1;
                } else if (containerId === 'instructions-container') {
                    const newDiv = document.createElement('div');
                    newDiv.className = 'flex space-x-2 items-center input-group';
                    newDiv.innerHTML = `
                        <input type="text" name="instructions_list[0]" placeholder="Tuliskan langkah-langkah memasak"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                        <button type="button"
                            class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn"
                            onclick="addInstruction()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                <path d="M12 5v14" />
                                <path d="M5 12h14" />
                            </svg>
                        </button>
                        <button type="button"
                            class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn"
                            onclick="removeInputGroup(this)" style="display:none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                        </button>
                    `;
                    container.appendChild(newDiv);
                    instructionIndex = 1;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const oldIngredients = @json(old('ingredients', []));
            const ingredientsContainer = document.getElementById('ingredients-container');
            if (Object.keys(oldIngredients).length > 0) {
                ingredientsContainer.innerHTML = '';
                Object.values(oldIngredients).forEach((ing, idx) => {
                    const newDiv = document.createElement('div');
                    newDiv.classList.add('flex', 'space-x-2', 'items-center', 'input-group');
                    newDiv.innerHTML = `
                        <input type="text" name="ingredients[${idx}]" placeholder="Contoh: 200g Tepung Terigu" value="${ing || ''}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                        <button type="button" class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn" onclick="addIngredient()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                        </button>
                        <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn" onclick="removeInputGroup(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </button>
                    `;
                    ingredientsContainer.appendChild(newDiv);
                });
                ingredientIndex = Object.keys(oldIngredients).length;
            }

            const oldInstructions = @json(old('instructions_list', []));
            const instructionsContainer = document.getElementById('instructions-container');
            if (Object.keys(oldInstructions).length > 0) {
                instructionsContainer.innerHTML = '';
                Object.values(oldInstructions).forEach((inst, idx) => {
                    const newDiv = document.createElement('div');
                    newDiv.classList.add('flex', 'space-x-2', 'items-center', 'input-group');
                    newDiv.innerHTML = `
                        <input type="text" name="instructions_list[${idx}]" placeholder="Tuliskan langkah-langkah memasak" value="${inst || ''}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#9bbd84] focus:border-[#9bbd84] bg-white text-gray-800">
                        <button type="button" class="bg-[#73946B] text-white p-2 rounded-full hover:bg-[#5f7e59] transition-colors add-btn" onclick="addInstruction()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                        </button>
                        <button type="button" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors delete-btn" onclick="removeInputGroup(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                        </button>
                    `;
                    instructionsContainer.appendChild(newDiv);
                });
                instructionIndex = Object.keys(oldInstructions).length;
            }

            // Panggil updateAddDeleteButtons sekali lagi setelah memuat old data
            updateAddDeleteButtons('ingredients-container');
            updateAddDeleteButtons('instructions-container');
        });
    </script>
</x-layouts.app>
