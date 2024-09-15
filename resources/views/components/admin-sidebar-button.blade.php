@props(['active' => false, 'type' => 'top'])
@php

    $classes = 'flex items-center rounded-lg ';

    if($type === 'top')
        $classes .= 'ml-5 mb-1 p-2 ';

    if($type === 'sub')
        $classes .= 'w-full p-2 pl-11 transition duration-75 ';


    $active_link = 'text-gray-900 bg-gray-100 ';
    $inactive_link = 'transition-all duration-300 hover:bg-gray-100 hover:text-black ';

    $active
    ? $classes .= $active_link
    : $classes .= $inactive_link;

    $defaults = [
        'class' => $classes,
    ];

@endphp

<a {{ $attributes($defaults) }}>
    {{ $slot }}
</a>

{{-- Similarity for top-links: flex ml-5 mb-1 p-2 items-center rounded-lg group --}}
{{-- Active Top-link: text-gray-900 bg-gray-100 --}}
{{-- Inactive Top-link: transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 --}}

{{-- similarity for sub-links: flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group dark:hover:bg-gray-700 dark:text-gray-400 --}}
{{-- Active Sub-link: hover:bg-gray-100 bg-gray-100 text-gray-900 --}}
{{-- Inactive Sub-link: text-white hover:bg-gray-100 hover:text-gray-900 --}}



