@props(['for', 'label_name'])

@php
    $defaults = [
        'for' => $for,
        'class' => 'block mb-2 text-sm font-medium text-gray-900',
    ];
@endphp

<label {{$attributes($defaults)}}>

    {{ $label_name }}

</label>
