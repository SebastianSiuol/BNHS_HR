<x-staff.layout>


{{-- bg-[#f8f8f4]--}}
    <div class="flex-grow min-h-full pt-10 pb-20 px-5 h-full bg-[#f8f8f4] border rounded-lg">
        <h3 class="text-blue-800 text-3xl font-bold"> Hello, John Doe </h3>
        <x-divider />

        <div class="px-20">
            <h1 class="text-4xl ">Announcements</h1>

            <div class="grid grid-cols-0 lg:grid-cols-2 gap-4 mt-8 px-6">
                <x-staff.announcement-card />
                <x-staff.announcement-card />
                <x-staff.announcement-card />
                <x-staff.announcement-card />
            </div>
        </div>
    </div>


</x-staff.layout>
