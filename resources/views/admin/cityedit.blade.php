@php 
use App\Country;
@endphp

@extends('layouts.master')

@section('content')
<template>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                    تعديل محافظة
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/cities/editcity_form" >
                @csrf

                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="text" name="name" value="{{$name}}"
                                       class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>ترتيب الظهور</label>
                                <input type="text" name="sort" value="{{$sort}}"
                                       class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>الدولة</label>

                                <select name="country_id"
                                        class="form-control" >
                                    <option value="">إختر دولة</option>

                                    @php
                                        $countries = Country::all();
                                    @endphp

                                    @foreach($countries as $country)
                                    @if($country->id == $country_id)
                                    <option value="{{$country->id}}" selected>{{$country->name}}</option>
                                    @else
                                    <option value="{{$country->id}}">{{$country->name}}</option>

                                    @endif
                                        
                                        
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        
                </form>
                
                </div>
            </div>
        </div>
    </div>
</template>
@stop