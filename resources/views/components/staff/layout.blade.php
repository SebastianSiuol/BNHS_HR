@props(['with_nav' => true])

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Batasan Hills National Highschool</title>
</head>
<body class="h-screen font-poppins bg-gray-100">

{{-- HEADER --}}
<div class="flex py-2 px-16 justify-between bg-[#163172] text-white">
    <a href="{{ route('staff.index') }}">

        <div class="flex space-x-2 items-center justify-center">
            <img src="{{ asset('images/bhnhs_logo.png') }}" class="h-[42px]" alt="bhnhs_logo"/>
            <h3 class="font-bold text-xl">Batasan Hills National Highschool</h3>
        </div>
    </a>


    <div class="flex space-x-12 items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5"
             stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
        </svg>


        <button class="items-center space-x-4 hidden lg:flex" data-dropdown-toggle="faculty_account">
            <div>
                <h6 class="font-bold">{{ $logged_user->personal_information->generateFullName() }}</h6>
                <p class="text-normal text-end">Faculty</p>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>
        </button>

        {{-- Dropdown menu --}}
        <div id="faculty_account" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-gray-700 dark:text-gray-200">
                <li>
                    <a href="{{ route('staff.person.info.index') }}" class="block px-4 py-2 hover:bg-gray-100">Employee
                        Information</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                </li>
                <li>
                    <form id="faculty_logout" method="POST" action="{{ route('faculty_logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                            Sign out
                        </button>
                    </form>

                </li>
            </ul>
        </div>

    </div>
</div>

{{-- Second Row --}}
@if($with_nav)
    <x-staff.nav-bar/>
@endif


<main class="flex mx-auto max-w-[1280px] my-20 justify-center">
    {{ $slot }}
</main>


<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
