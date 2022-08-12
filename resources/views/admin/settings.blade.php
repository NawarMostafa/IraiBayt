@extends('layouts.master')

@section('content')
    @if(auth()->check() && auth()->user()->role=='admin')
        <settings-component></settings-component>
    @endif
@stop