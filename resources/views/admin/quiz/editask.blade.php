@php 
use App\AskQuiz;
use App\AnswerQuiz;
@endphp

@extends('layouts.master')

@php
$AskQuiz= AskQuiz::find($id);
$AskQuiz_name = $AskQuiz->ask;
$time = $AskQuiz->time;

$AnswerQuiz = AnswerQuiz::WHERE('ask_quiz_id','=',$id)->get();


$counter = 1
@endphp

@foreach($AnswerQuiz as $Answer)
@php
    if($counter == 1)
    {
        $ans1 = $Answer->answer;
        $ans1_id = $Answer->id;
        $right1 = $Answer->right;
    }else if($counter == 2)
    {
        $ans2 = $Answer->answer;
        $ans2_id = $Answer->id;
        $right2 = $Answer->right;
    }else if($counter == 3)
    {
        $ans3 = $Answer->answer;
        $ans3_id = $Answer->id;
        $right3 = $Answer->right;
    }else if($counter == 4)
    {
        $ans4 = $Answer->answer;
        $ans4_id = $Answer->id;
        $right4 = $Answer->right;
    } 
$counter++;
@endphp
@endforeach

@section('content')
<template>
<div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><span>
                    تعديل السؤال
                </span></div>
                <div class="card-body">
                <form method="post" action="/dashboard/asksQuiz/update" >
                @csrf

                <div class="form-group">
                                <label>السؤال</label>
                                <input type="hidden" name="ask_id" value="{{$id}}">
                                <input type="text" value="{{$AskQuiz_name}}" name="ask" class="form-control" >
                
                            <div class="form-group">
                                <label> الوقت المسموح به بالثانية</label>

                                <input type="number" name="time" value="{{$time}}" class="form-control" >
                            </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                               <label class="d-block">الإجابة الأولى</label>
                               <input type="hidden" name="ans1_id" value="{{$ans1_id}}">
                           </div>

                           <div class="col-md-9">
                               <input type="text" name="ans1" value="{{$ans1}}"
                                      class="form-control d-inline-block" >
                           </div>
                            <div class="col-md-3">
                                <select name="ans1right"  class="form-control-sm d-inline-block">
                                    @if($right1 == 0)
                                    <option value="0" SELECTED>خطأ</option>
                                    <option value="1">صحيح</option>
                                    @else
                                    <option value="0" >خطأ</option>
                                    <option value="1" SELECTED>صحيح</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثانية</label>
                                    <input type="hidden" name="ans2_id" value="{{$ans2_id}}">
                                </div>

                                <div class="col-md-9">
                                    <input  type="text" name="ans2" value="{{$ans2}}"
                                           class="form-control d-inline-block" >
                                </div>
                                <div class="col-md-3">
                                    <select name="ans2right"  class="form-control-sm d-inline-block">
                                    @if($right2 == 0)
                                    <option value="0" SELECTED>خطأ</option>
                                    <option value="1">صحيح</option>
                                    @else
                                    <option value="0" >خطأ</option>
                                    <option value="1" SELECTED>صحيح</option>
                                    @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الثالثة</label>
                                    <input type="hidden" name="ans3_id" value="{{$ans3_id}}">
                                </div>

                                <div class="col-md-9">
                                    <input type="text" name="ans3" value="{{$ans3}}"
                                           class="form-control d-inline-block" >
                                </div>
                                <div class="col-md-3">
                                    <select name="ans3right" class="form-control-sm d-inline-block">
                                    @if($right3 == 0)
                                    <option value="0" SELECTED>خطأ</option>
                                    <option value="1">صحيح</option>
                                    @else
                                    <option value="0" >خطأ</option>
                                    <option value="1" SELECTED>صحيح</option>
                                    @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="d-block">الإجابة الرابعة</label>
                                    <input type="hidden" name="ans4_id" value="{{$ans4_id}}">
                                </div>

                                <div class="col-md-9">
                                    <input type="text" name="ans4" value="{{$ans4}}"
                                           class="form-control d-inline-block">
                                </div>
                                <div class="col-md-3">
                                    <select name="ans4right"  class="form-control-sm d-inline-block">
                                    @if($right4 == 0)
                                    <option value="0" SELECTED>خطأ</option>
                                    <option value="1">صحيح</option>
                                    @else
                                    <option value="0" >خطأ</option>
                                    <option value="1" SELECTED>صحيح</option>
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                        
                </form>
                
                </div>
            </div>
        </div>
    </div>
</template>
@stop