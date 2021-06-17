<div class="mb-4" x-data>
    <p class="text-gray-700 text-xl">Color:</p>
    <select wire:model="color_id" name="color" class="input w-full">
        <option value="" selected disabled>Seleccione un color</option>
        @foreach($colors as $color)
            <option value="{{$color->id}}">{{ __($color->name) }}</option>
        @endforeach
    </select>
    <div class="flex items-center gap-3 mt-4">
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
                class="w-full"
                color="orange"
                disabled
                x-bind:disabled="!$wire.stock"
                wire.target="decrement">
                Agregar al carrito de compra
            </x-button>
        </div>
    </div>
</div>
