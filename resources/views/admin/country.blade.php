
@php 
use App\Country;
use App\City;
use App\Region;
@endphp

@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الدول</li>
    @stop
@section('content')
<div class="container">
@isset($alert)
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{$alert}}</strong> 
</div>

<script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
@endisset
<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>الدول</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <form method="post" action="/dashboard/countries/save" >
                @csrf

                            <div class="form-group">
                                <label>اسم الدولة</label>

                                <input type="text" name="name"
                                       class="form-control" >
                            </div>
                            
                            <button type="submit" class="btn btn-primary">أضف</button>
                        
                </form>

                <br />

                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>الدولة</th>
                            <th>التحكم</th>
                        </tr>

                        @php
                            $countries = Country::all();
                            $country_counter = 1;
                        @endphp

                        @foreach($countries as $country)
                            <tr>
                                <td>{{$country_counter}}</td>
                                <td>{{$country->name}}</td>
                                <td>
                                    <a href='/dashboard/countries/{{$country->id}}/get' class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <a href='/dashboard/countries/{{$country->id}}/delete' class="btn btn-sm btn-danger" ><i class="fa fa-trash "></i></a>

                                    

                                </td>
                            </tr>

                            @php
                                $country_counter++;
                            @endphp
                        @endforeach
                        
                    </table>

                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>


    </div>
</template>


<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>المحافظات</span>
                        <abbr title="إضافة محافظة">
                            <a href="/dashboard/cities/addcity" class="btn btn-sm btn-outline-secondary"><i
                                    class="fa fa-plus"></i></a>
                        </abbr>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                   
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>المحافظة</th>
                            <th>المناطق</th>
                            <th>الدولة</th>
                            <th>التحكم</th>
                        </tr>

                        @php
                            $cities = City::all();
                            $city_counter = 1;
                        @endphp

                        @foreach($cities as $city)

                        @php
                        $wordlist = Region::where('city_id', '=', $city->id)->get();
                        $Count = $wordlist->count();
                        @endphp
                        <tr>
                            <td>{{$city_counter}}</td>
                            <td><a href='https://iraqibayt.com/dashboard/{{$city->id}}/region'>{{$city->name}} </a></td>
                            <td>{{$Count}}</td>
                            <td>{{$city->Country->name}}</td>

                            <td>
                                <a href="/dashboard/cities/{{$city->id}}/edit" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href=""  type="button" id= "delete{{$city_counter}}" data-toggle="modal" data-target="#myModal{{$city_counter}}" class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></a>                      
                                    
    <div class="modal fade" id="myModal{{$city_counter}}" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align:right; float:right;">حذف محافظة {{$city->name}}</h4>
            </div>
            <div class="modal-body">
            هل أنت متأكد من حذف محافظة {{$city->name}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
            <a href=""  type="button" id= "delete2{{$city_counter}}" data-toggle="modal" data-target="#delete_alert{{$city_counter}}" class="btn btn-sm btn-danger">حذف</a>                      

            </div>
        </div>
        
        </div>
    </div>

    <div class="modal fade" id="delete_alert{{$city_counter}}" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="text-align:right; float:right;">تحذير نهائي {{$city->name}}</h4>
            </div>
            <div class="modal-body">
                انتبه! أنت على وشك حذف محافظة {{$city->name}} وكل ما يتعلق بها بشكل نهائي، هل أنت متأكد؟
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
            <a href="/dashboard/cities/{{$city->id}}/delete"  class="btn btn-danger" >حذف</a>
            </div>
        </div>
        
        </div>
    </div>
                            </td>
                        </tr>

                        @php
                            $city_counter++;
                        @endphp
                        @endforeach
                    </table>

                </div>
                <div class="card-footer">
                   
                </div>
            </div>
        </div>
    </div>
</template>

</div>
@endsection
