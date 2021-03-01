<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if (session()->has('message'))
        <div id="alert" class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="inline-block align-middle mr-8">
                {{ session('message') }}
            </span>
            <button
                class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none"
                onclick="document.getElementById('alert').remove();">
                <span>×</span>
            </button>
        </div>
    @endif
    <div class="px-6 py-4 bg-gray-200">
        {{App\Models\User::count()}}
        {{ Auth::user()->roles->pluck('name') }}
    </div>
        <!-- Test -->

        <!-- Ende Test -->
        <button wire:click="create()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-10">
            Create New Company
        </button>
        <p>
            @livewire('helpers.search-filter',['model' => 'App\Models\Company','searchField' => 'title'])
        </p>
        <!--
        <x-input.select2multiple wire:model="selectedTenants" id="selectedTenants" name="selectedTenants[]"
                                 :options="$tenants" select-type="label"/>
         -->
        @if (count($companies)>0)
        <div class="py-10">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                            {{ __('Title') }}
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                            {{ __('Desc') }}
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-black bg-black text-left text-xs font-semibold text-white uppercase tracking-wider">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td class="px-5 py-5 bg-white text-sm border-gray-200 border-b ">
                                {{ Str::limit($company->title, 25) }}
                            </td>
                            <td class="px-5 py-5 bg-white text-sm border-gray-200 border-b ">
                                {{ Str::limit($company->description, 200) }}
                            </td>
                            <td class="px-5 py-5 bg-white text-sm border-gray-200 border-b text-right">
                                <div class="inline-block whitespace-no-wrap">
                                    <button wire:click="edit({{ $company->id }})"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Edit
                                    </button>
                                    @if($confirming===$company->id)
                                        <button wire:click="delete({{ $company->id  }})"
                                                class="bg-red-800 text-white px-4 py-2 hover:bg-red-600 rounded border">
                                            Sure?
                                        </button>
                                        <button
                                            wire:click="cancelDelete({{ $company->id }})"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Cancel
                                        </button>
                                    @else
                                        <button
                                            wire:click="confirmDelete({{ $company->id }})"
                                            class="bg-gray-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $companies->links('components.section.pagination',['is_livewire' => true]) }}
            </div>
        </div>
    @endif
    @if($isOpen)
        <x-form.modal_simple>
            <x-slot name="title">
                Titel
            </x-slot>
            <form>
                <x-slot name="content">
                    <div class="flex flex-col">
                        <label class="leading-loose">Title</label>
                        <input
                            wire:model.debounce.500ms="title"
                            type="text"
                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                            placeholder="Optional">
                        @error('title') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex flex-col">
                        <label class="leading-loose">Description</label>
                        <textarea
                            wire:model.debounce.500ms="description"
                            cols="40"
                            rows="8"
                            class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                            placeholder="Optional">
                        </textarea>
                        @error('description') <span class="text-red-500">{{ $message }}</span>@enderror
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
                        class="text-teal-500 background-transparent border-solid border-teal-500 font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1"
                        type="button"
                        style="transition: all .15s ease">
                        Save Changes
                    </button>
                </x-slot>
            </form>
        </x-form.modal_simple>
    @endif
</div>

