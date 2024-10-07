@props(['type'])

<div x-data="{ show: false, message: '', type: '' }"
     x-show="show"
     x-init="document.addEventListener('flash-message', event => {
        show = true;
        message = event.detail.message;
        type = event.detail.type;
        setTimeout(() => show = false, 3000);
     })"
     class="session-alert relative float-right text-white rounded-lg p-2 m-2"
     style="display: none;">
<span x-text="message"></span>

</div>
