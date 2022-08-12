@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">أقسام المسابقات</li>
    @stop
@section('content')
<div class="container">
<category-quiz-component></category-quiz-component>
</div>
@endsection
