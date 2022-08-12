@extends('site.layouts.master')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12 text-left">
            <h3>شروط الإستخدام</h3>
            <div class="img-thumbnail bg-wd">
                <p class="lead">{!! $setting->terms !!}</p>
            </div>
        </div>
    </div>
@stop
