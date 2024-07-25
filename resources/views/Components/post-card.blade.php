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
                            <p class="text-[16px] text-text-light">&#64;{{ $post->user->username }}</p>
                        </div>
                    </div>
                </a>
                <div class="relative mb-7">
                    @if (Auth::id() === $post->user_id)
                        {{-- DROPDOWN --}}
                        <div x-data="{ open: false }">
                            <img src={{ asset('menu-icon.png') }} alt="" class="w-6 cursor-pointer" x-data
                                x-on:click="$dispatch('open-modal', {postId:{{ $post->id }}})" />

                            <div x-show="open"
                                x-on:open-modal.window="if($event.detail.postId === {{ $post->id }}) open=!open; console.log($event.detail.postId)"
                                x-on:keydown.escape.window="open=false" x-on:click.outside="open=false"
                                class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div>
                                    <div class="flex gap-1 px-4 py-2 text-sm duration-150 rounded-md cursor-pointer"
                                        wire:click="deletePost({{ $post }}); open=false">
                                        <img src="delete-icon.png" alt="Delete Post" class="w-5" />
                                        <span>Delete Post</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  --}}
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
