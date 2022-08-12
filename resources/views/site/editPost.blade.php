@extends('site.layouts.master')
@section('content')
    <div class="row justify-content-center">
        <site-edit-post-component id_post="{{$id}}" user="{{auth()->user()->name}}"></site-edit-post-component>
    </div>
@stop