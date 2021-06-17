<div x-data>
    <div>
        <p class="text-xl text-gray-700">Talla: </p>
        <select wire:model="size_id" class="input w-full">
            <option value="" selected disabled>Seleccione una talla</option>
            @foreach($sizes as $size)
                <option value="{{$size->id}}">{{$size->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="my-4">
        <p class="text-xl text-gray-700">Color: </p>
        <select wire:model="color_id" class="input w-full">
            <option value="" selected disabled>Seleccione un color</option>
            @foreach($colors as $color)
                <option class="capitalize" value="{{$color->id}}">{{__($color->name)}}</option>
            @endforeach
        </select>
    </div>

    <div class="flex items-center gap-3">
        <div class="flex items-center gap-2">
            <x-jet-secondary-button
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire.target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>
            <span class="text-gray-700">{{$qty}}</span>
            <x-jet-secondary-button
                disabled
                x-bind:disabled="$wire.qty >= $wire.stock"
                wire:loading.attr="disabled"
                wire.target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button
                x-bind:disabled="!$wire.stock"
                class="w-full" color="orange">
                Agregar al carrito de compra
            </x-button>
        </div>
    </div>
</div>
