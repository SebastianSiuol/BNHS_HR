<x-welcome-layout>
    <x-slot:heading>Forgot Password</x-slot:heading>


    <div class="flex h-screen">

        <div class="flex-1">
            <img src="{{ asset('images/bhnhs_cover.jpg') }}" alt="landingPage_placeholder" class="w-full h-full">
        </div>

        <div class="fixed h-full bg-white items-center justify-center w-max-[600px] lg:right-0 w-[600px]">

            <div class="w-full h-full bg-gray-50 p-8 flex flex-col items-center justify-center">

                <!-- Logo -->
                <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                    <img src="{{ asset('images/bhnhs_logo.png') }}" class="w-full h-full">
                </div>



                <!-- Title -->
                <h2 class="mb-6 font-bold text-2xl text-center">Enter New Password</h2>
                @if($errors->any())
                    <ul class="my-5">
                        @foreach($errors->all() as $error) @endforeach
                        <li class="text-red-500 italic font-bold">{{ $error }}</li>
                    </ul>
                @endif


                <!-- Form -->
                <form method="POST" action="{{ route('auth.forgot-password.post') }}" class="w-full admin-login-form">
                    @csrf
                    <div class="mt-4">
                        <label class="block text-gray-600 text-sm font-semibold mb-2" for="password">Password</label>
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="password"
                            id="password"
                            type="text"
                            required="required"
                            placeholder="Password">
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-600 text-sm font-semibold mb-2" for="password_confirmation">Confirm Password</label>
                        <input
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            name="password_confirmation"
                            id="password_confirmation"
                            type="text"
                            required="required"
                            placeholder="Confirm Password">
                    </div>

                    <div class="my-8">
                        <button id="submit-login-button"
                                type="submit"
                                class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Submit
                        </button>
                    </div>

                    <div class="font-bold text-lg text-start">
                        <p> Your new password should:</p>
                        <ul>
                            <li class="text-red-800">- at least have a minimum of 8 characters</li>
                            <li class="text-red-800">- at least include one uppercase letter</li>
                            <li class="text-red-800">- at least have one special character.</li>
                        </ul>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-welcome-layout>
