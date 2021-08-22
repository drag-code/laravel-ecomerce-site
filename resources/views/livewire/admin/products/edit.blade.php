<div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
        <h1 class="text-3xl font-semibold text-center mb-8">Complete el formulario</h1>
        <div class="bg-white rounded-lg shadow-xl p-4">

            <div class="mb-4">
                <form wire:ignore action="{{ route('admin.products.files', $product) }}" class="dropzone"
                    id="my-awesome-dropzone" method="POST"></form>
            </div>

            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label value="Categorías" />
                    <select wire:model="category_id" class="input w-full mb-3">
                        <option value="" selected disabled>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="category_id" />
                </div>
                <div>
                    <x-jet-label value="Subcategorías" />
                    <select wire:model="product.subcategory_id" class="input w-full mb-3">
                        <option value="" selected disabled>Seleccione una subcategoría</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.subcategory_id" />
                </div>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="product.name" class="w-full"
                    type="text" placeholder="Ej:Tenis para baloncesto" />
                <x-jet-input-error for="product.name" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Slug" />
                <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="slug" class="w-full bg-gray-200"
                    type="text" disabled />
                <x-jet-input-error for="slug" />
            </div>
            <div class="mb-4">
                <div wire:ignore>
                    <x-jet-label value="Descripción" />
                    <textarea id="editor" wire:model="product.description" cols="30" rows="10" class="input w-full"
                        placeholder="Ej:Tennis para baloncesto, aerodinámicos y muy cómodos etc.." x-data x-init="ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then((editor) => {
                    editor.model.document.on('change:data', () => {
                        @this.set('product.description', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );">
                    </textarea>
                </div>
                <x-jet-input-error for="product.description" />
            </div>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label value="Marca" />
                    <select wire:model="product.brand_id" class="input w-full mb-3">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id" />
                </div>
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="product.price" class="w-full"
                        type="number" step="0.1" />
                    <x-jet-input-error for="product.price" />
                </div>
            </div>
            @if ($this->subcategory)
                @if (!$this->subcategory->color && !$this->subcategory->size)
                    <div class="mb-4">
                        <x-jet-label value="Cantidad" />
                        <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="product.quantity"
                            class="w-full" type="number" />
                        <x-jet-input-error for="product.quantity" />
                    </div>
                @endif
            @endif
            <div class="flex justify-end items-center gap-2">
                <x-jet-action-message on="updated">
                    Actualizado
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled" wire:target="create" wire:click="create">
                    Actualizar
                </x-jet-button>
            </div>
        </div>
        @if ($this->subcategory)
            @if ($this->subcategory->size)
                @livewire('admin.products.size-product', ['product' => $product], key('size-product-'.$product->id))
            @endif
            @if ($this->subcategory->color)
                @livewire('admin.products.color-product', ['product' => $product], key('color-product-'.$product->id))
            @endif
        @endif
    </div>
    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                paramName: "file", // The name that will be used to transfer the file
                acceptedFiles: "image/*",
                dictDefaultMessage: "Arrastre o seleccione hasta 5 imágenes, (cada imágen debe pesar 2MB como máximo)",
                dictFileToBig: "El archivo excede el límite de 2 MB",
                maxFiles: 5,
                maxFilesize: 2,  // MB
                addRemoveLinks: true
            };
        </script>
    @endpush
</div>
