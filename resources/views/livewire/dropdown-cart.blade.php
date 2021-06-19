<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <x-cart color="white" size="30" :items="$items"/>
        </x-slot>
        <x-slot name="content">
            <ul>
                @forelse(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                    <li class="flex p-2 border border-b border-gray-200">
                        <img class="object-cover h-15 w-20 mr-4" src="{{$item->options->image}}"
                             alt="">
                        <article class="flex-1">
                            <h1 class="font-bold text-gray-700">{{$item->name}}</h1>
                            <div class="flex gap-3">
                                <p>Cantidad: {{$item->qty}}</p>
                                @isset($item->options['color_name'])
                                    <p>Color: <span class="capitalize">{{__($item->options['color_name'])}}</span></p>
                                @endisset
                                @isset($item->options['size_name'])
                                    <p>Tamaño: {{$item->options['size_name']}}</p>
                                @endisset
                            </div>
                            <p>${{$item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="px-4 py-6">
                        <p class="text-center text-gray-700">
                            No hay items en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>
            @if (\Gloudemans\Shoppingcart\Facades\Cart::count())
                <div class="p-2">
                    <p class="text-lg text-gray-700 mt-2 mb-3"><span class="font-bold">Total:</span>
                        ${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</p>
                    <x-button-link href="{{route('shopping-cart')}}" color="orange" class="w-full">
                        Ir al carrito de compras
                    </x-button-link>
                </div>
            @endif
        </x-slot>
    </x-jet-dropdown>
</div>
