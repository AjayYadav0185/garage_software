@component('mail::message')
{{-- Main Header --}}
<div style="text-align: center; padding: 20px 0; background: #f5f5f5; border-radius: 8px;">
    <img src="{{ asset('logo1.png') }}" alt="Logo" style="width: 60px; display: inline-block; margin-bottom: 10px;">
    <img src="{{ asset('carr.webp') }}" alt="Garage Management" style="width: 60px; display: inline-block; margin-bottom: 10px;">
    <h1 style="color: #202039; font-size: 26px; margin-top: 10px;">Garage Management</h1>
</div>

{{-- Greeting --}}
<h3 style="color: #202039; margin-top: 30px;">{{ translate('Hello') }} {{ $notifiable->name ?? 'there' }},</h3>

{{-- Main Body --}}
<p style="font-size: 16px; line-height: 1.6; color: #555;">
    {{ translate('We received a request to reset your password. If you made this request, you can reset your password by clicking the button below.') }}
</p>

{{-- Reset Button --}}
@component('mail::button', ['url' => $resetUrl, 'color' => 'primary'])
   {{ translate('Reset Password') }}
@endcomponent

{{-- Expiration Notice --}}
<p style="font-size: 14px; line-height: 1.6; color: #777;">
    {{ translate('This password reset link will expire in 60 minutes. If you did not request a password reset, please ignore this email. Your password will remain unchanged.
') }}
</p>

{{-- Footer Section --}}
<p style="font-size: 14px; color: #777; text-align: center; margin-top: 40px;">
   {{ translate(' If you have any problems, please reach out to us directly at') }} <a href="mailto:support@yourdomain.com" style="color: #0171d3;">{{ translate('support@yourdomain.com') }}</a>
</p>

{{-- Salutation --}}
<p style="font-size: 14px; color: #202039; text-align: center; margin-top: 20px;">
   {{ translate('Thanks') }},<br>{{ config('app.name') }} {{ translate('Team') }}
</p>

{{-- Disclaimer / Footer --}}
<div style="font-size: 12px; color: #777; text-align: center; padding-top: 30px; border-top: 1px solid #ddd; margin-top: 20px;">
    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ translate('All rights reserved') }}.</p>
</div>
@endcomponent
