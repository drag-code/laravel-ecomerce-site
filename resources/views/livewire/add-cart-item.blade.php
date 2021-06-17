<div x-data>

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-">Stock disponible: {{$stock}}</span>
    </p>

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
                x-bind:disabled="$wire.qty == $wire.stock"
                wire:loading.attr="disabled"
                wire.target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
        <div class="flex-1">
            <x-button class="w-full" color="orange">
                Agregar al carrito de compra
            </x-button>
        </div>
    </div>
</div>
