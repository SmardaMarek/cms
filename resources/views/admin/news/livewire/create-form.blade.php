<form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-6">
    <!-- Flash message -->
    @if (session()->has('message'))
        <div class="text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Název</label>
        <input type="text" id="title" wire:model.defer="title" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Perex -->
    <div>
        <label for="perex" class="block text-sm font-medium text-gray-700">Úvod</label>
        <input type="text" id="perex" wire:model.defer="perex" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        @error('perex') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Content -->
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Obsah</label>
        <textarea id="content" wire:model.defer="content" rows="6" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
        @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Main image -->
    <div>
        <label for="main_image" class="block text-sm font-medium text-gray-700">Hlavní obrázek</label>
        <input type="file" id="main_image" wire:model="main_image"
               class="mt-1 block w-full text-gray-700">
        @error('main_image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Gallery images -->
    <div>
        <label for="gallery_images" class="block text-sm font-medium text-gray-700">Obrázky galerie</label>
        <input type="file" id="gallery_images" wire:model="gallery_images" multiple
               accept="image/*"
               class="mt-2 block w-full border-gray-300 rounded-md shadow-sm">
        @error('gallery_images.*') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Submit -->
    <div>
        <button type="submit"
                class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Uložit aktualitu
        </button>
    </div>
</form>
