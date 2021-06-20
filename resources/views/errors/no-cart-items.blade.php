<x-app-layout>
    <div class="container transform translate-y-1/2">
        <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
            <div class="flex flex-col items-center">
                <x-cart cursor="null"/>
                <p class="text-lg text-gray-700 uppercase mt-4">Oops! Parece que tu carrito está vacío y no puedes continuar con la compra</p>
                <x-button-link href="{{route('home')}}" class="mt-4 px-16">
                    Agrega algunos items
                </x-button-link>
            </div>
        </section>
    </div>
</x-app-layout>
