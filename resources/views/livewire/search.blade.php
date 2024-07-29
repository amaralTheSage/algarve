<section class="relative mb-2">
    <div class="grid grid-cols-2 my-4 md:block items-center">
        <h2 class="font-semibold text-lg w-fit">Find your friends</h2>
        <div class="flex justify-between border-2 rounded-md py-1 px-2  h-8  text-sm font-medium w-full">
            <input type="text" name="search" wire:model.live.debounce.200ms="search"
                class="bg-ice focus:outline-none w-full " placeholder="Search by @username" />
            <img src={{ asset('search-icon.png') }} alt="">

        </div>
    </div>

    @if ($search)
        <div class="border shadow-md rounded-md absolute bg-ice w-[290px] right-8  mt-2">
            @foreach ($users as $user)
                <a href="{{ route('users.show', $user) }}">
                    <div class="font-semibold px-4 py-3 flex justify-between items-center">
                        <div class="flex gap-3 items-center">
                            <img src={{ $user->getImageURL() }} alt="username"
                                class="w-10 aspect-square object-cover rounded-full" />
                            <div>
                                <p class="text-[14px]">{{ $user->display_name }}</p>
                                <p class="text-[12px] text-text-light">&#64;{{ $user->username }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            @if ($users->count() === 0)
                <p class="font-semibold px-4 py-3">no users found :(</p>
            @endif
        </div>
    @endif

</section>
