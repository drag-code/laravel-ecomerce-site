<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl font-semibold text-center mb-8">Complete el formulario</h1>
    <div class="grid grid-cols-2 gap-6 mb-4">
        <div>
            <x-jet-label value="Categorías" />
            <select wire:model="category_id" class="input w-full mb-3">
                <option value="" disabled selected>Seleccione una categoría</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="category_id" />
        </div>

        <div>
            <x-jet-label value="Subcategorías" />
            <select wire:model="subcategory_id" class="input w-full mb-3">
                <option value="" disabled selected>Seleccione una subcategoría</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="subcategory_id" />
        </div>
    </div>
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="name" class="w-full" type="text"
            placeholder="Ej:Tenis para baloncesto" />
        <x-jet-input-error for="name" />
    </div>

    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="slug" class="w-full bg-gray-200" type="text"
            disabled />
        <x-jet-input-error for="slug" />
    </div>

    <div class="mb-4">
        <div wire:ignore>
            <x-jet-label value="Descripción" />
            <textarea id="editor" wire:model="description" cols="30" rows="10" class="input w-full"
                placeholder="Ej:Tennis para baloncesto, aerodinámicos y muy cómodos etc.." x-data x-init="ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then((editor) => {
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData())
            })
        })
        .catch( error => {
            console.error( error );
        } );">
            </textarea>
        </div>
        <x-jet-input-error for="description" />
    </div>

    <div class="grid grid-cols-2 gap-6 mb-4">
        <div>
            <x-jet-label value="Marca" />
            <select wire:model="brand_id" class="input w-full mb-3">
                <option value="" disabled selected>Seleccione una marca</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <x-jet-input-error for="brand_id" />
        </div>

        <div>
            <x-jet-label value="Precio" />
            <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="price" class="w-full" type="number"
                step="0.1" />
            <x-jet-input-error for="price" />
        </div>
    </div>

    @if ($this->subcategory)
        @if (!$this->subcategory->color && !$this->subcategory->size)
            <div class="mb-4">
                <x-jet-label value="Cantidad" />
                <x-jet-input onkeydown="return event.key != 'Enter';" wire:model="quantity" class="w-full"
                    type="number" />
                <x-jet-input-error for="quantity" />
            </div>
        @endif
    @endif

    <div class="flex justify-end">
        <x-jet-button wire:loading.attr="disabled" wire:target="create" wire:click="create">
            Crear producto
        </x-jet-button>
    </div>

    <div>
        <div></div>
    </div>
</div>