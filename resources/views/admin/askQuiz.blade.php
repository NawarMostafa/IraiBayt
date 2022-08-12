@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الأسئلة</li>
    @stop
@section('content')
<div class="container">
<ask-quiz-component></ask-quiz-component>
</div>
@endsection
