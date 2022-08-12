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
                    أضف محافظة
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/cities/addcity_form" >
                @csrf
 
                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                <input type="text" name="name"
                                       class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>ترتيب الظهور</label>
                                <input type="text" name="sort"
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
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        
                </form>
                
                </div>
            </div>
        </div>
    </div>
</template>
@stop