<div>
    <form x-show="comment" wire:submit="createComment({{ $post->id }})" method="POST"
        class="rounded-md border-2 flex flex-col items-end px-3 pt-2 mt-3 pb-3 shadow-sm">
        @csrf
        @method('post')

        <textarea wire:model="comment_input" rows={3} class="w-full focus:outline-none overflow-hidden resize-none bg-ice"
            placeholder="Leave a comment"></textarea>

        <button type="submit" x-on:click="comment=false"
            class="text-white bg-main-blue rounded-md py-[6px] mt-1 w-20 text-sm font-medium ">
            Comment
        </button>
    </form>

    @if ($post->comments->count() > 0)
        <div class="my-4 bg-gray-200 w-full h-[3px]"></div>
    @endif




    {{-- COMMENTS --}}
    <div>
        @foreach ($post->comments as $comment)
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
                            {{-- DROPDOWN --}}
                            <div x-data="{ open: false }">
                                <img src={{ asset('menu-icon.png') }} alt=""
                                    class="w-6 cursor-pointer icon-change"
                                    x-on:click="$dispatch('open-modal', {commentId:{{ $comment->id }}})" />
                                <div x-show="open"
                                    x-on:open-modal.window="if($event.detail.commentId === {{ $comment->id }}) open=!open;"
                                    x-on:keydown.escape.window="open=false" x-on:click.outside="open=false"
                                    class="absolute right-0 z-10 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">


                                    <div class="flex gap-1 px-4 py-2 text-sm duration-150 rounded-md cursor-pointer"
                                        wire:click="deleteComment({{ $comment }}); open=false">
                                        <img src={{ asset('delete-icon.png') }} alt="Delete Post" class="w-5" />
                                        <span>Delete Comment</span>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                        @endif

                    </div>
                </div>
                <p class="px-1 my-1 text-sm">
                    {{ $comment->content }}
                </p>
                <div class="flex justify-between px-1">
                    <div class="flex gap-1 items-center text-sm">
                        @if (!Auth::user()->checkIfLikedComment($comment))
                            <img src={{ asset('like-icon.png') }} alt=""
                                class="w-5 h-5 cursor-pointer icon-change"
                                wire:click="likeComment({{ $comment }})" />
                            <span>{{ $comment->likes->count() }}</span>
                        @else
                            <img src={{ asset('liked-icon.png') }} alt=""
                                class="w-5 h-5 cursor-pointer icon-change"
                                wire:click="unlikeComment({{ $comment }})" />
                            <span>{{ $comment->likes->count() }}</span>
                        @endif
                    </div>


                    <div class="flex gap-1 items-center text-sm">
                        <img src={{ asset('clock-icon.png') }} alt="" class="w-5 h-5 " />
                        <span>{{ $comment->created_at->diffForHumans() }}</span>


                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
