<x-app-layout>
    <div class="container py-12">
        {{--STATUS CARDS--}}
        <section class="grid grid-cols-5 gap-6 text-white text-center">
            <a href="{{route('orders.index').'?status=1'}}"
               class="bg-red-500 bg-opacity-75 cursor-pointer rounded-lg shadow px-12 pt-8 pb-4">
                <p class="text-2xl">{{$total_orders->where('status', 1)->count()}}</p>
                <p class="uppercase text-2xl">Pendiente</p>
                <p class="uppercase text-2xl mt-2"><i class="fas fa-business-time"></i></p>
            </a>

            <a href="{{route('orders.index').'?status=2'}}"
               class="bg-gray-500 bg-opacity-75 cursor-pointer rounded-lg shadow px-12 pt-8 pb-4">
                <p class="text-2xl">{{$total_orders->where('status', 2)->count()}}</p>
                <p class="uppercase text-2xl">Pagadas</p>
                <p class="uppercase text-2xl mt-2"><i class="fas fa-credit-card"></i></p>
            </a>

            <a href="{{route('orders.index').'?status=3'}}"
               class="bg-yellow-500 bg-opacity-75 cursor-pointer rounded-lg shadow px-12 pt-8 pb-4">
                <p class="text-2xl">{{$total_orders->where('status', 3)->count()}}</p>
                <p class="uppercase text-2xl">Enviadas</p>
                <p class="uppercase text-2xl mt-2"><i class="fas fa-truck"></i></p>
            </a>

            <a href="{{route('orders.index').'?status=4'}}"
               class="bg-pink-500 bg-opacity-75 cursor-pointer rounded-lg shadow px-12 pt-8 pb-4">
                <p class="text-2xl">{{$total_orders->where('status', 4)->count()}}</p>
                <p class="uppercase text-2xl">Entregadas</p>
                <p class="uppercase text-2xl mt-2"><i class="fas fa-check-circle"></i></p>
            </a>

            <a href="{{route('orders.index').'?status=5'}}"
               class="bg-green-500 bg-opacity-75 cursor-pointer rounded-lg shadow px-12 pt-8 pb-4">
                <p class="text-2xl">{{$total_orders->where('status', 5)->count()}}</p>
                <p class="uppercase text-2xl">Anuladas</p>
                <p class="uppercase text-2xl mt-2"><i class="fas fa-times-circle"></i></p>
            </a>
        </section>

        {{--STATUS LIST}}--}}
        <section class="bg-white rounded-lg shadow-lg p-8 mt-12 text-gray-700">
            <h1 class="text-2xl mb-4">Pedidos recientes</h1>
            <ul>
                @forelse($orders as $order)
                    <li>
                        <a href="{{route('orders.show', $order)}}"
                           class="flex items-center py-2 px-4 hover:bg-gray-100">
                            <span class="w-12 text-center">
                                @switch($order->status)
                                    @case(1)
                                    <i class="fas fa-business-time text-red-500 opacity-75"></i>
                                    @break
                                    @case(2)
                                    <i class="fas fa-credit-card text-gray-500 opacity-75"></i>
                                    @break
                                    @case(3)
                                    <i class="fas fa-truck text-yellow-500 opacity-75"></i>
                                    @break
                                    @case(4)
                                    <i class="fas fa-check-circle text-pink-500 opacity-75"></i>
                                    @break
                                    @case(5)
                                    <i class="fas fa-times-circle text-green-500 opacity-75"></i>
                                    @break
                                @endswitch
                            </span>
                            <span>
                                Orden: {{$order->id}}
                                <br>
                                {{$order->created_at->format('d/m/Y')}}
                            </span>
                            <div class="ml-auto text-center">
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                        Pendiente
                                        @break
                                        @case(2)
                                        Pagado
                                        @break
                                        @case(3)
                                        Enviado
                                        @break
                                        @case(4)
                                        Entregado
                                        @break
                                        @case(5)
                                        Anulado
                                        @break
                                    @endswitch
                                </span>
                                <br>
                                <span class="text-sm">
                                    ${{$order->total}}
                                </span>
                            </div>
                            <span>
                                <i class="fas fa-angle-right ml-6"></i>
                            </span>
                        </a>
                    </li>
                @empty
                @endforelse
            </ul>
            <div class="mt-4">
                {{$orders->links()}}
            </div>
        </section>
    </div>
</x-app-layout>
