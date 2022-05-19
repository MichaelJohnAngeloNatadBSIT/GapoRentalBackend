@component('mail::message')
# Reset Password
Reset or change your password.

@component('mail::button', ['url' => 'http://localhost:8100/change-password?token='.$token])
Change Password
@endcomponent
Thanks,<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
