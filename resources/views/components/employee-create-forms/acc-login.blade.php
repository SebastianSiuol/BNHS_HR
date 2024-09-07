<div class="validate-acc-txt-inputs grid gap-4 mb-4 sm:grid-cols-2">
    <div>
        <x-admin-form-label for="email">
            Email
        </x-admin-form-label>
        <x-admin-form-input type="email" name="email" id="email" placeholder="name@gmail.com" value="{{ old('email') }}"/>

    </div>
    <div>
        <x-admin-form-label for="password">
            Password
        </x-admin-form-label>
        <x-admin-form-input type="password" name="password" id="password" placeholder="********"/>
    </div>
</div>
