<div class="mt-4">
    <div class=" bg-gray-100 shadow-lg rounded-lg p-6">
        <div class="mt-8">
            <x-jet-label>
                Especifíque un color
            </x-jet-label>
            <div class="flex justify-between items-center">
                @foreach ($colors as $color)
                    <label class="flex items-center gap-1">
                        <input wire:model.defer='color_id' type="radio" value="{{ $color->id }}" name="color_id">
                        <span class="capitalize text-gray-700">{{ __($color->name) }}</span>
                    </label>
                @endforeach
            </div>
            <x-jet-input-error for="color_id" />
        </div>

        <div class="mb-4">
            <x-jet-label>
                Cantidad
            </x-jet-label>
            <x-jet-input wire:model.defer='quantity' class="w-full" type="number" placeholder="Ingrese una cantidad" />
            <x-jet-input-error for="quantity" />
        </div>

        <div class="flex justify-end items-center gap-2">
            <x-jet-action-message on="saved">
                Agregado
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="create" wire:click="create">
                Agregar
            </x-jet-button>
        </div>
    </div>

    @if ($size_colors->count())
        <div class="mt-4">
            <table>
                <thead>
                    <tr class="px-4 py-2">
                        <th class="w-1/3">Color</th>
                        <th class="w-1/3">Cantidad</th>
                        <th class="w-1/3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size_colors as $size_color)
                        <tr>
                            <td class="px-4 py-2">{{ __($colors->find($size_color->pivot->color_id)->name) }}</td>
                            <td class="px-4 py-2">{{ $size_color->pivot->quantity }}</td>
                            <td class="px-4 py-2 flex">
                                <x-jet-secondary-button wire:loading.attr='disabled'
                                    wire:target='edit({{ $size_color->pivot->id }})' class="ml-auto mr-2"
                                    wire:click="edit({{ $size_color->pivot->id }})">
                                    Actualizar
                                </x-jet-secondary-button>
                                <x-jet-danger-button wire:loading.attr='disabled'
                                    wire:target='showDelete({{ $size_color->pivot->id }})'
                                    wire:click="showDelete({{ $size_color->pivot->id }})">
                                    Eliminar
                                </x-jet-danger-button>
                                {{-- <x-jet-danger-button
                                    wire:click="$emit('deleteSizeColor', {{ $size_color->pivot->id }})">
                                    Eliminar
                                </x-jet-danger-button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Editar colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>
                    Color
                </x-jet-label>

                <select class="input w-full" wire:model='pivot_color_id'>
                    <option value="" disabled>Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">
                            {{ __($color->name) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input wire:model='pivot_quantity' class="w-full" type="number"
                    placeholder="Ingrese una cantidad" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="update" wire:loading.attr='disabled' wire:target='update'>
                Actualizar
            </x-jet-button>
            <x-jet-action-message on="saved">
                Actualizado
            </x-jet-action-message>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model='open_delete'>
        <x-slot name="title">
           <p class="font-bold text-2xl text-gray-700 text-center">¿Está seguro?</p>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <h1>¿Esta acción no se puede revertir?</h1>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_delete', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="destroy" wire:loading.attr='disabled' wire:target='destroy'>
                Eliminar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
{{-- @push('script')
    <script>
        $(document).ready(function() {
            Livewire.on('deleteSizeColor', (pivot) => {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "No podrá revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('destroy', pivot);
                        Swal.fire(
                            '¡Eliminación exitosa!',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush --}}
@push('script')
    <script>
            Livewire.on('success', () => {
                Swal.fire({
                    title: 'Perfecto!',
                    text: "Eliminación exitósa",
                    icon: 'success'
                });
            });    
    </script>
@endpush