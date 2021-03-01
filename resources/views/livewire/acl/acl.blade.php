<div>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laravel 8 User Roles and Permissions Tutorial
            </h2>
            <h6>
                <a href="https://www.itsolutionstuff.com/post/laravel-8-user-roles-and-permissions-tutorialexample.html">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">
            <div class="container mx-auto p-3 flex">
                <div class="bg-blue-100 p-3 mx-3 w-1/2">
                    @livewire('acl.users')
                </div>
                <div class="bg-green-100 p-3 w-1/2">
                    @livewire('acl.roles')
                </div>
            </div>
            <div class="container mx-auto p-3 w-full">
                <div class="bg-red-100 mx-3 p-3">
                    See User Roles and Permissions
                </div>
            </div>
        </x-slot>
    </x-section.base>
    <!-- Hero Section -->

</div>

