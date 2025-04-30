@extends('layouts.app')

@section('title', 'Termék feltöltése')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6">Új termék feltöltése</h2>

    <div id="formContainer">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Termék neve</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                       id="title" type="text" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Leírás</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                          id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Ár (Ft)</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror"
                       id="price" type="number" name="price" value="{{ old('price') }}" required min="0">
                @error('price')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">Állapot</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('condition') border-red-500 @enderror"
                        id="condition" name="condition" required>
                    <option value="">Válassz állapotot</option>
                    <option value="new">Új</option>
                    <option value="like_new">Újszerű</option>
                    <option value="good">Jó</option>
                    <option value="fair">Megfelelő</option>
                </select>
                @error('condition')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="parent_category">Főkategória</label>
                <select id="parent_category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Válassz főkategóriát</option>
                    @foreach($categories as $category)
                        @if(is_null($category->parent_id)) <!-- Csak a főkategóriák -->
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">Alkategória</label>
                <select id="category_id" name="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Először válassz főkategóriát</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail cím</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                       id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Telefonszám (opcionális)</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror"
                       id="phone" type="text" name="phone" value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="images">Képek (max. 5 db)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Kattints a feltöltéshez</span> vagy húzd ide a képeket</p>
                            <p class="text-xs text-gray-500">PNG, JPG vagy JPEG (MAX. 2MB)</p>
                        </div>
                        <input id="images" name="images[]" type="file" class="hidden" multiple accept="image/*" />
                    </label>
                </div>
                <div id="image-preview-container" class="mt-4 grid grid-cols-2 md:grid-cols-5 gap-4"></div>
                @error('images')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <button id="showPreviewButton" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Előnézet
                </button>
                <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Termék feltöltése
                </button>
            </div>
        </form>
    </div>

    <div id="previewContainer" class="hidden mt-8">
        <h3 class="text-xl font-semibold mb-4">Előnézet</h3>
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="relative">
                <div id="previewImagesContainer" class="w-full h-64 relative">
                </div>
                <button id="prevImageBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-r-lg hover:bg-opacity-70 focus:outline-none hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="nextImageBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-l-lg hover:bg-opacity-70 focus:outline-none hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div id="imageCounter" class="absolute bottom-2 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm hidden">
                    <span id="currentImageIndex">1</span>/<span id="totalImages">1</span>
                </div>
            </div>
            <div class="p-6">
                <h2 id="previewTitle" class="text-2xl font-bold text-gray-800"></h2>
                <p id="previewPrice" class="text-purple-600 font-bold mt-2"></p>
                <p id="previewDescription" class="text-gray-600 text-sm mt-2"></p>
                <p id="previewEmail" class="text-gray-600 text-sm mt-2"></p>
                <p id="previewPhone" class="text-gray-600 text-sm mt-2"></p>
            </div>
        </div>
        <button id="hidePreviewButton" type="button" class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
            Előnézet elrejtése
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showPreviewButton = document.getElementById('showPreviewButton');
        const hidePreviewButton = document.getElementById('hidePreviewButton');
        const formContainer = document.getElementById('formContainer');
        const previewContainer = document.getElementById('previewContainer');

        const titleInput = document.getElementById('title');
        const descriptionInput = document.getElementById('description');
        const priceInput = document.getElementById('price');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const imagesInput = document.getElementById('images');
        const imagePreviewContainer = document.getElementById('image-preview-container');
        
        const previewTitle = document.getElementById('previewTitle');
        const previewDescription = document.getElementById('previewDescription');
        const previewPrice = document.getElementById('previewPrice');
        const previewEmail = document.getElementById('previewEmail');
        const previewPhone = document.getElementById('previewPhone');
        const previewImagesContainer = document.getElementById('previewImagesContainer');
        
        const prevImageBtn = document.getElementById('prevImageBtn');
        const nextImageBtn = document.getElementById('nextImageBtn');
        const imageCounter = document.getElementById('imageCounter');
        const currentImageIndex = document.getElementById('currentImageIndex');
        const totalImages = document.getElementById('totalImages');
        
        let previewImages = [];
        let currentIndex = 0;
        
        imagesInput.addEventListener('change', function() {
            imagePreviewContainer.innerHTML = '';
            previewImages = [];
            
            if (this.files.length > 5) {
                alert('Maximum 5 képet tölthetsz fel!');
                this.value = '';
                return;
            }
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'relative';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-32 object-cover rounded-lg';
                    previewDiv.appendChild(img);
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 focus:outline-none';
                    removeBtn.innerHTML = '×';
                    removeBtn.dataset.index = i;
                    removeBtn.addEventListener('click', function() {
                        this.parentNode.remove();
                        
                        const newFileInput = document.createElement('input');
                        newFileInput.type = 'file';
                        newFileInput.id = 'images';
                        newFileInput.name = 'images[]';
                        newFileInput.className = 'hidden';
                        newFileInput.multiple = true;
                        newFileInput.accept = 'image/*';
                        
                        newFileInput.addEventListener('change', imagesInput.onchange);
                        
                        imagesInput.parentNode.replaceChild(newFileInput, imagesInput);
                        imagesInput = newFileInput;
                        
                        previewImages.splice(parseInt(this.dataset.index), 1);
                    });
                    previewDiv.appendChild(removeBtn);
                    
                    imagePreviewContainer.appendChild(previewDiv);
                    
                    previewImages.push(e.target.result);
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        showPreviewButton.addEventListener('click', function() {
            previewTitle.textContent = titleInput.value || 'Termék neve';
            previewDescription.textContent = descriptionInput.value || 'Termék leírása';
            previewPrice.textContent = priceInput.value ? `${priceInput.value} Ft` : 'Ár';
            previewEmail.textContent = `E-mail: ${emailInput.value || 'Nincs megadva'}`;
            previewPhone.textContent = phoneInput.value ? `Telefonszám: ${phoneInput.value}` : 'Telefonszám: Nincs megadva';

            previewImagesContainer.innerHTML = '';
            currentIndex = 0;
            
            if (previewImages.length > 0) {
                const img = document.createElement('img');
                img.src = previewImages[0];
                img.className = 'w-full h-64 object-contain';
                previewImagesContainer.appendChild(img);
                
                currentImageIndex.textContent = '1';
                totalImages.textContent = previewImages.length.toString();
                
                if (previewImages.length > 1) {
                    prevImageBtn.classList.remove('hidden');
                    nextImageBtn.classList.remove('hidden');
                    imageCounter.classList.remove('hidden');
                } else {
                    prevImageBtn.classList.add('hidden');
                    nextImageBtn.classList.add('hidden');
                    imageCounter.classList.add('hidden');
                }
            } else {
                const placeholder = document.createElement('div');
                placeholder.className = 'w-full h-64 bg-gray-200 flex items-center justify-center';
                placeholder.innerHTML = '<span class="text-gray-500">Nincs kép feltöltve</span>';
                previewImagesContainer.appendChild(placeholder);
                
                prevImageBtn.classList.add('hidden');
                nextImageBtn.classList.add('hidden');
                imageCounter.classList.add('hidden');
            }

            formContainer.classList.add('hidden');
            previewContainer.classList.remove('hidden');
        });

        hidePreviewButton.addEventListener('click', function() {
            formContainer.classList.remove('hidden');
            previewContainer.classList.add('hidden');
        });
        
        prevImageBtn.addEventListener('click', function() {
            if (previewImages.length <= 1) return;
            
            currentIndex = (currentIndex - 1 + previewImages.length) % previewImages.length;
            updatePreviewImage();
        });
        
        nextImageBtn.addEventListener('click', function() {
            if (previewImages.length <= 1) return;
            
            currentIndex = (currentIndex + 1) % previewImages.length;
            updatePreviewImage();
        });
        
        function updatePreviewImage() {
            previewImagesContainer.innerHTML = '';
            
            const img = document.createElement('img');
            img.src = previewImages[currentIndex];
            img.className = 'w-full h-64 object-contain';
            previewImagesContainer.appendChild(img);
            
            currentImageIndex.textContent = (currentIndex + 1).toString();
        }
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const parentCategorySelect = document.getElementById('parent_category');
        const subCategorySelect = document.getElementById('category_id');

        parentCategorySelect.addEventListener('change', function () {
            const parentId = this.value;

            subCategorySelect.innerHTML = '<option value="">Töltés...</option>';

            if (parentId) {
                fetch(`/categories/${parentId}/children`)
                    .then(response => response.json())
                    .then(data => {
                        subCategorySelect.innerHTML = '<option value="">Válassz alkategóriát</option>';
                        data.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            subCategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Hiba az alkategóriák betöltésekor:', error);
                        subCategorySelect.innerHTML = '<option value="">Hiba történt</option>';
                    });
            } else {
                subCategorySelect.innerHTML = '<option value="">Először válassz főkategóriát</option>';
            }
        });
    });
</script>
@endsection
