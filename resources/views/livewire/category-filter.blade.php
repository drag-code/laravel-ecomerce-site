<div>
    <div class="bg-white rounded-lg shadow-lg mb-4">
        <div class="flex items-center justify-between px-6 py-2">
            <h1 class="text-gray-700 font-semibold uppercase">{{$category->name}}</h1>
            <div
                class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500 cursor-pointer">
                <span wire:click="$set('display', 'grid')"><i class="fas fa-border-all p-3 {{$display == 'grid' ? 'text-orange-500' : ''}}"></i></span>
                <span wire:click="$set('display', 'list')"><i class="fas fa-th-list p-3 {{$display == 'list' ? 'text-orange-500' : ''}}"></i></span>
            </div>
        </div>
    </div>
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <aside>
            <h2 class="text-center font-bold">Subcategorías</h2>
            <ul class="py-2 divide-y divide-gray-200">
                @foreach($category->subcategories as $subcategory)
                    <li wire:model="subcategory" wire:click="$set('selected_subcategory', '{{$subcategory->name}}')" class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-orange-500 capitalize {{$selected_subcategory == $subcategory->name ? 'text-orange-500' : ''}} ">{{$subcategory->name}}</a>
                    </li>
                @endforeach
            </ul>
            <h2 class="text-center font-bold">Marcas</h2>
            <ul class="py-2 divide-y divide-gray-200">
                @foreach($category->brands as $brand)
                    <li wire:model="brand"  wire:click="$set('selected_brand', '{{$brand->name}}')" class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-orange-500 capitalize {{$selected_brand == $brand->name ? 'text-orange-500' : ''}}">{{$brand->name}}</a>
                    </li>
                @endforeach
            </ul>
            <x-jet-button class="mt-4" wire:click="removeFilters">
                Eliminar filtros
            </x-jet-button>
        </aside>
        <div class="md:col-span-2 lg:col-span-4">
            @if($display == 'grid')
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                    @foreach($products as $product)
                        <x-product-card :product="$product"/>
                    @endforeach
                </ul>
            @else
                <ul>
                    @foreach($products as $product)
                        <x-product-list :product="$product"/>
                    @endforeach
                </ul>
            @endif
            <div>
                {{$products->links()}}
            </div>
        </div>
    </section>
</div>
