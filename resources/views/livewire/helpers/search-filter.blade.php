<div class="relative">
    <input
            type="text"
            class="form-input"
            placeholder="Search Data..."
            wire:model="searchTerm"
            wire:keydown.escape="resetValues"
            wire:keydown.tab="resetValues"
            wire:keydown.ArrowUp="decrementHighlight"
            wire:keydown.ArrowDown="incrementHighlight"
            wire:keydown.enter="selectOption"
    />

    <div wire:loading class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
        <div class="list-item">Searching...</div>
    </div>

    @if(!empty($searchTerm))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="resetValues"></div>

        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
            @if(!empty($options))

                @foreach($options as $i => $option)
                    <div wire:click="selectOption"
                         class="list-item {{ $highlightIndex === $i ? 'bg-red-100' : '' }}">{{$option->title}}</div>
                @endforeach
            @else
                <div class="list-item">No results!</div>
            @endif
        </div>
    @else
        <h1>Empty</h1>
    @endif
</div>