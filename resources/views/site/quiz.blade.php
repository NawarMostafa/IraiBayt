@php
    $title = 'مسابقات';
@endphp

@extends('site.layouts.master')

@section('content')
   <div class="row justify-content-center mt-5">
       <div class="col-md-12 text-left">
           <h3><i class="fa fa-circle small t-orange"></i> <span>إختر نوع المسابقة</span></h3>
       </div>
       @foreach($quizies as $quiz)
           <div class="col-md-3 mt-1">
               <div class="img-thumbnail bg-wd none-border-radius text-center p-3">

                   <img class="rounded border-bd p-2  img-thumbnail img-64" src="{{asset('storage/app/public/images/'.$quiz->img)}}" alt="">
                   <br>  <a href="{{url('/quizz/'.$quiz->id)}}" class="text-center text-dark">{{$quiz->name}}</a>
               </div>
           </div>
           @endforeach
   </div>

  {{--  <div class="row justify-content-center mt-2">
        <div class="col-md-10">
            <div class="img-thumbnail">
                <img src="{{asset('public/img/ads.jpg')}}" class="img-fluid" alt="">
            </div>
        </div>
    </div>--}}
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <hr>
        </div>
    </div>
@if(auth()->check())
<contact-us-component email="{{auth()->user()->email}}"></contact-us-component>
@endif

@stop
<script>
    import ContactUsComponent from "../../js/components/site/ContactUsComponent";
    export default {
        components: {ContactUsComponent}
    }
</script>