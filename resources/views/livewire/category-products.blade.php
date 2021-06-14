<div wire:init="loadProducts">
    @if(count($products))
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
                @foreach ($products as $product)
                    <li class="bg-white rounded-lg shadow {{$loop->last ? '': 'sm:mr-4'}} ">
                        <article>
                            <figure>
                                <img class="object-cover object-center h-48 w-full" src="{{asset('storage/'.$product->image->first()->url)}}" alt="{{$product->name}}">
                            </figure>
                            <div class="py-4 px-6">
                                <h1 class="text-lg font-semibold">
                                    <a href="">
                                        {{\Illuminate\Support\Str::limit($product->name, 20)}}
                                    </a>
                                </h1>
                                <p class="text-trueGray-700 font-bold">${{$product->price}}</p>
                            </div>
                        </article>
                    </li>
                @endforeach
            </ul>

            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else
        <x-spiner/>
    @endif
</div>
