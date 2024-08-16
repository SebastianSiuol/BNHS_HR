<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elmwood Elementary School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main_index.css">
</head>

<body class="m-0">
<div class="flex h-screen">

    <img src="{{ asset('images/bhnhs_cover.jpg') }}" alt="landingPage_placeholder" class="w-full  h-full">

    <div class="fixed top-0 bottom-0 items-center justify-center lg:right-0 w-[300px] bg-white">

        <!-- Logo -->
        <div class="w-full h-full bg-gray-50 p-8 flex flex-col items-center justify-center">
            <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                <img src="{{ asset('images/bhnhs_logo.png') }}" alt="landingPage_placeholder" class="w-full  h-full">
            </div>
            <!-- Title -->
            <h2 class="text-2xl font-bold mb-6 text-center">Log Into Your Account</h2>
            @if($errors->any())
                <ul class="my-5">
                    @foreach($errors->all() as $error) @endforeach
                    <li class="text-red-500 italic font-bold">{{ $error }}</li>
                </ul>
            @endif
            <!-- Form -->
            <form method="POST" action="/admin/login" class="w-full">
                @csrf
                <!-- Staff ID -->
                <div class="mb-4 py-2">
                    <label class="block text-gray-600 text-sm font-semibold mb-2" for="staff_id">Admin ID</label>
                    <input
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        name="admin_id"
                        id="admin_id"
                        type="text"
                        placeholder="Admin ID">
                </div>
                <div class="mb-0">
                    <label class="block text-gray-600 text-sm font-semibold mb-2" for="password">Password</label>
                    <input
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="Password">
                </div>
                <div class="flex items-end mb-6 py-0">
                    <div class="ml-auto">
                        <a href="#" class="text-sm text-black-500 hover:underline">Forgot Password?</a>
                    </div>
                </div>
                <div class="mb-8">
                    <button type="submit"
                       class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Log In
                    </button>
                </div>
                <!-- Terms and Conditions -->
                <p class="text-center text-gray-600 text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </form>
        </div>
    </div>
</div>
</body>

</html>
