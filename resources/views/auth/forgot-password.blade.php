<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <title>Batasan Hills National Highschool</title>
</head>
<body class="h-full font-poppins bg-[#f4f6f9]">


<div class="flex py-2 px-16 justify-between bg-[#163172] text-white">

    <div class="flex space-x-2 items-center justify-center">
        <img src="{{ asset('images/bhnhs_logo.png') }}" class="h-[42px]" alt="bhnhs_logo"/>
        <h3 class="font-bold text-xl">Batasan Hills National Highschool</h3>
    </div>

</div>

<main class="flex flex-col mx-auto my-20 max-w-[1280px]">

    <h2 class="mb-6 font-bold text-2xl text-center text-gray-800">Reset your Password</h2>

    @if($errors->any())
        <ul class="mx-auto my-5">
            @foreach($errors->all() as $error) @endforeach
            <li class="text-red-500 italic font-bold">{{ $error }}</li>
        </ul>
    @endif

    <div class="mx-auto bg-white p-4 border border-gray-400 rounded-xl shadow-lg">

        <!-- Form -->
        <form method="POST" action="{{ route('auth.forgot-password.store') }}" class="w-auto">
            @csrf
            <div class="mt-4">
                <label class="block text-gray-600 text-sm font-semibold mb-2" for="email">Employee Email</label>
                <input
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    name="email"
                    id="email"
                    type="text"
                    required="required"
                    placeholder="Employee Email">
            </div>

            <div class="my-8">
                <button id="submit-login-button"
                        type="submit"
                        class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Send Code
                </button>
            </div>

            <a href="{{ route('faculty_login') }}" class="block text-center text-blue-900 hover:text-blue-400"> Sign In Instead</a>

        </form>
    </div>

    @if( Session::has('status'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
             class="absolute bg-green-500 text-white rounded-lg p-2 m-2 top-20 right-10"
        >
            {{ Session::get('status') }}
        </div>
    @endif
</main>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
