@extends('layouts.master')





@section('content')

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
        <div class="col-md-10">

        

            <div class="card">
                <div class="card-header"><span>
                    تعديل عناوين الجداول
                </span></div>
                <div class="card-body"> 
                        <form class="m-2" method="post" action="/dashboard/ex/updateTablesTitle" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>عنوان الجدول الأول</label>
                            <input type="text" class="form-control" value="{{$t1}}" id="table1title" name="table1title">
                        </div>
                        <div class="form-group">
                            <label>عنوان الجدول التاني</label>
                            <input type="text" class="form-control" value="{{$t2}}" id="table2title" name="table2title">
                        </div>
                    <button  type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>
@stop