@props(['product'])
<li class="bg-white rounded-lg shadow mb-4">
    <article class="flex">
        <figure>
            <img class="object-cover object-center h-48 w-56" src="{{ Storage::url($product->image->first()->url) }}"
                alt="{{ $product->name }}">
        </figure>
        <div class="py-4 px-6 flex-1 flex flex-col justify-between">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-lg font-semibold text-gray-700">
                        <p>
                            {{ \Illuminate\Support\Str::limit($product->name, 20) }}
                        </p>
                    </h1>
                    <p class="text-gray-700 font-bold">${{ $product->price }}</p>
                </div>
                <div class="flex items-center gap-1">
                    <ul class="flex text-sm text-yellow-400 gap-1">
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                        <li><i class="fas fa-star"></i></li>
                    </ul>
                    <span class="text-gray-700 text-sm">(24)</span>
                </div>
            </div>
            <div>
                <x-jet-danger-button>
                    <a href="{{ route('products.show', $product) }}">Más información</a>
                </x-jet-danger-button>
            </div>
        </div>
    </article>
</li>
