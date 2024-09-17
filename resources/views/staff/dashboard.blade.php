<x-staff.layout>


    <x-staff.content-panel>
        <h3 class="text-blue-800 text-3xl font-bold"> Hello, John Doe </h3>
        <x-divider/>

        <div class="px-20">
            <h1 class="text-4xl ">Announcements</h1>

            <div class="grid grid-cols-0 lg:grid-cols-2 gap-4 mt-8 px-6">
                <x-staff.announcement-card/>
                <x-staff.announcement-card/>
                <x-staff.announcement-card/>
                <x-staff.announcement-card/>
            </div>
        </div>
    </x-staff.content-panel>


</x-staff.layout>
