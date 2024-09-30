<x-admin-layout :admin="$admin">

    <x-slot:heading>Company Details</x-slot:heading>

    <main class="block h-full p-4 sm:ml-80">
        <div class="flex items-center pb-8">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5" stroke="currentColor" class="w-9 h-9 text-blue-900">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <h1 class="text-3xl text-blue-900 font-bold ml-2">Company</h1>
        </div>

        <div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">
            <form id="Form" action="#">

                <x-forms.form-heading>
                    Company Details
                </x-forms.form-heading>

                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-forms.label for="company_name" label_name="Company Name"/>
                        <x-forms.input name="company_name" placeholder="Company Name" required/>
                    </div>
                    <div>
                        <x-forms.label for="contact_number" label_name="Contact Number"/>
                        <x-forms.input name="contact_number" placeholder="09 xxx xxx xxx" required/>
                    </div>
                    <div>
                        <x-forms.label for="email" label_name="Email"/>
                        <x-forms.input name="email" placeholder="company@example.com" required/>
                    </div>

                    <div>
                        <x-forms.label for="website_url" label_name="Website URL"/>
                        <x-forms.input name="website_url" placeholder="example.domain" required/>
                    </div>
                    <div>
                        <x-forms.label for="company_address" label_name="Company Address"/>
                        <x-forms.input name="company_address" placeholder="Company Address" required/>
                    </div>
                    <div>
                        <x-forms.label for="city" label_name="City"/>
                        <x-forms.input name="city" placeholder="City" required/>
                    </div>

                    <div>
                        <x-forms.label for="state" label_name="State"/>
                        <x-forms.input name="state" placeholder="State" required/>
                    </div>
                    <div>
                        <x-forms.label for="postal_code" label_name="Postal Code"/>
                        <x-forms.input name="postal_code" placeholder="Postal Code" required/>
                    </div>
                    <div>
                        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 ">Country</label>
                        <select id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected disabled>Country</option>
                            <option value="1">Philippines</option>
                        </select>
                    </div>
                </div>

                <div class="flex items center justify-center mt-10">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center">
                        Save
                    </button>
                </div>

            </form>
        </div>

    </main>
</x-admin-layout>
