@extends('site.layouts.master')

@section('content')


    @php

    $email = '';

    if (auth()->check()) {
        $email = auth()->user()->email;
    }

    @endphp


    <div id="contactUs" class="mt-5">
        <contact-us-component email="{{ $email }}"></contact-us-component>
    </div>



@stop
