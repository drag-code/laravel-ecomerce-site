<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <x-cart color="white" size="30" :items="$items"/>
        </x-slot>
        <x-slot name="content">
            <x-cart-details/>
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
