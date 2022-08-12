<?php

use App\Currancy;

?>
@php
$title = 'أسعار العملات';
@endphp

@extends('site.layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 text-left">
            <div class="img-thumbnail p-3  bg-wd">
                <p class="">{!! $setting->header_ex !!}</p>
            </div>
        </div>
        <div class="col-md-10 text-left">
            <div class="card mt-3 bg-wd">
                <div class="card-header" style="background:#275879;color:#ffffff;"><span>{{ $t1 }}</span></div>
                <div class="card-body table-responsive ">
                    <table class="table table-bordered">
                        <tr class="text-center">
                            <th class="text-center t-bl">كل</th>
                            <th class="text-center t-bl">تساوي</th>
                            <th class="text-center t-bl">جهة الصرافة</th>
                        </tr>
                        @if (count($exs) > 0)
                            @foreach ($exs as $ex)
                                <?php
                                $from = Currancy::find($ex->from);
                                $to = Currancy::find($ex->to);
                                ?>

                                <tr>

                                    <td class="text-center">{{ $ex->val_from }} {{ $from->name }}</td>
                                    <td class="text-center">{{ $ex->val_to }} {{ $to->name }}</td>
                                    <td class="text-center">{{ $ex->direction }}</td>
                                </tr>
                            @endforeach

                        @endif
                    </table>
                </div>
            </div>
        </div>



        <div class="col-md-10 text-left">
            <div class="card mt-3  bg-wd">
                <div class="card-header" style="background:#275879;color:#ffffff;"><span>{{ $t2 }}</span></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tr class="text-center">
                            <th class="text-center t-bl">العملة</th>
                            <th class="text-center t-bl">لكل 1 دولار</th>

                        </tr>
                        @if (count($curs) > 0)
                            @foreach ($curs as $cur)
                                @if (isset($result[$cur->short_name]) && $cur->short_name != 'USD')
                                    <tr>

                                        <td class="text-center">{{ $cur->name }}</td>
                                        <td class="text-center">{{ number_format($result[$cur->short_name], 2) }}</td>

                                    </tr>
                                @endif
                            @endforeach

                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
