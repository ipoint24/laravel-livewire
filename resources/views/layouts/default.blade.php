<!doctype html>
<html lang="en">
@include('layouts.partials.head')
<body class="bg-gray-100">
@include('layouts.partials.navbar')
<!-- start wrapper -->
<div class="h-screen flex flex-row flex-wrap">
@include('layouts.partials.sidebar')
<!-- content -->
    <div class="bg-gray-100 flex-1 p-4 md:mt-16">
        @include('layouts.partials.breadcrumbs')
        @include('layouts.partials.flash')
        @livewire('notifications')
        <main>
            @include('layouts.partials.banner')

            {{$slot}}
        </main>
    </div>
</div>

@include('layouts.partials.footer')

</body>
</html>
