<header x-data="dropdown()" class="bg-trueGray-700 sticky top-0">
    <div class="container flex items-center h-16">
        <a
            :class="{'bg-opacity-100 text-orange-500': open}"
            x-on:click="toggle()"
            class="flex flex-col items-center justify-center bg-white bg-opacity-25 font-semibold h-full px-4 cursor-pointer text-white">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="text-sm">Categorías</span>
        </a>

        <a href="{{ route('dashboard') }}" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto"/>
        </a>

        @livewire("searchbar")

        <div class="mx-6 relative">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }}"/>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @endauth

        </div>

        @livewire('dropdown-cart')

    </div>
    <nav id="navigation-menu" :class="{'block': open, 'hidden': !open}" class="bg-trueGray-700 bg-opacity-25 absolute w-full hidden">
        <div class="container h-full">
            <div x-on:click.away="close()" class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach($categories as $category)
                        <li
                            class="navigation-link text-trueGray-500 hover:bg-orange-500 hover:text-white">
                            <a
                                class="flex py-2 px-4 text-sm items-center"
                                href="">
                                <span class="flex justify-center w-9">{!! $category->icon !!}</span>
                                {{$category->name}}
                            </a>

                            <div class="navigation-submenu absolute h-full w-3/4 top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category"/>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <x-navigation-subcategories :category="$categories->first()"/>
            </div>
        </div>
    </nav>
</header>

