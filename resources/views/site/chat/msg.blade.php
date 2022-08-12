@extends('site.layouts.master')


@section('content')

  <div class="row justify-content-center">
      <div class="col-md-8 text-left">
          @foreach ($msgs as $msg)

              <div class="card p-2 mt-1 text-left">
<p class="small">المرسل : {{$msg->sender->name}}</p>
                  <p>{{$msg->body}}</p>
                  <p class="small"><span>تم الإرسال : {{$msg->created_at}}</span></p>
              </div>
          @endforeach
      </div>
      <div class="col-md-8 text-left">
          <div class="card">
              <div class="card-body bg-wd">
                  <form action="{{route('msg.replay',['send'=>$msg->send,'post'=>$msg->post_id])}}" method="post">
                    @csrf
                      <div class="form-group">
                          <label >أرسل رد</label>
                          <textarea name="body"  class="form-control border-none" placeholder="اكتب الرد هنا .."></textarea>
                      </div>
                      <div class="form-group">
                          <button class="btn btn-sm btn-success" type="submit">أرسل</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@stop