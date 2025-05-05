<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktuality') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <form method="POST" action="{{ route('news.update', $new->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Název</label>
                        <input type="text" name="title" id="title" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            value="{{ $new->title }}">
                    </div>
                    <!-- Perex -->
                    <div>
                        <label for="perex" class="block text-sm font-medium text-gray-700">Úvod</label>
                        <input type="text" name="perex" id="perex" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            value="{{ $new->perex }}">
                    </div>
            
                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Obsah</label>
                        <textarea name="content" id="content" rows="6" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content', $new->content) }}</textarea>
                    </div>
                    
            
                    <!-- Actual image -->
                    @if ($new->main_image)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Aktuální obrázek:</p>
                            <img src="{{ asset('storage/' . $new->main_image) }}" alt="Main image" class="w-48 h-auto rounded shadow">
                        </div>
                    @endif

                    <!-- New image -->
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700">Změnit obrázek</label>
                        <input type="file" name="main_image" id="main_image"
                            class="mt-1 block w-full text-gray-700">
                    </div>

                    <!-- Images -->
                    <div>
                        <label for="gallery_images" class="block text-sm font-medium text-gray-700">Přidat obrázky do galerie</label>
                        <input 
                            type="file" 
                            name="gallery_images[]" 
                            id="gallery_images"
                            multiple 
                            accept="image/*" 
                            class="mt-2 block w-full border-gray-300 rounded-md shadow-sm"
                        >
                                              
                    </div>
                        
                    </div>
                    
            
                    <!-- Submit button -->
                    <div>
                        <button type="submit"
                            class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 mt-4">
                            Uložit aktualitu
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                    @foreach ($new->images as $image)
                        <div class="flex flex-col items-start">
                            <img src="{{ asset('storage/' . $image->path) }}" class="rounded shadow max-w-full h-auto mb-2">
                            
                            @include('admin.news.partials.delete-image-form', ['image' => $image])
                        </div>
                    @endforeach
                </div>
               
            </div>
        </div>
    </div>
</x-app-layout>