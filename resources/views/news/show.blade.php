<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail akuality') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
          
                    <h1 class="text-3xl font-bold mb-4">{{ $new->title }}</h1>

                    @if ($new->main_image)
                        <img src="{{ asset('storage/' . $new->main_image) }}" alt="Main image" class="mb-4 rounded">
                    @endif

                    <div class="text-gray-700 mb-6">
                        {!! nl2br(e($new->content)) !!}
                    </div>

                    <a href="{{ route('news') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        <- Zpět
                    </a>
     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
