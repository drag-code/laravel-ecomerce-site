@props(['category'])
<div class="col-span-3 bg-gray-100">
    <div class="grid grid-cols-4 p-4">
        <div class="text-lg font-bold text-center text-trueGray-500 mb-3">
            <p>Subcategorías</p>
            <ul>
                @foreach($category->subcategories as $subcategory)
                    <li class="text-left">
                        <a
                            class="inline-block py-1 pl-4 font-semibold hover:text-orange-500"
                            href="">
                            {{$subcategory->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-span-3">
            <img class="object-cover object-center h-64 w-full" src="{{asset('storage/'.$category->image)}}" alt="">
        </div>
    </div>
</div>
