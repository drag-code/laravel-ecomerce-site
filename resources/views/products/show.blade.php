<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-2 gap-4">
            <section>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach($product->image as $image)
                            <li data-thumb="{{asset('storage/'.$image->url)}}">
                                <img src="{{asset('storage/'.$image->url)}}"/>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <section>
                <div>
                    <h1 class="text-trueGray-700 font-bold text-lg">{{$product->name}}</h1>
                    <div class="flex gap-4">
                        <p class="text-trueGray-700">Marca: <a href="#"
                                                               class="underline capitalize hover:text-orange-500">{{$product->brand->name}}</a>
                        </p>
                        <p class="text-trueGray-700">5<i
                                class="fas fa-star text-sm text-yellow-400"></i></p>
                        <a href="#" class="text-orange-500 underline hover:text-orange-600">39
                            reseñas</a>
                        <div class="flex flex-1 justify-end">
                            <x-button-link color="blue" href="{{route('home')}}">
                                Regresar
                            </x-button-link>
                        </div>
                    </div>
                    <p class="text-trueGray-700 font-semibold text-2xl my-4">
                        ${{$product->price}}</p>
                </div>
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 flex items-center gap-4">
                        <span class="flex items-center justify-center h-10 w-10 bg-greenLime-600 rounded-full">
                            <i class="fas fa-truck text-white text-sm"></i>
                        </span>
                        <div>
                            <p class="text-greenLime-700 font-bold">Se hacen envíos a todo México</p>
                            <p class="text-sm">Recíbelo el <span class="text-greenLime-700">{{ \Jenssegers\Date\Date::now()->addDays(7)->locale('es')->format("l j \d\\e F")}}</span></p>
                        </div>
                    </div>
                </div>
                <div>
                    @if($product->subcategory->size)
                        @livewire('add-cart-item-size', ['product' => $product])
                    @elseif($product->subcategory->color)
                        @livewire('add-cart-item-color', ['product' => $product])
                    @else
                        @livewire('add-cart-item', ['product' => $product])
                    @endif
                </div>
            </section>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function () {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
