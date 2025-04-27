<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktuality') }}
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
    
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('news.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Vytvořit novou aktualitu
                    </a>     
                </div>
                          
                <div class="p-6 text-gray-900">
                    @if ($news->isEmpty())
                        <p class="text-gray-500">Žádné aktuality zatím nebyly přidány.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($news as $new)
                                <div class="bg-gray-100 rounded-lg shadow p-4 grid grid-cols-4 gap-4 items-center">
                                    <!-- Obrázek -->
                                    <div class="col-span-1">
                                        @if ($new->image)
                                            <img src="{{ asset('storage/' . $new->image) }}" alt="{{ $new->title }}" class="w-full h-32 object-cover rounded">
                                        @else
                                            <div class="w-full h-32 bg-gray-200 flex items-center justify-center rounded">
                                                <span class="text-gray-500">Bez obrázku</span>
                                            </div>
                                        @endif
                                    </div>
                
                                    <!-- Text a Akce -->
                                    <div class="col-span-3 flex flex-col justify-between h-full">
                                        <div class="text-xl font-semibold">
                                            {{ $new->title }}
                                        </div>
                                        <div class="mt-2 flex space-x-4">
                                            <a href="{{ route('news.show', $new->id) }}" class="text-blue-500 hover:underline flex items-center">
                                                <i class="fa fa-search mr-1"></i> Detail
                                            </a>
                
                                            @include('news.partials.delete-form', ['news' => $new])
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
