@props([
'top' => '',
'bottom' => ''
])
<div class="report-card">
    <div class="card">
        <div class="card-body flex flex-col">
            {{$top}}
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                        {{$bottom}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


