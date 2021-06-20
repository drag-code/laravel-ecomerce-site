<x-app-layout>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="container py-4">
        @foreach($categories as $category)
            <section class="mb-6">
                <span
                    class="text-gray-700 font-semibold uppercase">{{$category->name}}</span>
                <a href="{{route('categories.show', $category)}}" class="text-orange-500 font-bold hover:text-orange-400 hover:underline">Ver más</a>
                @livewire('category-products', ['category' => $category])
            </section>
        @endforeach
    </div>
    @push('script')
        <script>

            const makeSlider = (id) => {
                new Glider(document.querySelector(`.glider-${id}`), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: `.glider-${id} ~ .dots`,
                    arrows: {
                        prev: `.glider-${id} ~ .glider-prev`,
                        next: `.glider-${id} ~ .glider-next`
                    },
                    responsive: [
                        {
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },
                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });
            }
            Livewire.on('glider', (id) => {
                makeSlider(id);
            });
        </script>
    @endpush

</x-app-layout>
