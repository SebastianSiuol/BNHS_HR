<div class="flex py-4 justify-center bg-[#d6e4f0]">
    <nav class="text-lg items-center space-x-16">
        <x-staff.nav-bar-button href="{{ route('staff.index') }}" :active="request()->is('staff/home')">Home</x-staff.nav-bar-button>
        <x-staff.nav-bar-button href="{{ route('staff.leave.index') }}" :active="request()->is('staff/leave*')">Leave Request</x-staff.nav-bar-button>
        <x-staff.nav-bar-button href="{{ route('staff.rpms.index') }}" :active="request()->is('staff/rpms*')">RPMS</x-staff.nav-bar-button>
    </nav>
</div>
