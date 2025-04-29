<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail akuality') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
    
                <div class="alert alert-success bg-green-300 p-4 text-center">
    
                    {{ session('message') }}
    
                </div>
            
            @elseif (session()->has('error'))
                <div class="alert alert-error">
        
                    {{ session('error') }}

                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-4">
                        <!-- Vlevo: Nadpis a Upravit -->
                        <div class="flex items-center space-x-4">
                            <h1 class="text-3xl font-bold">{{ $new->title }}</h1>
                            <a href="{{ route('news.edit', $new->id) }}" class="text-green-500 hover:underline flex items-center">
                                <i class="fa fa-edit mr-1"></i> Upravit
                            </a>
                        </div>
                    
                        <!-- Vpravo: Zpět -->
                        <a href="{{ route('news') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            <i class="fa fa-long-arrow-left mr-1"></i> Zpět
                        </a>
                    </div>

                    <div class="text-xl mb-4">{{ $new->perex }}</div>

                    @if ($new->main_image)
                        <div class="max-w-xs">
                            <img src="{{ asset('storage/' . $new->main_image) }}" alt="Main image" class="w-full h-auto object-contain">
                        </div>
                    @endif
                
                    <div class="text-gray-700 mb-6 mt-6">
                        {!! nl2br(e($new->content)) !!}
                    </div>

                    @include('news.partials.delete-form', ['news' => $new, 'index' => false])
     
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
