@extends('site.layouts.master')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-12 text-left">
            <h3><i class="fa fa-circle small t-orange"></i> <span>إختر نوع المسابقة</span></h3>
        </div>
        @foreach ($quizies as $quiz)
            <div class="col-md-3 mt-1">
                <div class="img-thumbnail bg-wd none-border-radius text-center p-3 {{ $quiz->id == $id ? 'bg-primary' : '' }}">

                    <img class="rounded border-bd p-2 bg-wd img-thumbnail img-64"
                        src="{{ asset('storage/app/public/images/' . $quiz->img) }}" alt="">
                    <br> <a href="{{ url('/quizz/' . $quiz->id) }}#quizz" class="text-center text-dark">{{ $quiz->name }}</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <quizz-component id="{{ $id }}"></quizz-component>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
@stop
