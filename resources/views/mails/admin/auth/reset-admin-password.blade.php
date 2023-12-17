@component('mail::message')
Hi There,<br>
Please reset your {{config('app.name')}} account password from the link given below.

@component('mail::button', ['url' => route('admin.password.reset.form',$content['token'])])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@php
    //exit();
@endphp
