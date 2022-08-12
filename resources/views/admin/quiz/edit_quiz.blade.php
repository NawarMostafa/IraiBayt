@php 
use App\CatQuiz;
use App\AnswerQuiz;
@endphp

@extends('layouts.master')

@php
$CatQuiz= CatQuiz::find($id);
$CatQuiz_name = $CatQuiz->name;
$CatQuiz_img = $CatQuiz->img;

@endphp

@section('content')
<template>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                    تعديل القسم
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/categoriesQuiz/update" enctype="multipart/form-data">
                @csrf

                            <div class="form-group">
                                <label>اسم القسم</label>
                                <input type="hidden" name="id" value="{{$id}}">
                                <input type="text" name="name" value="{{$CatQuiz_name}}"
                                       class="form-control" >
                            </div>

                            <div class="form-group">
                                <label>صورة القسم</label>
                                <input type="file" name="img" id="img" class="form-control">
                                
                                <div class="mt-1 w-25" >
                                    <label for="">الصورة القديمة</label>
                                    <img width="100px" height="100px" src='https://iraqibayt.com/storage/app/public/images/{{$CatQuiz_img}}' />

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">تعديل</button>
                        
                </form>
                
                </div>
            </div>
        </div>
    </div>
</template>
@stop