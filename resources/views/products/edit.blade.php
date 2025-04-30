@extends('layouts.app')

@section('title', 'Hirdetés szerkesztése')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6">Hirdetés szerkesztése</h2>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Termék neve</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror"
                   id="title" type="text" name="title" value="{{ old('title', $product->title) }}" required>
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Leírás</label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                      id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Ár (Ft)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror"
                   id="price" type="number" name="price" value="{{ old('price', $product->price) }}" required min="0">
            @error('price')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="condition">Állapot</label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('condition') border-red-500 @enderror"
                    id="condition" name="condition" required>
                <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>Új</option>
                <option value="like_new" {{ $product->condition == 'like_new' ? 'selected' : '' }}>Újszerű</option>
                <option value="good" {{ $product->condition == 'good' ? 'selected' : '' }}>Jó</option>
                <option value="fair" {{ $product->condition == 'fair' ? 'selected' : '' }}>Megfelelő</option>
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
                    @if(is_null($category->parent_id))
                        <option value="{{ $category->id }}" {{ $product->category->parent_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                   id="email" type="email" name="email" value="{{ old('email', $product->email) }}" required>
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Telefonszám (opcionális)</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror"
                   id="phone" type="text" name="phone" value="{{ old('phone', $product->phone) }}">
            @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jelenlegi képek</label>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @forelse($product->images as $image)
                <div class="relative group">
                    <img src="{{ asset('public/storage/' . $image->image) }}" alt="Termék kép" class="w-full h-32 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100">
                        <button type="button" 
                                onclick="document.getElementById('main_image').value = '{{ $image->id }}'; setMainImage(this);"
                                class="bg-blue-500 text-white px-2 py-1 rounded text-xs mb-1 {{ $product->image == $image->image ? 'bg-green-500' : '' }}">
                            {{ $product->image == $image->image ? 'Fő kép' : 'Beállítás fő képként' }}
                        </button>
                        <button type="button" 
                                onclick="toggleImageDelete({{ $image->id }}, this)"
                                class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                            Törlés
                        </button>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 col-span-full">Nincsenek képek feltöltve.</p>
                @endforelse
            </div>
            <input type="hidden" name="main_image" id="main_image" value="">
            <div id="delete_images_container"></div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="new_images">Új képek feltöltése (opcionális)</label>
            <div class="flex items-center justify-center w-full">
                <label for="new_images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Kattints a feltöltéshez</span> vagy húzd ide a képeket</p>
                        <p class="text-xs text-gray-500">PNG, JPG vagy JPEG (MAX. 2MB)</p>
                    </div>
                    <input id="new_images" name="new_images[]" type="file" class="hidden" multiple accept="image/*" />
                </label>
            </div>
            <div id="new-image-preview-container" class="mt-4 grid grid-cols-2 md:grid-cols-5 gap-4"></div>
            @error('new_images')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            @error('new_images.*')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <button class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">Mentés</button>
    </form>
</div>

<script>
    function toggleImageDelete(imageId, button) {
        const container = document.getElementById('delete_images_container');
        const existingInput = document.getElementById(`delete_image_${imageId}`);
        
        if (existingInput) {
            container.removeChild(existingInput);
            button.textContent = 'Törlés';
            button.classList.remove('bg-gray-500');
            button.classList.add('bg-red-500');
            button.parentElement.parentElement.classList.remove('opacity-50');
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = imageId;
            input.id = `delete_image_${imageId}`;
            container.appendChild(input);
            
            button.textContent = 'Visszavonás';
            button.classList.remove('bg-red-500');
            button.classList.add('bg-gray-500');
            button.parentElement.parentElement.classList.add('opacity-50');
        }
    }
    function setMainImage(button) {
        document.querySelectorAll('[onclick^="document.getElementById(\'main_image\')"]').forEach(btn => {
            btn.textContent = 'Beállítás fő képként';
            btn.classList.remove('bg-green-500');
            btn.classList.add('bg-blue-500');
        });
        
        button.textContent = 'Fő kép';
        button.classList.remove('bg-blue-500');
        button.classList.add('bg-green-500');
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const newImagesInput = document.getElementById('new_images');
        const newImagePreviewContainer = document.getElementById('new-image-preview-container');
        
        newImagesInput.addEventListener('change', function() {
            newImagePreviewContainer.innerHTML = '';
            
            const maxImages = 5 - {{ $product->images->count() }};
            if (this.files.length > maxImages) {
                alert(`Maximum ${maxImages} új képet tölthetsz fel!`);
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
                        newFileInput.id = 'new_images';
                        newFileInput.name = 'new_images[]';
                        newFileInput.className = 'hidden';
                        newFileInput.multiple = true;
                        newFileInput.accept = 'image/*';
                        
                        newFileInput.addEventListener('change', newImagesInput.onchange);
                        
                        newImagesInput.parentNode.replaceChild(newFileInput, newImagesInput);
                        newImagesInput = newFileInput;
                    });
                    previewDiv.appendChild(removeBtn);
                    
                    newImagePreviewContainer.appendChild(previewDiv);
                };
                
                reader.readAsDataURL(file);
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const parentCategorySelect = document.getElementById('parent_category');
        const subCategorySelect = document.getElementById('category_id');
        
        function loadSubcategories(parentId, selectedCategoryId = null) {
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
                            
                            if (selectedCategoryId && category.id == selectedCategoryId) {
                                option.selected = true;
                            }
                            
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
        }
        
        parentCategorySelect.addEventListener('change', function () {
            loadSubcategories(this.value);
        });
        
        const currentCategoryId = {{ $product->category_id }};
        const currentParentId = {{ $product->category->parent_id ?? 'null' }};
        
        if (currentParentId) {
            parentCategorySelect.value = currentParentId;
            
            loadSubcategories(currentParentId, currentCategoryId);
        }
    });
</script>
@endsection
