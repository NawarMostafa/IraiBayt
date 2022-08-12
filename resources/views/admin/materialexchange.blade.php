@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">أسعار المعادن</li>
@stop
@section('content')
    <div class="container">
        <material-exchange-component date="{{date('Y-m-d')}}"></material-exchange-component>
    </div>
@endsection
