<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-gray-600 font-semibold text-xl leading-tight">
                Lista de productos
            </h2>
            <x-button-link href="{{ route('admin.products.create') }}" color="orange">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>

    <div class="container py-12">

        <div class="px-6 py-4">
            <x-jet-input wire:model="search" type="text" class="w-full" placeholder="Ingrese el nombre del producto">

            </x-jet-input>
        </div>

        <x-table>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categoría
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Precio
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ asset('storage/'.$product->image->first()->url) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $product->subcategory->category->name }}
                                </div>
                                {{-- <div class="text-sm text-gray-500">Optimization</div> --}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $product->status == 1 ? 'Borrador' : 'Publicado' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${{ $product->price }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-table>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

</div>
