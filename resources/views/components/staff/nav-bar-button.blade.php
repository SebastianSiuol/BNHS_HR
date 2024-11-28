@props(['active' => false, ])

@php

    $active_link = 'font-bold border border-b-gray-900 border-b-2';
    $inactive_link = 'hover:font-bold transition-all duration-100';

    $active
    ? $classes = $active_link
    : $classes = $inactive_link;

    $defaults = [
        'class' => $classes
    ];


@endphp

<a {{ $attributes($defaults) }}>
    {{ $slot }}
</a>
