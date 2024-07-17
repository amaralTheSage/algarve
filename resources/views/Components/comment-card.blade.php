<div class="w-[92%] m-auto my-5">
    <div class="flex  justify-between items-center">
        <a href={{ route('users.show', [$comment->user]) }} class="w-full">
            <div class="flex gap-3 items-center">
                <img src={{ $comment->user->getImageUrl() }} alt="username"
                    class="w-12 aspect-square object-cover rounded-full" />
                <div>
                    <p class="text-[16px]">{{ $comment->user->display_name }}</p>
                    <p class="text-[14px] text-text-light">{{ $comment->user->username }}</p>
                </div>
            </div>
        </a>
        <div class="relative mb-7">
            @if (Auth::id() === $comment->user_id)
                <img src={{ asset('menu-icon.png') }} alt="" class="w-6" />
                {{-- @include('Components.post-options') --}}
            @endif

        </div>
    </div>
    <p class="px-1 my-1 text-sm">
        {{ $comment->content }}
    </p>
    <div class="flex justify-between px-1">
        <div class="flex gap-1 items-center text-sm">
            <img src={{ asset('like-icon.png') }} alt="" class="w-5 h-5" />
            <span>4</span>
        </div>
        <div class="flex gap-1 items-center text-sm">
            <img src={{ asset('clock-icon.png') }} alt="" class="w-5 h-5" />
            <span>{{ $comment->created_at->diffForHumans() }}</span>
        </div>
    </div>
</div>
