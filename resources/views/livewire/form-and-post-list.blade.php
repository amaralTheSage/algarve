<div>
    @if ($userId == Auth::id())
        <livewire:post-form>
    @endif


    <div>
        @foreach ($posts as $post)
            <livewire:post :$post :key="$post->id">
        @endforeach
        <div x-intersect="$wire.morePosts()"></div>
    </div>
</div>
