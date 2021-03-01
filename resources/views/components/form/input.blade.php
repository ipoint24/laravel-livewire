@props([
'disabled' => false,
'id' => '',
'name' => '',
'type' => 'text',
'placeholder' => ''
])
<div {{ $attributes->merge(['class' => 'rounded-md shadow-sm']) }}>
    <input
        {{$disabled ? 'disabled' : '' }}
        type="{{ $type }}"
        {{ $attributes->merge(['class' => 'bg-white border border-gray-200 py-2 px-3 rounded-lg w-full block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5']) }}
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
    />
</div>
