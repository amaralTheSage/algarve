<nav class="rounded-md  h-min shadow-sm text-text-dark text-center flex justify-around">
    <div class="w-full {{ Route::is('feed') ? 'bg-main-blue text-white' : '' }} px-4 py-1 rounded-sm ">
        <a href="{{ route('feed') }}" class="w-full ">
            <p class="text-base font-semibold">Feed</p>
        </a>
    </div>

    <div class="px-4 py-1 w-full  rounded-sm {{ Route::is('foryou') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('foryou') }}" class="w-full">
            <p class="text-base font-semibold">For You</p>
        </a>
    </div>

    <div class=" px-4 py-1 w-full  rounded-sm {{ Route::is('terms') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('terms') }}" class="w-full">
            <p class="text-base font-semibold">Terms</p>
        </a>
    </div>

    <div class=" px-4 py-1 w-full  rounded-sm {{ Route::is('settings') ? 'bg-main-blue text-white' : '' }}">
        <a href="{{ route('settings') }}" class="w-full">
            <p class="text-base font-semibold">Settings</p>
        </a>
    </div>
</nav>
