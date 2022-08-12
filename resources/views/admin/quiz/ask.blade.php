@php 
use App\CatQuiz;
use App\AnswerQuiz;
use App\AskQuiz;
@endphp

@extends('layouts.master')


@php

$cat = CatQuiz::find($id);
$cat_name = $cat->name;
@endphp

@section('bread')

    <li class="breadcrumb-item active"> أسئلة القسم  {{$cat_name}}</li>
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
                        <span> أضف سؤال جديد </span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <form method="post" action="/dashboard/asksQuiz/save" >
                @csrf

                <div class="form-group">
                                <label>السؤال</label>
                                <input type="hidden" name="cat_quiz_id" value="{{$id}}">
                                <input type="text" name="ask" class="form-control" >
                
                            <div class="form-group">
                                <label> الوقت المسموح به بالثانية</label>

                                <input type="number" name="time"
                                       class="form-control" >
                            </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                               <label class="d-block">الإجابة الأولى</label>
                           </div>

                           <div class="col-md-9">
                               <input type="text" name="ans1"
                                      class="form-control d-inline-block" >
                           </div>
                            <div class="col-md-3">
                                <select name="ans1right"  class="form-control-sm d-inline-block">
                                    <option value="0">خطأ</option>
                                    <option value="1">صحيح</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثانية</label>
                                </div>

                                <div class="col-md-9">
                                    <input  type="text" name="ans2"
                                           class="form-control d-inline-block" >
                                </div>
                                <div class="col-md-3">
                                    <select name="ans2right"  class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثالثة</label>
                                </div>

                                <div class="col-md-9">
                                    <input type="text" name="ans3"
                                           class="form-control d-inline-block" >
                                </div>
                                <div class="col-md-3">
                                    <select name="ans3right" class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الرابعة</label>
                                </div>

                                <div class="col-md-9">
                                    <input type="text" name="ans4"
                                           class="form-control d-inline-block">
                                </div>
                                <div class="col-md-3">
                                    <select name="ans4right"  class="form-control-sm d-inline-block">
                                        <option value="0">خطأ</option>
                                        <option value="1">صحيح</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                            
                            
                        
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
                        <span> أسئلة القسم  {{$cat_name}}</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>السؤال</th>
                            <th>التحكم</th>
                        </tr>

                        @php
                            $AskQuiz = AskQuiz::WHERE('cat_quiz_id','=',$id)->get();
                            $country_counter = 1;
                        @endphp

                        @foreach($AskQuiz as $ask)
                            <tr>
                                <td>{{$country_counter}}</td>
                                <td>{{$ask->ask}}</td>
                                <td>
                                    <a href='/dashboard/asksQuiz/{{$ask->id}}/editask' class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <a href='/dashboard/asksQuiz/{{$ask->id}}/delete' class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></a>
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