@component('mail::message')
# Welcome for misss reg
{{$ename}},您好！
2months free, any quest

The *body* of **your message** pls _plses dfdf_ af feedb.

@component('mail::button', ['url' => '127.0.0.4'])
Button Text vew my dashpord
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent