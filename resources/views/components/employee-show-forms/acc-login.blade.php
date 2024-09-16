@props(['faculty'])

<div class="bg-white border w-full border-blue-900 rounded-md shadow sm:p-8 p-6">

    <div class="space-y-4">
        <x-forms.form-heading>Account Login</x-forms.form-heading>

        <div class="grid grid-cols-2">
            <x-admin-show-label for=email>Email*</x-admin-show-label>
            <x-admin-show-input name=email id=email value="{{$faculty->email}}"/>
        </div>
    </div>

</div>
