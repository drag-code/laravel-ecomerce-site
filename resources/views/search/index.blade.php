<x-app-layout>
    <div class="container">
        <ul class="py-8">
            @forelse($products as $product)
                <x-product-list :product="$product"/>
            @empty
                <li class="bg-white rounded-lg shadow-2xl font-semibold">
                    <div class="p-4">
                        <p class="text-gray-700 text-lg">Lo sentimos, ningún producto coincide con su búsqueda</p>
                    </div>
                </li>
            @endforelse
            <div class="mt-4">
                {{$products->links()}}
            </div>
        </ul>
    </div>
</x-app-layout>
