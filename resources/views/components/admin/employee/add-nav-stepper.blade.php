@props(['active_number' => 0, 'stepper_number'])

@php

    $li_classes = "flex items-center space-x-2.5 rtl:space-x-reverse rounded-full shrink-0";
    $span_classes = "flex items-center justify-center w-8 h-8 border rounded-full shrink-0";


    if($active_number === $stepper_number){
        $li_classes .= ' text-blue-600 dark:text-blue-500';
        $span_classes .= ' border-blue-600 dark:border-blue-500';
    } else {
        $li_classes .= ' text-gray-500 dark:text-gray-400';
        $span_classes .= ' border-gray-500 dark:border-gray-400';
    }

@endphp


<li class="{{ $li_classes }}">

    <span class="{{ $span_classes }}">
        {{ $stepper_number }}
    </span>
    <span>
        <h3 class="font-medium leading-tight">
            {{$slot}}
        </h3>
    </span>
</li>


{{-- Active li:   text-blue-600 dark:text-blue-500  --}}
{{-- Inactive li: text-gray-500 dark:text-gray-400  --}}
{{-- similar attributes for li: flex items-center space-x-2.5 rtl:space-x-reverse rounded-full shrink-0 --}}

{{-- Active span:    border-blue-600 dark:border-blue-500 --}}
{{-- Inactive span:  border-gray-500 dark:border-gray-400 --}}
{{-- similar attributes for span: flex items-center justify-center w-8 h-8 border rounded-full shrink-0 --}}
