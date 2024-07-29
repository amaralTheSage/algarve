@extends('Layouts.layout')

@section('title', '@' . $user->username)

@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <section class="md:w-[48%] m-auto">
            <form method="post" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}"
                class="font-semibold py-4 rounded-md border-2 shadow-sm px-6">
                @method('patch')
                @csrf

                <div class="flex w-full justify items-center">
                    <div class="flex flex-col lg:flex-row w-full items-center mx-3">
                        <div class="flex flex-col items-center my-4 gap-2">
                            <img src={{ $user->getImageURL() }} alt="{{ $user->username }}'s image"
                                class="w-24 aspect-square object-cover rounded-full mr-8 " />

                            <div class="lg:hidden block">
                                <input type="file" name="image-input" class="mt-4 mx-3">
                                @error('image-input')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        <div class="w-full ">
                            <div class="w-4/5 m-auto">
                                <label for="display_name-input" class="block w-fit">Display Name:</label>
                                <input
                                    class="focus:outline-none overflow-hidden text-text-light bg-ice  p-2 text-[20px]  border-b-2 mb-2 h-10"
                                    value="{{ $user->display_name }}" name="display_name-input" id="display_name-input" />
                                @error('display_name-input')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="w-4/5 m-auto">
                                <label for="username-input">Username:</label>
                                <div class="flex items-center text-text-light border-b-2 w-fit">
                                    <span class="text-2xl">@</span>
                                    <input class="focus:outline-none h-10 overflow-hidden bg-ice  p-2 text-[18px] "
                                        value="{{ $user->username }}" name="username-input" />
                                </div>
                                @error('username-input')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <input type="file" name="image-input" class="mt-4 mx-3">
                    @error('image-input')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div class=" my-3">
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

            </form>
        </section>



        <div class="md:w-[26%] hidden md:block">
            @livewire('search')

            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
