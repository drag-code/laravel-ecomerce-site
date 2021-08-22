@props(['product', 'loop' => null])
@php
$display_extra_margin = null;
if ($loop) {
    $display_extra_margin = $loop->last ? '' : 'sm:mr-4';
}

@endphp

<li class="bg-white rounded-lg shadow {{ $display_extra_margin }} ">
    <article>
        <figure>
            <img class="object-cover object-center h-48 w-full" src="{{ Storage::url($product->image->first()->url) }}"
                alt="{{ $product->name }}">
        </figure>
        <div class="py-4 px-6">
            <h1 class="text-lg font-semibold">
                <a href="{{ route('products.show', $product) }}">
                    {{ \Illuminate\Support\Str::limit($product->name, 20) }}
                </a>
            </h1>
            <p class="text-trueGray-700 font-bold">${{ $product->price }}</p>
        </div>
    </article>
</li>
