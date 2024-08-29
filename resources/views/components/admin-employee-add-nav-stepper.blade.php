@props(['active' => false])


<li class="flex items-center space-x-2.5 rtl:space-x-reverse rounded-full shrink-0
    {{$active ? 'text-blue-600 dark:text-blue-500' : 'text-gray-500 dark:text-gray-400' }}">

    <span class="flex items-center justify-center w-8 h-8 border rounded-full shrink-0
    {{$active ? 'border-blue-600 dark:border-blue-500' : 'border-gray-500 dark:border-gray-400'}}">
        {{ $number }}
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
