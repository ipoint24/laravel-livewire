@props([
'icon' => '',
'description' => '',
'text' => ''
])

<div {{ $attributes->merge(['class'=>'flex flex-row justify-left items-center'])}}>
    <div class="h6 px-2">
        <i class="h6 text-green-700 {{$icon}}"></i>
        <span class="mx-2">{{$text}}</span>
        <p class="mt-1 text-sm text-gray-600">
            {{$description}}
        </p>
    </div>
</div>



