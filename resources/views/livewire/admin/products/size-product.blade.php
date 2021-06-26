<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6 mt-12">
        <div class="mb-6">
            <x-jet-label>
                Especifíque una talla
            </x-jet-label>
            <x-jet-input class="w-full" wire:model.defer='name' type="text" name="size_id" placeholder="Ej: Mediana" />
            <x-jet-input-error for="name" />
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

    @if ($added_sizes->count())
        <ul class="mb-12">
            @foreach ($added_sizes as $size)
                <li class="bg-white shadow-lg rounded-lg p-6 mb-6">
                    <div class="flex items-center">
                        <span class="text-xl font-medium">{{ __($size->name) }}</span>
                        <div class="ml-auto">
                            <x-jet-secondary-button wire:loading.attr='disabled' wire:target='show({{ $size->id }})'
                                class="ml-auto mr-2" wire:click="show({{ $size->id }})">
                                Actualizar
                            </x-jet-secondary-button>
                            <x-jet-danger-button wire:click="$emit('deleteSize', {{ $size->id }})">
                                Eliminar
                            </x-jet-danger-button>
                        </div>
                    </div>

                    @livewire('admin.products.size-color', ['size' => $size], key('size-color-'.$size->id))

                </li>
            @endforeach
        </ul>
    @endif

    <x-jet-dialog-modal wire:model='open'>
        <x-slot name="title">
            Editar tallas
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input class="w-full" wire:model.defer='name_edit' type="text" name="name" placeholder="Ej: Mediana" />
                <x-jet-input-error for="name_edit" />
            </div>

            {{-- <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>
                <x-jet-input wire:model='pivot_quantity' class="w-full" type="number"
                    placeholder="Ingrese una cantidad" />
            </div> --}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button wire:click="edit" wire:loading.attr='disabled' wire:target='edit'>
                Actualizar
            </x-jet-button>
            <x-jet-action-message on="saved">
                Actualizado
            </x-jet-action-message>
        </x-slot>
    </x-jet-dialog-modal>
</div>
@push('script')
    <script>
        Livewire.on('deleteSize', (size) => {
            Swal.fire({
                title: '¿Está seguro?',
                text: "No podrá revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('admin.products.size-product', 'destroy', size);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('showErrorAlert', (message) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: `${message}`
            })
        });
    </script>
@endpush
