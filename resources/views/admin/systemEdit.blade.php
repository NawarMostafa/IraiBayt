@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">قوانين العراق</li>
@stop
@section('content')
    <div class="container">
        <edit-system-component id="{{$id}}"></edit-system-component>
    </div>
@endsection
