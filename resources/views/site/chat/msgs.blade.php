@extends('site.layouts.master')


@section('content')

  @foreach ($msgs as $msg)

      <div class="card p-2 mt-1 text-left">
          <h6><a href="{{route('msg.show',['send'=>$msg->send,'post_id'=>$msg->post_id])}}">{{$msg->post->title}}</a></h6>
         <div>
             <span class="d-inline-block mr-4 small text-muted">المرسل :  {{$msg->sender->name}}</span>
             {{--<span class="d-inline-block mr-4 small text-muted">تم الإرسال :  {{$msg->created_at}}</span>--}}
         </div>
      </div>
  @endforeach
@stop