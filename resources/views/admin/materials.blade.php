@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">المعادن</li>
    @stop
@section('content')
<div class="container">
<material-component date="{{date('Y-m-d')}}"></material-component>
</div>
@endsection
