<x-admin.layout>

    <x-slot:heading>Company Details</x-slot:heading>

    <x-admin.main_container>
        <x-admin.page-header>
            Company Details
        </x-admin.page-header>

        <x-admin.nooutline-content-card>
                @if($detailsEmpty)
                    <form method='POST' action="{{ route('admin.config.company_details.store') }}">
                    @method('POST')
                @else
                    <form method='POST' action="{{ route('admin.config.company_details.update') }}">
                    @method('PATCH')
                @endif
                @csrf

                <x-forms.form-heading>
                    Company Details
                </x-forms.form-heading>

                @if($errors->any())
                    <ul class="my-5">
                        @foreach($errors->all() as $error) @endforeach
                        <li class="text-red-500 italic font-bold">{{ $error }}</li>
                    </ul>
                @endif

            @if($detailsEmpty)
                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                    <div>
                        <x-forms.label for="company_name" label_name="Company Name"/>
                        <x-forms.input name="company_name" placeholder="Company Name" required />
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
                        <x-forms.label for="country" label_name="Country"/>
                        <select id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                            <option selected disabled>Country</option>
                            <option value="Philippines">Philippines</option>
                        </select>
                    </div>
                </div>
            @else
                <div class="grid gap-4 mb-4 sm:grid-cols-3 edit-company">
                    <div>
                        <x-forms.label for="company_name" label_name="Company Name"/>
                        <x-forms.input name="company_name" disabled required value="{{ $companyDetails->name }}"/>
                    </div>
                    <div>
                        <x-forms.label for="contact_number" label_name="Contact Number"/>
                        <x-forms.input name="contact_number" disabled required value="{{ $companyDetails->contact_number }}"/>
                    </div>
                    <div>
                        <x-forms.label for="email" label_name="Email"/>
                        <x-forms.input name="email" disabled required value="{{ $companyDetails->email }}"/>
                    </div>
                    <div>
                        <x-forms.label for="website_url" label_name="Website URL"/>
                        <x-forms.input name="website_url" disabled required value="{{ $companyDetails->url }}"/>
                    </div>
                    <div>
                        <x-forms.label for="company_address" label_name="Company Address"/>
                        <x-forms.input name="company_address" disabled required value="{{ $companyDetails->address }}"/>
                    </div>
                    <div>
                        <x-forms.label for="city" label_name="City"/>
                        <x-forms.input name="city" disabled required value="{{ $companyDetails->city }}"/>
                    </div>
                    <div>
                        <x-forms.label for="state" label_name="State"/>
                        <x-forms.input name="state" disabled required value="{{ $companyDetails->state }}"/>
                    </div>
                    <div>
                        <x-forms.label for="postal_code" label_name="Postal Code"/>
                        <x-forms.input name="postal_code" disabled required value="{{ $companyDetails->postal_code }}"/>
                    </div>
                    <div>
                        <x-forms.label for="country" label_name="Country"/>
                        <x-forms.input name="country" disabled required value="{{ $companyDetails->country }}"/>
                    </div>
                </div>
            @endif

                @if($detailsEmpty)
                <div class="flex items center justify-center mt-10">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center">
                        Save
                    </button>
                </div>
                @else
                <div class="flex gap-x-6 justify-end mt-10">
                    <button id="edit-company-details"
                            type="button"
                            class="text-white bg-blue-700 font-medium rounded-lg text-sm px-20 py-2.5 text-end hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Edit
                    </button>
                    <button id="patch-company-details"
                            type="submit"
                            class="hidden text-white bg-green-700 font-medium rounded-lg text-sm px-20 py-2.5 text-end hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                        Save
                    </button>
                </div>
                @endif
            </form>
        </x-admin.nooutline-content-card>

        @if( Session::has('success'))
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="session-alert relative bg-green-500 float-right text-white rounded-lg p-2 m-2"
            >
                {{ Session::get('success') }}
            </div>
        @elseif( Session::has('error') )

            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="session-alert relative bg-red-500 float-right text-white rounded-lg p-2 m-2"
            >
                {{ Session::get('error') }}
            </div>
        @endif

    </x-admin.main_container>

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <script src="{{ asset('js/admin/company_details.js') }}"></script>
</x-admin.layout>
