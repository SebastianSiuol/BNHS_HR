<x-welcome-layout>

    <x-slot:heading>Batasan Hills National High School</x-slot:heading>

    <div class="flex h-screen">

        <div class="flex-1">
            <img src="{{ asset('images/bhnhs_cover.jpg') }}" alt="landingPage_placeholder" class="w-full h-full">
        </div>

        <!-- Sidebar -->
        <div class="aside fixed h-full w-max-[300px] lg:right-0">
            <div class="w-full h-full  p-8 flex flex-col items-center justify-center">
                <div class="w-45 h-45 rounded-full flex items-center justify-center mb-8">
                    <img src="{{asset('images/bhnhs_logo.png')}}" alt="Logo" class="w-full h-full object-cover" />
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Welcome!</h1>
                <p class="mt-5 mb-5 text-white">Please click or tap your destination.</p>
                <a href="{{ route('faculty.login') }}" class="w-full bg-red-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-red-600">Employee</a>

                <p class="text-center text-white text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </div>
        </div>
    </div>

    {{-- Feedback Card --}}
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
</x-welcome-layout>
