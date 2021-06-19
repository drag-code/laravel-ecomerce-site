<div class="flex gap-3 items-center justify-center" x-data>
    <x-jet-secondary-button
        disabled
        x-bind:disabled="($wire.qty <= 1) || !$wire.stock"
        wire:loading.attr="disabled"
        wire.target="decrement"
        wire:click="decrement"
    >
        -
    </x-jet-secondary-button>
    <span>{{$qty}}</span>
    <x-jet-secondary-button
        disabled
        x-bind:disabled="($wire.qty == $wire.stock) || !$wire.stock"
        wire:loading.attr="disabled"
        wire.target="increment"
        wire:click="increment"
    >
        +
    </x-jet-secondary-button>
</div>
