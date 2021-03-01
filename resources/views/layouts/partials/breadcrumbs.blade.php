<div class="pt-3 pb-1">
    <div class="container">
        <ol class="bg-gray-200 h-12 rounded-md flex p-3">
            @if(Breadcrumbs::has())
                @foreach (Breadcrumbs::current() as $crumbs)
                    @if ($crumbs->url() && !$loop->last)
                        <li class="mx-1">
                            <a class="mb-3 text-blue-600 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500"
                               href="{{ $crumbs->url() }}">
                                {{ $crumbs->title() }}
                            </a>
                            <span class="mx-1 text-xs"> <i class="fas fa-caret-right"></i> </span>
                        </li>
                    @else
                        <li class="">
                            <span
                                class="mb-3 capitalize text-teal-600 font-medium text-sm ">{{ $crumbs->title() }}</span>
                        </li>
                    @endif
                @endforeach
            @endif
        </ol>
    </div>
</div>
