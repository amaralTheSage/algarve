@extends('Layouts.layout')

@section('title', '@' . $user->username)

@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <div class="w-[48%] ">
            <form method="post" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}"
                class="font-semibold px-4 py-4  rounded-md border-2 shadow-sm ">
                @method('patch')
                @csrf

                <div class="flex w-full justify-between items-center">
                    <div class="flex justify-between w-full items-center mx-3">
                        <img src={{ $user->getImageUrl() }} alt="{{ $user->username }}'s image"
                            class="w-24 aspect-square object-cover rounded-full mr-8" />

                        <div class="text-text-light w-min">
                            <input
                                class="focus:outline-none overflow-hidden bg-ice p-2 text-[20px] border rounded-md mb-2 w-[300px] h-10"
                                value="{{ $user->display_name }}" name="display_name-input" />
                            @error('display_name-input')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <div class="flex items-center">
                                <span class="text-2xl ">@</span>
                                <input
                                    class="focus:outline-none h-10 overflow-hidden bg-ice p-2 text-[18px] border rounded-md w-[300px]"
                                    value="{{ $user->username }}" name="username-input" />
                            </div>
                            @error('username-input')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <input type="file" name="image-input" class="mt-4 mx-3">
                @error('image-input')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <div class="px-3 my-3">
                    <h2 class="text-lg">About:</h2>

                    <textarea name="bio-input" rows="5"
                        class="w-full focus:outline-none overflow-hidden resize-none border rounded-md shadow-sm bg-ice p-2"
                        placeholder="Tell us about yourself">{{ $user->bio }}</textarea>
                    @error('bio-input')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>
                <form class="px-3 flex justify-between items-center mt-3">
                    <div class="flex gap-4 items-center ">
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('user-icon.png') }} alt="followers" class="w-5 h-5" />
                            <span>{{ $user->followers->count() }} Followers</span>
                        </div>
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('comment-icon.png') }} alt="posts" class="w-4 h-4" />
                            <span>{{ $user->posts->count() }} Posts</span>
                        </div>
                    </div>

                    <button class="text-white bg-main-blue px-4 py-[4px] mt-2 rounded-md">
                        Save
                    </button>

                </form>
        </div>





        </div>


        <div class="w-[26%] ">
            @livewire('search')
            @include('Components.who-to-follow')

        </div>
    </main>
@endsection
