<x-default-layout>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel Livewire: Parent-Child Form Example
            </h2>
            <h6>

            </h6>
        </x-slot>
        <x-slot name="bottom">
            <div class="flex flex-wrap content-start">
                <div class="w-1/2 overflow-scroll py-24">
                    @livewire('orders')
                </div>
                <div class="w-1/2 overflow-scroll py-24">
                    @livewire('products')
                </div>
            </div>
        </x-slot>
    </x-section.base>
</x-default-layout>>
