@extends('Layouts.layout')

@section('title', $user->username)

@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">

        @include('Components.nav-bar')

        <div class="w-[48%] ">
            <div class="font-semibold px-4 py-4  rounded-md border-2 shadow-sm ">
                <div class="flex w-full justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src={{ $user->getImageUrl() }} alt="username"
                            class="w-24 aspect-square object-cover rounded-full" />
                        <div>
                            <p class="text-[20px]">{{ $user->display_name }}</p>
                            <p class="text-[18px] text-text-light">{{ $user->username }}</p>
                        </div>
                    </div>
                    <a href={{ route('users.edit', $user) }}><img src={{ asset('edit-icon.png') }} alt="edit profile"
                            class="w-6 mb-12" /></a>

                </div>
                <div class="px-3 my-3">
                    <h2 class="text-lg">About:</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut?
                    </p>
                </div>
                <div class="px-3 flex justify-between items-center mt-3">
                    <div class="flex gap-4 items-center ">
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('user-icon.png') }} alt="followers" class="w-5 h-5" />
                            <span>4 Followers</span>
                        </div>
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('comment-icon.png') }} alt="posts" class="w-4 h-4" />
                            <span>{{ $user->posts->count() }} Posts</span>
                        </div>
                    </div>
                    <button class="text-white bg-main-blue px-5 py-[2px] rounded-md">
                        Follow
                    </button>
                </div>
            </div>
            @if ($user->posts->count() > 0)
                <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
            @endif

            @foreach ($user->posts as $post)
                @include('Components.post-card')
            @endforeach

        </div>


        <div class="w-[26%] ">
            @include('Components.search-bar')
            @include('Components.who-to-follow')

        </div>
    </main>
@endsection
