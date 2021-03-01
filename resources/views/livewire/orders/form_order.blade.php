<x-form.modal_simple>
    <x-slot name="title">
        Titel
    </x-slot>
    <form>
        <x-slot name="content">
            <div class="flex flex-col">
                <label class="leading-loose">Customer Name</label>
                <input
                    wire:model.debounce.500ms="customer_name"
                    type="text"
                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Required">
                @error('customer_name') <span class="text-red-500">{{ $message }}</span>@enderror
            </div>
            <div class="flex flex-col">
                <label class="leading-loose">Customer E-Mail</label>
                <input
                    wire:model.debounce.500ms="customer_email"
                    type="text"
                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Required">
                @error('customer_email') <span class="text-red-500">{{ $message }}</span>@enderror
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
