@props(['name'])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'p-2.5 bg-gray-50 w-[24rem] border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500',
]
@endphp


<select {{$attributes($defaults)}}>

    {{ $slot }}

</select>
