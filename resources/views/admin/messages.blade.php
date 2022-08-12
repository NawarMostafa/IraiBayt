@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الرسائل</li>
    @stop
@section('content')
<div class="container">
<message-component></message-component>
</div>
@endsection
