@component('mail::message')
# شكرا لتواصلك معنا

{{$msg}}



Thanks,<br>
{{--{{ config('app.name') }}--}}
موقع البيت العراقي <a href="{{url('/')}}">زيارة</a>
@endcomponent
