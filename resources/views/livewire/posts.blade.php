<section>

    @livewire('post-form')

    @foreach ($posts as $post)
        <div class="font-semibold px-4 py-4 my-3 rounded-md border-2 shadow-sm " x-data="{ comment: false }">
            <div>
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
                                {{-- DROPDOWN --}}
                                <div x-data="{ open: false }">
                                    <img src={{ asset('menu-icon.png') }} alt="" class="w-6 cursor-pointer"
                                        x-on:click="$dispatch('open-modal', {postId:{{ $post->id }}})" />
                                    <div x-show="open"
                                        x-on:open-modal.window="if($event.detail.postId === {{ $post->id }}) open=!open;"
                                        x-on:keydown.escape.window="open=false" x-on:click.outside="open=false"
                                        class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">


                                        <div class="flex gap-1 px-4 py-2 text-sm duration-150 rounded-md cursor-pointer"
                                            wire:click="deletePost({{ $post }}); open=false">
                                            <img src={{ asset('delete-icon.png') }} alt="Delete Post" class="w-5" />
                                            <span>Delete Post</span>
                                        </div>


                                    </div>
                                </div>
                                {{--  --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <p class="px-3 my-3">
                {{ $post->content }}
            </p>
            <div class="px-3 flex justify-between">
                <div class="flex gap-4">
                    <div class="flex gap-1 items-center text-sm">
                        @if (!Auth::user()->checkIfLikedPost($post))
                            <img src={{ asset('like-icon.png') }} alt=""
                                class="w-5 h-5 cursor-pointer icon-change"
                                wire:click="likePost({{ $post }})" />
                            <span>{{ $post->likes->count() }}</span>
                        @else
                            <img src={{ asset('liked-icon.png') }} alt=""
                                class="w-5 h-5 cursor-pointer icon-change"
                                wire:click="unlikePost({{ $post }})" />
                            <span>{{ $post->likes->count() }}</span>
                        @endif

                    </div>


                    <div class="flex gap-1 items-center text-sm">
                        <img src={{ asset('comment-icon.png') }} alt=""
                            class="w-5 h-5 cursor-pointer icon-change" x-on:click="comment=!comment" />
                        <span>{{ $post->comments->count() }}</span>
                    </div>
                </div>
                <div class="flex gap-1 items-center text-sm">
                    <img src={{ asset('clock-icon.png') }} alt="" class="w-5 h-5" />
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>

            @livewire('comments', [$post], key($post->id))
        </div>
    @endforeach
</section>
