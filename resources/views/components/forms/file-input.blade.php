@props(['name'])

@php

    $defaults = [
        'id' => $name,
        'name' => $name,
        'type' => 'file',
        'class' => 'block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none',
]

@endphp
<input {{ $attributes($defaults) }}>
