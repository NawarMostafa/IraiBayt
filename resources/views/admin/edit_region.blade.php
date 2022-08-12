@php 
use App\Region;
@endphp

@extends('layouts.master')

@php
$Region= Region::find($id);
$Region_name = $Region->name;


@endphp

@section('content') 
<template>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                    تعديل المنطقة
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/regions/update" >
                @csrf

                            <div class="form-group">
                                <label>اسم المنطقة</label>
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="text" name="name" value="{{$Region_name}}"
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