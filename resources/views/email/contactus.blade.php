@component('mail::message')
# {{$topic}}

The *body* of **your message** pls _plses dfdf_ af feedb.
name:{{$ename}}


@component('mail::button', ['url' => '127.0.0.4'])
Button Text vew my dashpord
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent