<x-mail::message>
# Password Reset Request

You requested a password reset. Click the button below to reset your password.

<x-mail::button :url="$temp_url">
Reset Your Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
