<header x-data="dropdown()" class="bg-trueGray-700 sticky z-50 top-0">
    <div class="container flex items-center justify-between md:justify-start h-16">
        <a
            :class="{'bg-opacity-100 text-orange-500': open}"
            x-on:click="toggle()"
            class="flex flex-col items-center justify-center order-last md:order-first bg-white bg-opacity-25 font-semibold h-full px-6 md:px-4 cursor-pointer text-white">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="text-sm hidden md:block">Categorías</span>
        </a>

        <a href="{{ route('dashboard') }}" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto"/>
        </a>

        <div class="flex-1 hidden md:block">
            @livewire("searchbar")
        </div>

        <div class="mx-6 relative hidden md:block">
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

        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>

    </div>
    <nav id="navigation-menu" :class="{'block': open, 'hidden': !open}"
         class="bg-trueGray-700 bg-opacity-25 absolute w-full hidden">
        {{--DESKTOP MENU--}}
        <div class="container h-full hidden md:block">
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

                            <div
                                class="navigation-submenu absolute h-full w-3/4 top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category"/>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <x-navigation-subcategories :category="$categories->first()"/>
            </div>
        </div>

        {{--MOBILE MENU--}}
        <div class="bg-white h-full overflow-y-auto">
            <div class="container bg-gray-200 py-3 mb-2">
                @livewire('searchbar')
            </div>
            <ul>
                @foreach($categories as $category)
                    <li
                        class="text-trueGray-500 hover:bg-orange-500 hover:text-white">
                        <a
                            class="flex py-2 px-4 text-sm items-center">
                            <span class="flex justify-center w-9">{!! $category->icon !!}</span>
                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="border-t border-gray-300"></div>
            <div class="block px-4 py-2 text-md text-gray-400">
                {{ __('Usuarios') }}
            </div>
            @livewire('cart-mobile')
            @auth
                <x-jet-dropdown-link href="{{ route('profile.show') }}" class="px-6 text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <i class="fas fa-address-card"></i>
                    {{ __('Profile') }}
                </x-jet-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();" class="px-6 text-trueGray-500 hover:bg-orange-500 hover:text-white">
                        <i class="fas fa-sign-out-alt"></i>
                        {{ __('Log Out') }}
                    </x-jet-dropdown-link>
                </form>
            @else
                <x-jet-dropdown-link href="{{ route('login') }}" class="px-6 text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <i class="fas fa-user"></i>
                    {{ __('Login') }}
                </x-jet-dropdown-link>
                <x-jet-dropdown-link href="{{ route('register') }}" class="px-6 text-trueGray-500 hover:bg-orange-500 hover:text-white">
                    <i class="fas fa-edit"></i>
                    {{ __('Register') }}
                </x-jet-dropdown-link>
            @endauth
        </div>
    </nav>
</header>

