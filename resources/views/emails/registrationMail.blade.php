@component('mail::message')
<h2>Dear {{$maildata['name']}},</h2>
<p>You are registered as {{ $maildata['type'] }}, your email address is <b>{{ $maildata['email'] }}</b> and your password is <b>{{ $maildata['password'] }}</b>.</p>
<p>DO NOT share your password with anyone. Make sure that the password for your  {{ config('app.name') }} account and the email address used for registration are unique and secure to ensure that your account is protected. Avoid using a common password for your other accounts to ensure that your account is protected at all times.</p>
<p>For login please click on the link below </p>

@component('mail::button', ['url' => route('login')])
Click to Login
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
