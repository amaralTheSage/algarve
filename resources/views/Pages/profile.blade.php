@extends('Layouts.layout')

@section('title', '@' . $user->username)

@section('content')
    <main class="w-[85%] m-auto md:flex gap-6 justify-between mt-4">

        @include('Components.nav-bar')

        <section class="md:w-[48%]">
            <div class="md:hidden ">
                @include('Components.nav-bar-mobile')
                @livewire('search')
            </div>



            <div class="font-semibold md:p-4  rounded-md md:border-2 shadow-sm ">
                <div class="border-2 md:border-none p-2 md:p-0 rounded-md">
                    <div class="flex w-full justify-between items-center ">
                        <div class="flex gap-3 items-center">
                            <img src={{ $user->getImageURL() }} alt="username"
                                class="w-24 aspect-square object-cover rounded-full" />
                            <div>
                                <p class="text-[20px]">{{ $user->display_name }}</p>
                                <p class="text-[18px] text-text-light">&#64;{{ $user->username }}</p>
                            </div>
                        </div>


                        <nav class="flex mb-12 mt-4 gap-3 mr-2 items-center">


                            @can('user_or_admin', ['user' => $user])
                                <a href={{ route('users.delete', $user->id) }}><img src={{ asset('delete-user.png') }}
                                        alt="delete user" class="w-6 " />
                                    <p class="text-xs flex justify-center">Kill</p>
                                </a>
                            @endcan


                            @if (Auth::id() === $user->id)
                                <a href={{ route('users.edit', $user) }}><img src={{ asset('edit-icon.png') }}
                                        alt="edit profile" class="w-6" />
                                    <p class="text-xs flex justify-center">Edit</p>
                                </a>
                            @endcan
                    </nav>
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
        </div>



        @if ($user->posts->count() > 0 || $user->id == Auth::id())
            <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
        @endif

        @if ($user->posts->count() === 0)
            <h2 class="p-3 font-medium text-lg">{{ $user->username }} hasn't shared anything yet :(
            </h2>
        @endif

        <livewire:form-and-post-list page="profile" userId="{{ $user->id }}" />
    </section>



    <div class="md:w-[26%] hidden md:block">
        @livewire('search')

        @include('Components.who-to-follow')
    </div>
</main>
@endsection
