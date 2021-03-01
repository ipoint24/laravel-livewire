<div>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Posts (Laravel 8 Livewire CRUD with Jetstream & Tailwind CSS - ItSolutionStuff.com)
            </h2>
            <h6>
                <a href="https://www.itsolutionstuff.com/post/laravel-8-livewire-crud-with-jetstream-tailwind-cssexample.html">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">
            <button wire:click="create()"
                    class="bg-indigo-400 hover:bg-indigo-700 text-gray-200 py-1 px-3 rounded my-3">
                Create New Post
            </button>
            @if($isOpen)
                @include('livewire.posts.form_post')
            @endif
            <table class="table-auto w-full text-left">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20 border">No.</th>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Body</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border w-40 ">Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                @foreach($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ $post->id }}</td>
                        <td class="border px-4 py-2">{{ $post->title }}</td>
                        <td class="border px-4 py-2">{{ $post->body }}</td>
                        <td class="border px-4 py-2">{{ $post->user->name }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $post->id }})"
                                    class="bg-indigo-500 hover:bg-indigo-700 text-gray-100 py-1 px-3 rounded">
                                <i class="fas fa-edit "></i>
                            </button>
                            <button wire:click="delete({{ $post->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-gray-100 py-1 px-3 rounded">
                                <i class="fas fa-trash "></i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div>
                {{ $posts->links() }}
            </div>
        </x-slot>
    </x-section.base>
</div>

