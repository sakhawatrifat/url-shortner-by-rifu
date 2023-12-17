@component('mail::message')
Hi There,<br>
Please verify your email with bellow link:

@component('mail::button', ['url' => route('account.verify',$content['token'])])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@php
    //exit();
@endphp
