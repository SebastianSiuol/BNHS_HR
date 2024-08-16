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

        <!-- Sidebar -->
        <div class="fixed top-0 bottom-0 lg:right-0 w-[300px] bg-white">
            <div class="w-full h-full bg-gray-50 p-8 flex flex-col items-center justify-center">
                <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                    <img src="{{ asset('images/bhnhs_logo.png') }}" alt="landingPage_placeholder" class="w-full  h-full">
                </div>
                <h1 class="text-2xl font-bold mb-4">Welcome!</h1>
                <p class="mb-8">Please click or tap your destination.</p>
                <a href="/admin/login" class="w-full bg-blue-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-blue-600">Admin</a>
                <a href="/staff/login" class="w-full bg-red-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-red-600">Staff</a>

                <p class="text-center text-gray-500 text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </div>
        </div>
    </div>
</html>
