<x-app-layout>
    <div class="container p-8">
        <figure>
            <img class="object-cover object-center h-80 w-full mb-8" src="{{asset('storage/'.$category->image)}}" alt="{{$category->name}}">
        </figure>
        @livewire('category-filter', ['category' => $category])
    </div>
</x-app-layout>
