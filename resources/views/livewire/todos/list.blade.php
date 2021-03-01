<div>
    <x-section.base>
        <x-slot name="top">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Posts (Laravel 8 Livewire CRUD with Jetstream & Tailwind CSS - ItSolutionStuff.com)
            </h2>
            <h6>
                <a href="https://www.itsolutionstuff.com/post/laravel-8-livewire-crud-with-jetstream-tailwind-cssexample.html">Quelle</a>
            </h6>
        </x-slot>
        <x-slot name="bottom">

            <div wire:loading wire:init="loadList">
                {{ $loading_message }}
            </div>


            <div class="filter-container">
                <h2>Filter</h2>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Search Title</label>
                        <input type="text" class="form-control" wire:model="filter.search">
                    </div>

                    <div class="col-md-2">
                        <label for="">Status</label>
                        <select wire:model="filter.status" class="form-control">
                            <option value="">Choose One</option>
                            <option value="pending">Task Pending</option>
                            <option value="accomplished">Task Accomplished</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="">Order Field</label>
                        <select wire:model="filter.order_field" class="form-control">
                            <option value="">Choose One</option>
                            <option value="title">Task Title</option>
                            <option value="status">Task Status</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="">Order Type</label>
                        <select wire:model="filter.order_type" class="form-control">
                            <option value="">Choose One</option>
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                    </div>

                    <div class="col-md-2" style="display: flex;align-items: flex-end;">
                        <div>
                            <button type="button" wire:click="loadList" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <table class="table-auto w-full text-left">
                    <thead>
                    <tr>
                        <th class="px-4 py-2 border-r w-2/3">Title</th>
                        <th class="px-4 py-2 border-r">Status</th>
                        <th class="px-4 py-2 border-r">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600">

                    @if(!empty($objects))
                        @foreach($objects as $k => $v)
                            <tr>
                                <td class="border border-l-0 px-4 py-2">
                                    <div>
                                        <p>{{$v->id}}<strong>Title:</strong> {{ $v["title"] }}</p>
                                        <p><strong>Description:</strong> {{ $v["desc"] }}</p>
                                    </div>
                                </td>
                                <td>
                                    @if($v["status"]=="pending")
                                        Pending
                                    @endif

                                    @if($v["status"]=="accomplished")
                                        Accomplished
                                    @endif
                                </td>
                                <td>
                                    <div class="flex">
                                        <button type="button" class="btn btn-info p-2"
                                                wire:click="$emitTo('todos.form-component', 'edit', {{ $v['id'] }})">
                                            Edit
                                        </button>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-danger p-2">Remove</button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No Tasks found.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>


            <div class="pagination-container">
                <ul class="pagination">
                    <li class="page-item
                            @if($page == 1)
                        disabled
        @endif
                        ">
                        <a class="page-link" href="javascript:void(0)"
                           wire:click="applyPagination('previous_page', {{ $page-1 }})">
                            Previous
                        </a>
                    </li>

                    <li class="page-item
                            @if($page == $paginator['last_page'])
                        disabled
        @endif

                        ">
                        <a class="page-link" href="javascript:void(0)"
                           @if($page <= $paginator['last_page'])
                           wire:click="applyPagination('next_page', {{ $page+1 }})"
                            @endif
                        >
                            Next
                        </a>
                    </li>

                    <li class="page-item" style="margin: 0 5px">
                        Jump to Page
                    </li>

                    <li class="page-item" style="margin: 0 5px">
                        <select class="form-control" title="" style="width: 80px" wire:model="page">
                            @for($i=1;$i<=$paginator['last_page'];$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </li>

                    <li class="page-item" style="margin: 0 5px">
                        Items Per Page
                    </li>

                    <li class="page-item" style="margin: 0 5px">
                        <select class="form-control" title="" style="width: 80px" wire:model="items_per_page"
                                wire:change="loadList">
                            <option value="5">05</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                    </li>
                </ul>
            </div>
        </x-slot>
        </x-slot>
    </x-section.base>
</div>

