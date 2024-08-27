@props(['active' => false])

<a {{ $attributes }}
   class="flex items-center w-full p-2 group

   {{ $active ? 'pl-11 ml-5 mb-1 text-gray-900 rounded-lg bg-gray-100'
              : 'pl-11 text-base transition duration-75 rounded-lg hover:bg-gray-100 hover:text-gray-900 dark:text-white dark:hover:bg-gray-700'}}"

>
    {{$slot}}
</a>


{{--flex items-center transition duration-75 rounded-lg group--}}



