<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('mountain-white.png') }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    @vite('resources/css/app.css')
</head>


<body>
    <header
        class="flex {{ Auth::check() ? '' : 'flex-col' }} md:flex-row items-center gap-3 justify-between mx-10 py-3 px-10 border-b-2 font-semibold text-lg ">
        <a href="/" class="flex items-center gap-2 hover:text-main-blue icon-change">
            <img src={{ asset('temp-icon.png') }} alt="nome" class=" w-8 sm:w-12 my-0 h-6 object-cover " />
            <h1 class="mt-1 text-lg sm:text-xl ">Algarve</h1>
        </a>


        @auth
            <div class="relative" x-data="{ show: false }">
                <div class="flex items-center gap-2 hover:text-main-blue cursor-pointer" x-data
                    x-on:click="$dispatch('handle-modal')">
                    <img src={{ Auth::user()->getImageURL() }} alt="username"
                        class="w-10 aspect-square object-cover rounded-full" />
                    <span class="hidden md:block">{{ Auth::user()->display_name }}</span>
                </div>


                <div x-show="show" x-on:handle-modal.window="show=!show" x-on:keydown.escape.window="show=false"
                    x-on:click.outside="show=false"
                    class="absolute right-0 z-10 mt-[13px] w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <nav>
                        <a href={{ route('users.show', Auth::user()) }} x-on:click="show=false"
                            class="text-text-dark block px-4 pb-2 pt-3 rounded-t-md text-sm hover:bg-main-blue hover:text-white duration-150">
                            Profile
                        </a>
                        <form action={{ route('auth.logout') }} method="post"
                            class="text-text-dark block px-4 pt-2 pb-3 rounded-b-md text-sm hover:bg-main-blue hover:text-white duration-150">
                            @csrf
                            @method('post')
                            <button>Log out</button>
                        </form>
                    </nav>
                </div>


            </div>
        @endauth

        @guest
            <nav class="text-md flex items-center gap-4 ">
                <a href="/login" class="hover:text-main-blue {{ Route::is('login') ? ' text-main-blue' : '' }}">Login</a>
                <a href="/signup" class="hover:text-main-blue {{ Route::is('signup') ? ' text-main-blue' : '' }}">Sign
                    Up</a>
            </nav>
        @endguest

    </header>

    @yield('content')
</body>

</html>
