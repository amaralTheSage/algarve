@extends('Layouts.layout')

@section('title', '@' . $user->username)

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
                            <p class="text-[18px] text-text-light">&#64;{{ $user->username }}</p>
                        </div>
                    </div>

                    @if (Auth::id() === $user->id)
                        <a href={{ route('users.edit', $user) }}><img src={{ asset('edit-icon.png') }} alt="edit profile"
                                class="w-6 mb-12" /></a>
                    @endif

                </div>
                @if ($user->bio)
                    <div class="px-3 my-3">
                        <h2 class="text-lg">About:</h2>
                        <p>
                            {{ $user->bio }}
                        </p>
                    </div>
                @endif

                <div class="px-3 flex justify-between items-center mt-3">
                    <div class="flex gap-4 items-center my-2">
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('user-icon.png') }} alt="followers" class="w-5 h-5" />
                            <span>{{ $user->followers->count() }} Followers</span>
                        </div>
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('comment-icon.png') }} alt="posts" class="w-4 h-4" />
                            <span>{{ $user->posts->count() }} Posts</span>
                        </div>
                    </div>

                    @if (Auth::id() !== $user->id)


                        @if (!Auth::user()->checkIfAlreadyFollows($user))
                            <form action={{ route('users.follow', $user) }} method="post">
                                @csrf
                                @method('post')
                                <button class="text-white bg-main-blue px-4 py-[4px] rounded-md">
                                    Follow
                                </button>
                            </form>
                        @else
                            <form action={{ route('users.unfollow', $user) }} method="post">
                                @csrf
                                @method('delete')
                                <button class="text-white bg-[#a0a0a0] px-4 py-[4px] rounded-md">
                                    Unfollow
                                </button>
                            </form>
                        @endif
                    @endif



                </div>
            </div>
            @if ($user->posts->count() > 0 || $user->id == Auth::id())
                <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
            @endif

            <livewire:form-and-post-list page="profile" userId="{{ $user->id }}" />
        </div>


        <div class="w-[26%] ">
            @livewire('search')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
