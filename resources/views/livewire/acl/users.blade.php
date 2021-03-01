<div>

    <button wire:click="create()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-4 rounded mt-4">
        Create New User
    </button>
    <table class="table-auto w-full text-left">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20 border">No.</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">E-Mail</th>
            <th class="px-4 py-2 border">Roles</th>
            <th class="px-4 py-2 border w-40 ">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
        @foreach($users as $user)
            <tr>
                <td class="border px-4 py-2">{{$user->id}}</td>
                <td class="border px-4 py-2">
                    <div>
                        <span>{{$user->name}}</span>
                        @if(auth()->user()->id <> $user->id and auth()->user()->hasRole(3))
                            <a wire:click="impersonate({{$user->id}})" href="#" class="text-xs text-indigo-600">IMP</a>
                        @endif
                    </div>
                </td>
                <td class="border px-4 py-2">{{$user->email}}</td>
                <td class="border px-4 py-2">

                    @if(!empty($user->getRoleNames()))
                        <ol>
                            @foreach($user->getRoleNames() as $v)
                                <li>{{ $v }}</li>
                            @endforeach
                        </ol>
                    @endif
                </td>
                <td class="border px-4 py-2">
                    <div class="inline-block whitespace-no-wrap">
                        <button wire:click="edit({{ $user->id }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                            <i class="fas fa-edit"></i>
                        </button>
                        @if($confirming===$user->id)
                            <button wire:click="delete({{ $user->id  }})"
                                    class="bg-red-800 text-white w-32 px-2 py-1 hover:bg-red-600 rounded border">
                                Sure?
                            </button>
                        @else
                            <button
                                wire:click="confirmDelete({{ $user->id }})"
                                class="bg-gray-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </div>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {{ $users->links('components.section.pagination',['is_livewire' => true]) }}

    @if($isOpen)
        <x-form.modal_simple>
            <x-slot name="title">
                {{$modalTitle}}
            </x-slot>
            <form>
                <x-slot name="content">
                    <div class="flex flex-col">
                        <label class="leading-loose">Name</label>
                        <input
                            wire:model.debounce.500ms="name"
                            type="text"
                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                            placeholder="Optional">
                        @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose">E-Mail</label>
                        <input
                            wire:model.debounce.500ms="email"
                            type="text"
                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                            placeholder="Optional">
                        @error('email') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>

                </x-slot>
                <x-slot name="actions">
                    <button
                        wire:click="closeModal()"
                        class="text-gray-500 bg-transparent border border-solid border-gray-500 hover:bg-gray-500 hover:text-white active:bg-gray-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                        style="transition: all .15s ease">
                        Close
                    </button>
                    <button
                            wire:click.prevent="store()"
                            class="text-gray-200 bg-teal-600 border hover:bg-gray-500 hover:text-white active:bg-teal-900 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1"
                            type="button"
                            style="transition: all .15s ease">
                        Save Changes
                    </button>
                </x-slot>
            </form>
        </x-form.modal_simple>
@endif
<!-- Hero Section -->


</div>
