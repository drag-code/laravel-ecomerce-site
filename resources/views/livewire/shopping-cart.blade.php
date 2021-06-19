<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold mb-6">Carrito de compras</h1>
        @if(\Gloudemans\Shoppingcart\Facades\Cart::count())
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th></th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                    <tr>
                        <td>
                            <div class="flex gap-3">
                                <img class="object-cover object-center h-15 w-20"
                                     src="{{$item->options->image}}" alt="">
                                <div class="text-gray-700">
                                    <p class="text-lg font-bold leading-5">{{$item->name}}</p>
                                    @isset($item->options['color_name'])
                                        <p>Color: {{__($item->options['color_name'])}}</p>
                                    @endisset
                                    @isset($item->options['size_name'])
                                        <p>Tamaño: {{$item->options['size_name']}}</p>
                                    @endisset
                                </div>
                            </div>
                        </td>
                        <td>
                        <span class="flex items-center justify-center">
                            ${{$item->price}}
                            <a
                                wire:click="removeItem('{{$item->rowId}}')"
                                wire:loading.class="text-red-700 opacity-25"
                                wire:target="removeItem('{{$item->rowId}}')"
                                class="ml-6 cursor-pointer hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </a>
                        </span>
                        </td>
                        <td>
                            @if($item->options['size_id'])
                                @livewire('update-cart-item-size', ['row_id' => $item->rowId], key($item->rowId))
                            @elseif($item->options['color_id'])
                                @livewire('update-cart-item-color', ['row_id' => $item->rowId], key($item->rowId))
                            @else
                                @livewire('update-cart-item', ['row_id' => $item->rowId], key($item->rowId))
                            @endif
                        </td>
                        <td>
                            <p class="text-center">${{$item->price * $item->qty}}</p>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a wire:click="destroyCart" class="text-sm cursor-pointer hover:underline mt-3 inline-block">
                <i class="fas fa-trash"></i>
                Borrar carrito de compras
            </a>
        @else
            <div class="flex flex-col items-center">
                <x-cart cursor="null"/>
                <p class="text-lg text-gray-700 uppercase mt-4">Tu carrito está vacío</p>
                <x-button-link href="{{route('home')}}" class="mt-4 px-16">
                    Agrega algunos items
                </x-button-link>
            </div>
        @endif
    </section>
    @if(\Gloudemans\Shoppingcart\Facades\Cart::count())
        <section class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total: </span>
                        ${{\Gloudemans\Shoppingcart\Facades\Cart::subTotal()}}
                    </p>
                </div>
                <div>
                    <x-button-link>
                        Continuar
                    </x-button-link>
                </div>
            </div>
        </section>
    @endif
</div>
