<nav class="rounded-md border-2 py-4  w-[26%] h-min shadow-sm text-text-dark">
    <div class="{{ Route::is('feed') ? 'bg-main-blue text-white' : '' }} px-4 py-1">
        <a href="{{ route('feed') }}" class="w-full ">
            <p class="text-base font-semibold">Feed</p>
            <p class="text-sm text-text-light {{ Route::is('feed') ? ' text-white' : '' }}">All of the websites
                content
            </p>
        </a>
    </div>

    <div class="px-4 py-1 {{ Route::is('foryou') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('foryou') }}" class="w-full">
            <p class="text-base font-semibold">For You</p>
            <p class="text-sm text-text-light {{ Route::is('foryou') ? ' text-white' : '' }}">
                Only the people you follow
            </p>
        </a>
    </div>

    <div class=" px-4 py-1 {{ Route::is('terms') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('terms') }}" class="w-full">
            <p class="text-base font-semibold">Terms</p>
        </a>
    </div>

    <div class=" px-4 py-1 {{ Route::is('settings') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('settings') }}" class="w-full">
            <p class="text-base font-semibold">Settings</p>
        </a>
    </div>
</nav>
