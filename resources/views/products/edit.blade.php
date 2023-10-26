<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('products.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mt-3">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $product->name }}" required autofocus></x-text-input>
                        </div>

                        <x-secondary-button class="mt-6" type="submit">
                            {{ __('Update') }}
                        </x-secondary-button>
                    </form>


                </div>


            </div>
        </div>
    </div>
    </div>
</x-app-layout>
