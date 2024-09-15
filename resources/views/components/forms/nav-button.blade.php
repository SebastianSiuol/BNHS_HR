@props(['nav_type' => 'next'])

@php

    if ($nav_type === 'next')
    {
       $classes = 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800';
    }

    if ($nav_type === 'previous')
    {
        $classes = 'text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800';
    }

    $defaults = [
        'type' => 'button',
        'class' => $classes
]

@endphp

<button {{$attributes($defaults)}}>

    {{ $slot }}

</button>
