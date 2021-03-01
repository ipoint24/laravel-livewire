<div>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel FileUploader (BitFumes)
            </h2>
            <h6>
                <a href="https://www.youtube.com/watch?v=YkeKBe8l-lk&list=PLe30vg_FG4OQ8b813BDykoYz95Zc3xUWK&index=22">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">
            <div class="flex">
                <form wire:submit.prevent="save">
                    <div class="flex w-full items-center justify-center bg-grey-lighter pb-2">
                        <label
                            class="flex flex-col items-center p-2 bg-indigo-500 text-gray-100 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-indigo-900 hover:text-white">
                            <span class="text-base leading-normal">Select a file</span>
                            <input type='file' class="hidden" wire:model="photos" multiple/>
                        </label>
                    </div>
                    @error('photos.*') <span class="error">{{ $message }}</span> @enderror

                    <button type="submit"
                            class="bg-indigo-500 text-gray-100 py-1 px-3 rounded shadow hover:bg-indigo-700">Save Photo
                    </button>
                </form>
            </div>
        </x-slot>
    </x-section.base>
</div>
