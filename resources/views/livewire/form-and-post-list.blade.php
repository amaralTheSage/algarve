<div>
    @if ($userId == Auth::id())
        <livewire:post-form>
    @endif


    <div>
        @foreach ($posts as $post)
            <livewire:post :$post :key="$post->id">
        @endforeach
    </div>
</div>
