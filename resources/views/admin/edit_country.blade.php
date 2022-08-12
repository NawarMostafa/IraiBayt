
@php 
use App\Country;
@endphp

@extends('layouts.master')

@php
$Country= Country::find($id);
$Country_name = $Country->name;
@endphp

@section('content')
<template>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                    تعديل الدولة
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/countries/update" >
                @csrf

                            <div class="form-group">
                                <label>اسم الدولة</label>
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="text" name="name" value="{{$Country_name}}"
                                       class="form-control" >
                            </div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        
                </form>
                
                </div>
            </div>
        </div>
    </div>
</template>
@stop