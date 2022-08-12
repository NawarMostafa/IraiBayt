@extends('layouts.master')

@section('content')
    <edit-post-component post="{{$post->id}}" ></edit-post-component>
@stop