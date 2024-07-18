 <div>
     @auth
         <form wire:submit="createPost" method="POST"
             class="rounded-md border-2 flex flex-col items-end px-3 pt-2 pb-3 shadow-sm">
             @csrf
             @method('post')

             <textarea wire:model="post_input" rows={3} class="w-full focus:outline-none overflow-hidden resize-none bg-ice"
                 placeholder="What are you thinking about?"></textarea>

             <button type="submit" class="text-white bg-main-blue rounded-md py-1 mt-1 w-20 text-sm font-medium ">
                 Post
             </button>
         </form>
     @endauth
     @guest
         <h3 class="text-2xl font-semibold">Log in to share your thoughts!</h3>
     @endguest
 </div>
