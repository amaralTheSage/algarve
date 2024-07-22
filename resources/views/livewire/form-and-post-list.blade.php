<section class="w-[48%]">
    <livewire:post-form>


        <div>
            @foreach ($posts as $post)
                <livewire:post :$post :key="$post->id">
            @endforeach
        </div>
</section>
