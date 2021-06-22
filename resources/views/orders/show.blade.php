<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{--STATUS SECTION--}}
        <div class="bg-white rounded-lg shadow-lg px-12 py-6 mb-6 flex items-center">

            <div class="flex flex-col items-center">
                <div
                    class="rounded-full w-12 h-12 {{($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-gray-700 font-semibold">Pagado</p>
            </div>

            <div
                class="h-1 flex-1 {{($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} mx-2"></div>

            <div class="flex flex-col items-center">
                <div
                    class="rounded-full w-12 h-12 {{($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <p class="text-gray-700 font-semibold">En camino</p>
            </div>

            <div
                class="h-1 flex-1 {{($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} mx-2"></div>

            <div class="flex flex-col items-center">
                <div
                    class="rounded-full w-12 h-12 {{($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-gray-700 font-semibold">Entregado</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex justify-between items-center">
            <p class="text-gray-700 uppercase">
                <span class="font-semibold">Número de orden:</span> Orden-{{$order->id}}
            </p>
            @if($order->status == 1)
                <x-button-link href="{{route('orders.payment', $order)}}">
                    Pagar
                </x-button-link>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                {{--SHIPPING DETAILS--}}
                <div>
                    <p class="text-lg font-semibold uppercase mb-2">Envío</p>
                    @if ($order->shipping_type == 1)
                        <p class="text-sm">El pedido debe ser recogido en tienda</p>
                        <p class="text-sm">Lago de los cerezos #33</p>
                    @else
                        <p class="text-sm">El pedido será enviado al siguiente domicilio:</p>
                        <p class="text-sm">Diección: {{$order->address}}</p>
                        <p class="text-sm">{{$order->department->name}} - {{$order->city->name}}
                            - {{$order->district->name}}</p>
                    @endif
                </div>

                {{--CONTACT INFO--}}
                <div>
                    <p class="text-lg font-semibold uppercase mb-2">Información de contacto</p>
                    <p class="text-sm">Persona que recibirá el pedido: {{$order->contact}}</p>
                    <p class="text-sm">Número telefónico: {{$order->phone}}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resúmen de compra</p>
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th></th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($items as $item)
                    <tr>
                        <td>
                            <div class="flex p-2">
                                <img class="object-cover h-15 w-20 mr-4"
                                     src="{{$item->options->image}}"
                                     alt="">
                                <article class="flex-1">
                                    <h1 class="font-bold text-gray-700">{{$item->name}}</h1>
                                    <div class="flex gap-3">
                                        <p>Cantidad: {{$item->qty}}</p>
                                        @isset($item->options->color_name)
                                            <p>Color: <span
                                                    class="capitalize">{{__($item->options->color_name)}}</span>
                                            </p>
                                        @endisset
                                        @isset($item->options->size_name)
                                            <p>Tamaño: {{$item->options->size_name}}</p>
                                        @endisset
                                    </div>
                                </article>
                            </div>
                        </td>
                        <td class="text-center">${{$item->price}}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-center">${{$item->price * $item->qty}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
