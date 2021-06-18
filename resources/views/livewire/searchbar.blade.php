<div class="flex-1 relative" x-data>
    <form action="{{route('search')}}" autocomplete="off">
        <x-jet-input
            name="search"
            wire:model="search"
            type="text"
            class="w-full" placeholder="¿Qué estas buscando?"
        />
        <button
            type="submit"
            class="absolute top-0 right-0 w-12 h-full bg-orange-500 flex items-center justify-center rounded-r-md">
            <x-search size="35" color="white"/>
        </button>
    </form>
    <div
        class="absolute w-full hidden"
        :class="{'hidden': !$wire.open}"
        @click.away="$wire.open=false"
    >
        <div class="bg-white rounded-lg shadow mt-1">
            <div class="px-4 py-3">
                @forelse($products as $product)
                    <a class="flex gap-2 mb-2 cursor-pointer" href="{{route('products.show', $product)}}">
                        <img class="object-cover object-center h-12 w-16" src="{{asset('storage/'.$product->image->first()->url)}}" alt="">
                        <div class="text-gray-700">
                            <p class="text-lg font-semibold leading-5">{{$product->name}}</p>
                            <p>Categoría: {{$product->subcategory->category->name}}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg leading-5">
                        No se encontraron resultados
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
