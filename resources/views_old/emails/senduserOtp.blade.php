@component('mail::message')
<h1>Your Login OTP Code</h1>

<p>We have received a request to log in to your account. Use the OTP below to complete the login process:</p>

@component('mail::panel')
    <h2>{{ $userOtp }}</h2>
@endcomponent



<p>Thank you,</p>
<p>{{ config('app.name') }} Team</p>
@endcomponent
