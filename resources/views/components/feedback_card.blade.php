@props(['type'])

@php

    $classes = 'session-alert relative float-right text-white rounded-lg p-2 m-2 ';

    if ($type == 'success') {
        $classes .= 'bg-green-500';
    } else {
        $classes .= 'bg-red-500';
    }

    $default = [
        'x-data' => '{show: true}',
        'x-init' => 'setTimeout(() => show = false, 3000)',
        'x-show' => 'show',
        'class' => $classes
    ]

@endphp


<div {{ $attributes($default) }}>
    {{ $slot  }}
</div>
