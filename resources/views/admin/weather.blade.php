@extends('layouts.master')

@section('content')
    <weather-component date="{{date('Y-m-d')}}"></weather-component>
@stop