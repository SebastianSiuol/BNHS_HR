<x-welcome-layout>

    <x-slot:heading>Faculty Login</x-slot:heading>
    <div class="flex h-screen">

        <div class="flex-1">
            <img src="{{ asset('images/bhnhs_cover.jpg') }}" alt="landingPage_placeholder" class="w-full h-full">
        </div>

        <div class="fixed h-full items-center justify-center w-max-[300px]  lg:right-0">

            <div class="aside w-full h-full p-8 flex flex-col items-center justify-center">

                <!-- Logo -->
                <div class="w-45 h-45 rounded-full flex items-center justify-center mb-8">
                    <img src="{{ asset('images/bhnhs_logo.png') }}" class="w-full h-full object-cover">
                </div>


                <!-- Title -->
                <h2 class="mb-6 font-bold text-2xl text-center text-white">Log Into Your Account</h2>
                @if($errors->any())
                    <ul class="my-5">
                        @foreach($errors->all() as $error) @endforeach
                        <li class="text-red-500 italic font-bold">{{ $error }}</li>
                    </ul>
                @endif


                <!-- Form -->
                <form method="POST" action="/faculty/login" class="w-full admin-login-form">
                    @csrf
                    <!-- ADMIN ID -->
                    <div class="mt-4">
                        <label class="block text-gray-600 text-sm font-semibold mb-2 text-white" for="employee_id">Employee ID</label>
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="employee_id"
                            id="employee_id"
                            type="text"
                            required="required"
                            placeholder="Employee ID">
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-600 text-sm font-semibold mb-2 text-white" for="password">Password</label>
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="password"
                            id="password"
                            type="password"
                            autocomplete="off"
                            required="required"
                            placeholder="Password">
                    </div>

                    <div class="flex items-end mb-6 py-0">
                        <div class="ml-auto">
                            <a href="{{ route('auth.forgot-password.create') }}" class="text-sm text-black-500 hover:underline text-white">Forgot Password?</a>
                        </div>
                    </div>

                    <div class="mb-8">
                        <button id="submit-login-button"
                                type="submit"
                                class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Log In
                        </button>
                    </div>

                    <!-- Terms and Conditions -->
                    <p class="text-center text-gray-600 text-sm mt-4 text-white">
                        By using this service, you understand and agree to the Terms and Conditions of the system.
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin-login.js') }}"></script>
</x-welcome-layout>
