<section class="w-full border-2  rounded-lg leading-tight shadow-sm hidden md:block ">
    <div class="bg-main-blue text-white rounded-t-md  font-semibold px-3 py-2">
        <h3>Who to Follow</h3>
        <p class="font-normal">Connect with other users</p>
    </div>


    <div>
        @foreach ($who_to_follow as $user)
            <a href="{{ route('users.show', $user->id) }}">
                <div class="font-semibold px-4 py-3 flex gap-3 items-center">
                    <img src={{ $user->getImageURL() }} alt="{{ $user->username }}'s profile image"
                        class="w-10 aspect-square object-cover rounded-full" />
                    <div>
                        <p class="text-[14px]">{{ $user->display_name }}</p>
                        <p class="text-[12px] text-text-light">&#64;{{ $user->username }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>


</section>
