<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        <form wire:submit.prevent="create">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-3">
                    <x-jet-label value="Nombre de contacto"/>
                    <x-jet-input
                        wire:model.defer="contact"
                        type="text"
                        placeholder="Ingrese el nombre de la persona que recibe el producto"
                        class="w-full"/>
                    <x-jet-input-error for="contact"/>
                </div>
                <div>
                    <x-jet-label value="Teléfono"/>
                    <x-jet-input
                        wire:model.defer="phone"
                        type="text"
                        placeholder="Ingrese un número telefónico"
                        class="w-full"
                    />
                    <x-jet-input-error for="phone"/>
                </div>
            </div>
            <div x-data="{shipping_type : @entangle('shipping_type')}">
                <p class="mt-6 mb-3 text-gray-700 text-lg font-semibold">Envíos</p>
                <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                    <input type="radio" x-model="shipping_type" value="1" name="shipping_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                Recoger en tienda(Lago de los cerezos #33)
            </span>
                    <span class="font-semibold text-gray-700 ml-auto">
                Gratis
            </span>
                </label>
                <div class="bg-white rounded-lg shadow">
                    <label class="px-6 py-4 flex items-center">
                        <input type="radio" x-model="shipping_type" value="2" name="shipping_type" class="text-gray-600">
                        <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>
                    </label>
                    <div
                        class="px-6 pb-6 grid grid-cols-2 gap-6 hidden"
                        :class="{'hidden': shipping_type!=2}"
                    >
                        <div>
                            <x-jet-label value="Departamento"/>
                            <select wire:model="department_id" class="input w-full">
                                <option value="" selected disabled>Seleccione un departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="department_id"/>
                        </div>

                        <div>
                            <x-jet-label value="Ciudad"/>
                            <select wire:model="city_id" class="input w-full">
                                <option value="" selected disabled>Seleccione una ciudad</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="city_id"/>
                        </div>

                        <div>
                            <x-jet-label value="Distrito"/>
                            <select wire:model="district_id" class="input w-full">
                                <option value="" selected disabled>Seleccione un distrito</option>
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="district_id"/>
                        </div>

                        <div>
                            <x-jet-label value="Dirección"/>
                            <x-jet-input type="text" wire:model="address" class="w-full"/>
                            <x-jet-input-error for="address"/>
                        </div>

                        <div class="col-span-2">
                            <x-jet-label value="Referencia"/>
                            <x-jet-input type="text" wire:model="reference" class="w-full"/>
                            <x-jet-input-error for="reference"/>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <x-jet-button
                    wire:loading.attr="disabled"
                    wire:target="create"
                    class="mt-6 mb-4">
                    Continuar con la compra
                </x-jet-button>
                <hr>
                <p class="text-sm text-gray-700 mt-2">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Commodi culpa doloribus enim, hic illum, iusto laudantium odio
                    possimus repellendus reprehenderit sit soluta sunt voluptas! Assumenda commodi
                    cumque cupiditate eaque ex laboriosam mollitia natus numquam odio optio, pariatur
                    porro provident quasi rem, repellendus reprehenderit sunt totam!
                    <a class="text-orange-500 font-semibold cursor-pointer">Políticas de privacidad.</a>
                </p>
            </div>
        </form>
    </div>
    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-gray-700 text-lg font-semibold">Resúmen de la compra:</h1>
            <x-cart-details/>
            <hr class="mt-4 mb-3">
            <div class="text-gray-700">
                <p class="flex items-center justify-between">
                    Subtotal
                    <span
                        class="font-semibold">${{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</span>
                </p>
                <p class="flex items-center justify-between">
                    Envío
                    <span class="font-semibold">{{!$shipping_cost ? 'Gratis' : $shipping_cost}}</span>
                </p>
                <hr class="mt-4 mb-3">
                <p class="flex items-center justify-between font-semibold">
                    <span class="text-lg">Total</span>
                    ${{\Gloudemans\Shoppingcart\Facades\Cart::subtotalFloat() + $shipping_cost}}
                </p>
            </div>
        </div>
    </div>
</div>
