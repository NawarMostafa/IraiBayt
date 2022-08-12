@extends('layouts.master')
@section('bread')

@php

@endphp

    <li class="breadcrumb-item active">الإعلانات</li>
    @stop
@section('content')

<div class="container" >
    <post-component-region :reg_id="{{$region_id}}" :user="{{auth()->user()}}"></post-component-region>
</div>
@endsection
