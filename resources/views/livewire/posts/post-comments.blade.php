<div>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel Livewire Component Data Share (Bitfumes)
            </h2>
            <h6>
                <a href="https://www.youtube.com/watch?v=vhoqp5QkP_8&list=PLe30vg_FG4OQ8b813BDykoYz95Zc3xUWK&index=15">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">
            <div class="flex justify-center">
                <div class="w-full my-4 flex">
                    <div class="w-6/12 rounded border p-2">
                        <livewire:posts/>
                    </div>
                    <div class="w-6/12 mx-2 rounded border p-2">

                        <section class="pt-3 pb-3">
                            <input type="file" id="image" wire:change="$emit('fileChoosen')">
                        </section>
                        <form class="" wire:submit.prevent="addComment">
                            <div>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-xs text-red-500">
                                @error('newComment'){{$message}}@enderror
                            </div>
                            <input
                                type="text"
                                class="w-2/3 rounded border shadow p-2 mr-2 my-2"
                                placeholder="Whats in your mind"
                                wire:model.debounce.500ms="newComment"
                            >
                            <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
                            @foreach($comments as $comment)
                                <div class="rounded border shadow p-3 my-2">
                                    <div class="flex justify-between my-2">
                                        <div class="flex">
                                            <p class="font-bold text-lg">{{$comment->user->name}}[{{$comment->post_id}}
                                                ]</p>
                                            <p class="mx-3 py1 text-xs text-gray-500 font-semibold">{{ $comment->dateForHumans($comment->created_at) }}</p>
                                        </div>
                                        <p class="flex justify-end my-2 text-xs text-red-200 hover:text-red-600">
                                            <i class="fas fa-times cursor-pointer"
                                               wire:click="remove({{$comment->id}})"></i>
                                        </p>
                                    </div>
                                    <div class="flex">
                                        @if($comment->image)
                                            <div class="p-3">
                                                <img
                                                    class="shadow rounded-full w-20 h-auto align-middle border-gray-900"
                                                    src="{{$comment->imagePath}}"
                                                />
                                            </div>
                                        @endif
                                        <p class="text-gray-800">{{$comment->body}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                        <div class="">
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-section.base>
</div>

@section('scripts')
    <script>
        window.livewire.on('fileChoosen', () => {
            let inputField = document.getElementById('image');
            let file = inputField.files[0];
            let reader = new FileReader();
            reader.onloadend = () => {
                window.livewire.emit('fileUpload', reader.result);
            }
            reader.readAsDataURL(file);
        })
    </script>
@endsection

