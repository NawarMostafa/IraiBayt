@php 
use App\CatQuiz;
use App\AnswerQuiz;
@endphp

@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">أقسام المسابقات </li>
    @stop
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span> أضف قسم جديد </span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <form method="post" action="/dashboard/categoriesQuiz/save" enctype="multipart/form-data">
                @csrf

                            <div class="form-group">
                                <label>اسم القسم</label>
                                <input type="text" name="name"
                                       class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>صورة القسم</label>
                                <input type="file" name="img" id="img" class="form-control" >
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

<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>  أقسام المسابقات</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>القسم</th>
                            <th>صورة القسم</th>
                            <th>التحكم</th>
                        </tr>

                        @php
                            $CatQuiz = CatQuiz::all();
                            $country_counter = 1;
                        @endphp

                        @foreach($CatQuiz as $Quiz)
                            <tr>
                                <td>{{$country_counter}}</td>
                                <td><a href='https://iraqibayt.com/dashboard/{{$Quiz->id}}/askQuiz'>{{$Quiz->name}}</a></td>
                                <td><img width="100px" height="100px" src='https://iraqibayt.com/storage/app/public/images/{{$Quiz->img}}' /></td>
                                <td>
                                    <a href='/dashboard/categoriesQuiz/{{$Quiz->id}}/editquiz' class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <a href='/dashboard/categoriesQuiz/{{$Quiz->id}}/delete' class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></a>
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
@endsection