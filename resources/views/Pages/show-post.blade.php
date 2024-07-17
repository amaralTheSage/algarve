@extends('Layouts.layout')

@section('title', $post->content)


@section('content')
    <main class="w-[85%] m-auto flex gap-6 justify-between mt-4">
        @include('Components.nav-bar')

        <div class="w-[48%]">
            <section class="mt-3">
                <div class="font-semibold px-4 py-4 my-3 rounded-md border-2 shadow-sm ">
                    <div>
                        <div class="flex w-full justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <img src={{ $post->user->getImageUrl() }} alt="username"
                                    class="w-14 aspect-square object-cover rounded-full" />
                                <div>
                                    <p class="text-[18px]">{{ $post->user->display_name }}</p>
                                    <p class="text-[16px] text-text-light">{{ $post->user->username }}</p>
                                </div>
                            </div>
                            <div class="relative mb-7">
                                @if (Auth::id() === $post->user_id)
                                    <img src={{ asset('menu-icon.png') }} alt="" class="w-7 " />
                                    {{-- @include('Components.post-options') --}}
                                @endif
                            </div>
                        </div>
                    </div>

                    <p class="px-3 my-3">
                        {{ $post->content }}
                    </p>
                    <div class="px-3 flex justify-between">
                        <div class="flex gap-4">
                            <div class="flex gap-1 items-center text-sm">
                                <img src={{ asset('like-icon.png') }} alt="" class="w-5 h-5" />
                                <span>4</span>
                            </div>
                            <div class="flex gap-1 items-center text-sm">
                                <img src={{ asset('comment-icon.png') }} alt="" class="w-5 h-5" />
                                <span>13</span>
                            </div>
                        </div>
                        <div class="flex gap-1 items-center text-sm">
                            <img src={{ asset('clock-icon.png') }} alt="" class="w-5 h-5" />
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>






                    <form action={{ route('comments.store', $post) }} method="POST"
                        class="rounded-md border-2 flex flex-col items-end px-3 pt-2 mt-3 pb-3 shadow-sm">
                        @csrf
                        @method('post')

                        <textarea name="comment-input" rows={3} class="w-full focus:outline-none overflow-hidden resize-none bg-ice"
                            placeholder="Leave a comment"></textarea>

                        <button type="submit"
                            class="text-white bg-main-blue rounded-md py-[6px] mt-1 w-20 text-sm font-medium ">
                            Comment
                        </button>
                    </form>



                    @if ($post->comments->count() > 0)
                        <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
                    @endif


                    @foreach ($post->comments as $comment)
                        @include('Components.comment-card')
                    @endforeach
                </div>
        </div>

        </section>
        </div>

        <div class="w-[26%] ">
            @include('Components.search-bar')
            @include('Components.who-to-follow')
        </div>
    </main>
@endsection
