<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('mountain-white.png') }}">
    <title>Are you sure? | {{ config('app.name') }}</title>

    @vite('resources/css/app.css')
</head>


<body class="bg-white">
    <main class="lg:w-1/3 md:w-1/2 mx-4 md:m-auto shadow-lg h-screen px-16 py-7 bg-[#e2e8ea]">
        <h1 class="text-xl m-auto w-fit mb-5">Are you sure you want to ban this user?</h1>
        <div class="flex flex-col items-center gap-5">
            <img src="{{ $user->getImageURL() }}" alt="" class="rounded-full w-60">
            <h2 class="text-2xl font-semibold">&#64;{{ $user->username }}</h2>
        </div>


        <div class="text-centerfont-medium text-lg my-8">
            <h2>This action: </h2>
            <ol class="px-4">
                <li class=" text-red-600 ">
                    cannot be undone;
                </li>
                <li class=" text-red-600 ">
                    will result in the complete erasure of all tweets by &#64;{{ $user->username }}
                </li>

            </ol>
        </div>

        <nav class="flex justify-center items-center gap-4 text-lg text-white font-semibold">
            <a href="{{ route('users.show', $user) }}"
                class="rounded-md bg-main-blue py-3 w-[120px] text-center">Cancel</a>

            <form method="POST" action="{{ route('users.destroy', $user) }}">
                @method('DELETE')
                @csrf

                <button class="rounded-md bg-red-600 py-3 w-[120px] text-center">Ban</button>
            </form>
        </nav>
    </main>
</body>

</html>
