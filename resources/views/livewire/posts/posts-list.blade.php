<div>
    <h1 class="text-3xl">Posts</h1>
    @foreach($posts as $post)
        <div class="rounded border shadow p-3 my-2 {{$active == $post->id ? 'bg-gray-400':''}}"
             wire:click="$emit('postSelected',{{$post->id}})">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="font-bold text-lg">
                        {{$post->title}} [{{$post->id}}]
                        @if(count($post->comments)>0)
                            <span
                                class="bg-blue-400 text-white mx-3 pl-1 pr-1 text-center rounded shadow">{{count($post->comments)}}</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex">
                <p class="text-gray-800">{{$post->body}}</p>
            </div>
        </div>
    @endforeach
    <div class="">
        {{ $posts->links() }}
    </div>
</div>
