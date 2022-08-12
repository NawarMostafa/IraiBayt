@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">العملات</li>
    @stop
@section('content')
<div class="container">
<exchange-component date="{{date('Y-m-d')}}"></exchange-component>
</div>
@endsection
