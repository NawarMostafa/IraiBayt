@extends('site.layouts.master')
@section('content')
    <div class="row justify-content-center">
        <site-add-post-component user="{{auth()->user()->name}}"></site-add-post-component>
    </div>
@stop