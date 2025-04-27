<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktuality') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <form method="POST" action="{{ route('news.update', $new->id) }}">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Název</label>
                        <input type="text" name="title" id="title" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            value="{{ $new->title }}">
                    </div>

                    <div>
                        <label for="perex" class="block text-sm font-medium text-gray-700">Úvod</label>
                        <input type="text" name="perex" id="perex" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            value="{{ $new->perex }}">
                    </div>
            
                    <!-- Obsah -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Obsah</label>
                        <textarea name="content" id="content" rows="6" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('content', $new->content) }}</textarea>
                    </div>
                    
            
                    <!-- TODO: Obrázek -->
                    
            
                    <!-- Submit button -->
                    <div>
                        <button type="submit"
                            class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 mt-4">
                            Uložit aktualitu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>