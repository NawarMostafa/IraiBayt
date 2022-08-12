@php
    $title = 'إحصائيات عالمية';
@endphp

@extends('site.layouts.master')
@section('content')


    <div class="row mt-5 justify-content-center">
@foreach($ans as $an)
            <div class="col-md-6 mt-4 text-left">
                <div class="card">
                    <div class="card-header" style="background:#275879;color:#ffffff;"><span>{{$an->title}}</span></div>
                    <div class="card-body text-center">{!! $an->body !!}</div>
                </div>
            </div>
    @endforeach
    </div>
@stop