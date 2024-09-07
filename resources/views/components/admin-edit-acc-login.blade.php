@props(['faculty'])

<div class="grid gap-4 mb-4 sm:grid-cols-1">
    <div>
        <x-admin-form-label for="email">
            Email
        </x-admin-form-label>
        <x-admin-form-input type="email" name="email" id="email" value="{{$faculty->email}}">
            name@gmail.com
        </x-admin-form-input>

    </div>
</div>
