<section class="relative">
    <h2 class="font-semibold text-lg">Find your friends</h2>
    <div class="flex justify-between border-2 rounded-md py-1 px-2 h-8  text-sm font-medium w-full">
        <input type="text" name="search" wire:model.live.debounce.500ms="search"
            class="bg-ice focus:outline-none w-full" placeholder="Search by @username" />
        <img src={{ asset('search-icon.png') }} alt="">
        {{-- <button class="bg-main-blue rounded-md text-sm font-medium h-8 px-4 text-white ">
            Search
        </button> --}}
    </div>

    @if ($search)
        <div class="border shadow-md rounded-md absolute bg-ice w-[290px] right-8  mt-2">
            @foreach ($users as $user)
                <div class="font-semibold px-4 py-3 flex justify-between items-center">
                    <div class="flex gap-3 items-center">
                        <img src={{ $user->getImageUrl() }} alt="username"
                            class="w-10 aspect-square object-cover rounded-full" />
                        <div>
                            <p class="text-[14px]">{{ $user->display_name }}</p>
                            <p class="text-[12px] text-text-light">{{ $user->username }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</section>
