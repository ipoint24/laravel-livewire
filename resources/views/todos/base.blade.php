<x-default-layout>
    <!-- Base-Section -->
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel Livewire | Create Todo App with Filtering, Sorting and Pagination
            </h2>
            <h6>
                <a href="https://thecodelearners.com/laravel-livewire-create-todo-app-with-filtering-sorting-and-pagination/">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">
            <div class="">
                @livewire('todos.todo-notification-component')
                <!-- This component will show notification when todo is saved or updated -->
                @livewire('todos.form-component') <!-- This component will display Todo form -->
            </div>
            <div class="">
                @livewire('todos.list-component') <!-- This component will list Todos -->
            </div>
        </x-slot>

    </x-section.base>
</x-default-layout>
