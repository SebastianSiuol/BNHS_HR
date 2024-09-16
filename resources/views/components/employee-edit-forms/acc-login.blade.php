@props(['faculty'])

<div class="grid gap-4 mb-4 sm:grid-cols-1">
    <div>
        <x-forms.label label_name="Email" for="email" />
        <x-forms.input name="email" value="{{$faculty->email}}" />

    </div>
</div>
