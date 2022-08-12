@php

use App\System;

$title = 'قوانين العراق';
@endphp

@extends('site.layouts.master')
@section('content')


    <div class="container">

        <div class="row">

            @php
                
                $tips = System::WHERE('type', '=', 'system')
                    ->latest()
                    ->get();
                
            @endphp

            @foreach ($tips as $tip)
                @php
                    $text = strip_tags($tip->description);
                    $string = mb_substr($text, 0, 100) . '...';
                @endphp


                <div class="col-md-4 mt-4">

                    <div class="card text-center bg-wd h-100 ">
                        <div class="card-header" style="background:#275879;color:#ffffff;">
                            <h6 class="card-title">{{ $tip->name }}</h6>
                        </div>
                        <div class="card-body">

                            {{ $string }}
                            <a href="https://iraqibayt.com/tips/{{ $tip->id }}/show"> اقرأ المزيد </a>
                        </div>

                    </div>

                </div>
            @endforeach
        </div>

    </div>
@stop
