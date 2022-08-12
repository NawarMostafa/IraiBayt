@extends('site.layouts.master')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12 text-left">
            <h3>سياية الخصوصية</h3>
            <div class="img-thumbnail bg-wd">
                <p class="lead">{!! $setting->priv !!}</p>
            </div>
        </div>
    </div>
@stop