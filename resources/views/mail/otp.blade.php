<x-mail::message>
# OTP Verification

Your one-time password (OTP) code is:

@component('mail::panel')
**{{ $otpCode }}**
@endcomponent

Please use this code to verify your email address. Kindly note that the code will expire in 24 hours.

If you didn't request this verification, please ignore this message.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
