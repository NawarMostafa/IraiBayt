@php
use App\Http\Controllers\Site\DepartController;
use App\Depart;
$title = 'الصفحة الرئيسية';
@endphp

@extends('site.layouts.master')



@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <weather-component></weather-component>
        </div>
        <div class="col-md-6">
            <exchange-component></exchange-component>
        </div>
    </div>


    <template>
        <div class="row justify-content-center mt-5 mb-5">
            @php
                $departs = Depart::all();
            @endphp




            @foreach ($departs as $dep)
                @php
                    $dep_id = $dep->id;
                    if ($dep_id == 1) {
                        $link = 'https://iraqibayt.com/posts/view';
                    } elseif ($dep_id == 2) {
                        $link = 'https://iraqibayt.com/note/all';
                    } elseif ($dep_id == 3) {
                        $link = 'https://iraqibayt.com/tips';
                    } elseif ($dep_id == 4) {
                        $link = 'https://iraqibayt.com/exchange';
                    } elseif ($dep_id == 5) {
                        $link = 'https://iraqibayt.com/System';
                    } elseif ($dep_id == 6) {
                        $link = 'https://iraqibayt.com/quizeCat';
                    } elseif ($dep_id == 7) {
                        $link = 'https://iraqibayt.com/aboutIraq';
                    } elseif ($dep_id == 8) {
                        $link = 'https://iraqibayt.com/anylize';
                    } else {
                        $link = 'https://iraqibayt.com/depart/' . $dep_id;
                    }
                    
                    if ($dep_id > 8) {
                        $name = $dep->name;
                        $img = 'https://iraqibayt.com/storage/app/public/images/' . $dep->img;
                    } else {
                        $name = $dep->data['name'];
                        $img = 'https://iraqibayt.com/storage/app/public/images/' . $dep->data['img'];
                    }
                    
                @endphp
                <div class="col-md-3 text-center ">

                    <div class="card bg-wd" style="margin: 15px;">
                        <a href="{{ $link }}" class="d-inline-block">
                            <img class="card-img-top " style="height: 150px;"src="{{ $img }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title" style="color:#275879;">{{ $name }}</h5>
                            </div>
                        </a>
                    </div>


                </div>
            @endforeach

        </div>
    </template>

    <div class="row justify-content-center">
        <div class="col-md-12 mt-2 mb-2">


        </div>
    </div>


    {{-- <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <div class="img-thumbnail">
                <img src="{{asset('/img/ads.jpg')}}" class="img-fluid" alt="بديل">
            </div>
        </div>
    </div> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <search-component></search-component>

        </div>
    </div> --}}

    <div class="row">
        <search-component></search-component>
    </div>
    <div class="row mt-2">
        <special-component></special-component>
    </div>
    <div class="row mt-5 mb-2">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <latest-component></latest-component>
    </div>
    <div class="row mt-5 mb-2">
        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <info-component></info-component>


@stop
