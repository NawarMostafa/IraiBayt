@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الأقسام</li>
    @stop
@section('content')
<div class="container">
<sub-category-component></sub-category-component>
</div>
@endsection
