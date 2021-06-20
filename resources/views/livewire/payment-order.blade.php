<div>
    {{--@php
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        $shipment = new MercadoPago\Shipments();
        $shipment->cost = $order->shipping_cost;
        $shipment->mode = "not_specified";
        $preference->shipments = $shipment;
        $preference->back_urls = array(
            "success" => route('orders.pay', $order),
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        $preference->auto_return = "approved";
        foreach ($items as $product) {
            // Crea un ítem en la preferencia
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;
            $products[] = $item;
        }
        $preference->items = $products;
        $preference->save();
    @endphp--}}

    <div class="grid grid-cols-5 gap-6 container py-8">
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">Número de orden:</span> Orden-{{$order->id}}
                </p>
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
        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 pt-6 text-gray-700 mb-6">
                <div
                    class="flex justify-between items-center mb-4">
                    <img class="object-cover object-center h-12" src="{{asset('img/credit-cards.png')}}"
                         alt="Payment options">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold
">
                            Subtotal: ${{$order->total - $order->shipping_cost}}
                        </p>
                        <p class="text-sm font-semibold
">
                            Costo de envío: ${{$order->shipping_cost}}
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Total: ${{$order->total}}
                        </p>
                        {{--<div class="mercadopago-container">
                        </div>--}}
                    </div>
                </div>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
    {{-- SDK MercadoPago.js V2--}}
    {{--<script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        // Agrega credenciales de SDK
        const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
            locale: 'es-MX'
        });

        // Inicializa el checkout
        mp.checkout({
            preference: {
                id: "{{$preference->id}}"
            },
            render: {
                container: '.mercadopago-container', // Indica dónde se mostrará el botón de pago
                label: 'Pagar', // Cambia el texto del botón de pago (opcional)
            }
        });
    </script>--}}

    @push('script')
        {{--PAYPAL--}}
        <script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=MXN"> // Replace YOUR_CLIENT_ID with your sandbox client ID
        </script>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: "{{$order->total / 100}}"
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        /*alert('Transaction completed by ' + details.payer.name.given_name);*/
                        Livewire.emit('payOrder')
                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page
        </script>
    @endpush
</div>
