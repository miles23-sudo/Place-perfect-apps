<x-mail::message>
# Hello {{ $user->name }},

### Account Password Reset

Your password has been reset successfully. <br>
You can now log in using the following credentials:
<x-mail::panel>
**Email:** {{ $user->email }}<br>
**Password:** {{ $raw_password }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
