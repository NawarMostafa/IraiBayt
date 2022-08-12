@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span>جميع البلاغات</span></div>
                <div class="card-body table-responsive-lg">
                    <table class="table tablebordered">
                        <tr>
                            <th>نوع البلاغ</th>
                            <th>نص البلاغ</th>
                            <th>المرسل</th>
                            <th>الإعلان</th>
                            <th>الناشر</th>
                             <th>حالة البلاغ</th>
                            <th>تحكم</th>
                        </tr>
                        @foreach($clims as $clim)
                            <tr>
                                <td>{{$clim->type}}</td>
                                <td>{{$clim->body}}</td>
                                <td>{{$clim->user->name}}</td>
                                <td><a href="{{url('post/'.$clim->post->id.'/show')}}">{{$clim->post->title}}</a></td>
                                <td>{{$clim->post->user->name}}</td>
                                <td>{{$clim->active==1?"تمت المراجعة":'ينتظر المراجعة'}}</td>
<td>
    @if($clim->active==0)

        <a href="{{route('dashboard.clims.read',['id'=>$clim->id])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
    
    @endif
        <a href="{{route('dashboard.clims.delete',['id'=>$clim->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
</td>
                            </tr>
                            @endforeach
                    </table>
                </div>
                <div class="card-footer">
                    {{$clims->links()}}
                </div>
            </div>
        </div>
    </div>
@stop