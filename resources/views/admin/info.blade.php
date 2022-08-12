@php  
use App\Setting;
@endphp

@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الدول</li>
    @stop
@section('content')
<div class="container">

@php
$set = Setting::first();
$time = $set->info_time;
@endphp

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
                        <span>مدة عرض الكلمة (بالثانية)</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <form method="post" action="/dashboard/info_time/update" >
                @csrf

                            <div class="form-group">
                                <label>مدة العرض بالثانية</label>

                                <input type="number" name="time" value="{{$time ?? ''}}" class="form-control" >
                            </div>
                            
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        
                </form>
                    

                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>


    </div>
</template>

<info-component></info-component>

</div>
@endsection
