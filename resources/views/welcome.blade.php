<x-welcome-layout>

    <x-slot:heading>Batasan Hills National High School</x-slot:heading>

    <div class="flex h-screen">
        <img src="{{ asset('images/bhnhs_cover.jpg') }}" alt="landingPage_placeholder" class="w-full  h-full">

        <!-- Sidebar -->
        <div class="fixed top-0 bottom-0 lg:right-0 w-[300px] bg-white">
            <div class="w-full h-full bg-gray-50 p-8 flex flex-col items-center justify-center">
                <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                    <img src="{{ asset('images/bhnhs_logo.png') }}" alt="landingPage_placeholder"
                         class="w-full  h-full">
                </div>
                <h1 class="text-2xl font-bold mb-4">Welcome!</h1>
                <p class="mb-8">Please click or tap your destination.</p>
                <a href="/admin/login"
                   class="w-full bg-blue-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-blue-600">Admin</a>
                <a href="/staff/login"
                   class="w-full bg-red-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-red-600">Staff</a>

                <p class="text-center text-gray-500 text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </div>
        </div>

        @if( Session::has('success'))
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="absolute bg-green-500 text-white rounded-lg p-2 m-2 top-0 right-0"
            >
                {{ Session::get('success') }}
            </div>
        @elseif( Session::has('error') )

            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="absolute bg-green-500 text-white rounded-lg p-2 m-2 top-0 right-0"
            >
                {{ Session::get('error') }}
            </div>
        @endif
    </div>

</x-welcome-layout>
