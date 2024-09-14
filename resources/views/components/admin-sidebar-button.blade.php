@props(['active' => false, 'type' => 'top'])
@php

    $active_classes = 'text-gray-900 bg-gray-100';
    $inactive_classes = 'transition-all duration-300 hover:bg-gray-100 hover:text-black';

@endphp

@if($type == 'top')

    <a {{ $attributes }}
       class="flex ml-5 mb-1 p-2 items-center rounded-lg
       {{ $active ? $active_classes : $inactive_classes}}">
        {{$slot}}
    </a>

@elseif($type == 'sub')

    <a {{ $attributes }}
       class="flex items-center w-full p-2 transition duration-75 rounded-lg pl-11
       {{ $active ? $active_classes : $inactive_classes}}">
        {{$slot}}
    </a>

@endif

<!-- Similarity for top-links: flex ml-5 mb-1 p-2 items-center rounded-lg group -->
<!-- Active Top-link: text-gray-900 bg-gray-100 -->
<!-- Inactive Top-link: transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 -->

<!-- similarity for sub-links: flex items-center w-full p-2 transition duration-75 rounded-lg pl-11 group dark:hover:bg-gray-700 dark:text-gray-400 -->
<!-- Active Sub-link: hover:bg-gray-100 bg-gray-100 text-gray-900 -->
<!-- Inactive Sub-link: text-white hover:bg-gray-100 hover:text-gray-900 -->



