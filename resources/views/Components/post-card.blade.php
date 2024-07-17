<div class="font-semibold px-4 py-4 my-3 rounded-md border-2 shadow-sm ">
    <a href={{ route('posts.show', $post) }}>
        <div>
            <div class="flex w-full justify-between items-center">
                <a href={{ route('users.show', $post->user) }} class="w-full">
                    <div class="flex gap-3 items-center">
                        <img src={{ $post->user->getImageUrl() }} alt="username"
                            class="w-14 aspect-square object-cover rounded-full" />
                        <div>
                            <p class="text-[18px]">{{ $post->user->display_name }}</p>
                            <p class="text-[16px] text-text-light">{{ $post->user->username }}</p>
                        </div>
                    </div>
                </a>
                <div class="relative mb-7">
                    @if (Auth::id() === $post->user_id)
                        <img src={{ asset('menu-icon.png') }} alt="" class="w-7 " />
                        {{-- @include('Components.post-options') --}}
                    @endif
                </div>
            </div>
        </div>
    </a>

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
    @if ($post->comments->count() > 0)
        <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
    @endif

    @foreach ($post->comments as $comment)
        @include('Components.comment-card')
    @endforeach
</div>
