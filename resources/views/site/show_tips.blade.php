@php

use App\System;

$tips = System::find($id);

$title = 'البيت العراقي - ' . $tips->name;
@endphp

@extends('site.layouts.master')

@section('content')

    <div class="row mt-10">
        <div class="col-md-12 text-left bg-wd p-2">

            <a href="https://iraqibayt.com/tips">العودة إلى النصائح</a>
            <p><?php echo $tips->description; ?></p>

            @if (!empty($tips->url))
                <embed id="framid" src="https://iraqibayt.com/storage/app/{{ $tips->url }}" type="application/pdf"
                    style="min-height:100vh;width:100%">
            @endif

        </div>
    </div>
@stop
