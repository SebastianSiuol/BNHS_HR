@props(['admin'])

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $heading }}</title>
    <link rel="stylesheet" href={{ asset('css/admin.css') }}>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen">

{{-- Header --}}
<div class="px-3 py-2 lg:px-5 lg:pl-3">
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
            aria-controls="sidebar-multi-level-sidebar" type="button"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>


    <div class="flex items-center justify-end">
        <div class="flex items-center ms-3">

            <div>
                <button type="button"
                        class="text-sm bg-gray-200 rounded-lg pr-2 pl-1 py-1 inline-flex items-center space-x-4"
                        aria-expanded="false" data-dropdown-toggle="user-action">
                    <span class="sr-only">Open user menu</span>
                    <div>
                        <span class="font-semibold text-black">{{ $admin->personal_information->first_name . ' ' . $admin->personal_information->last_name }}</span>
                        <p class="text-gray-600 text-xs">administrator</p>
                    </div>
                    <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 9-7 7-7-7"/>
                    </svg>
                </button>
            </div>

            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                 id="user-action">
                <ul class="py-1">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 w-full hover:bg-gray-100">
                            My Account
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('faculty_logout') }}">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-sm text-red-700 w-full text-left hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

    {{-- Start of Sidebar --}}
    <x-admin-sidebar />
    {{-- End of Sidebar--}}

{{ $slot }}

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
