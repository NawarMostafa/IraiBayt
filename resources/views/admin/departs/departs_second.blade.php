@php
use App\Http\Controllers\Site\DepartController;
use App\Depart;
@endphp

@extends('layouts.master')

@section('content')
    <template>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="d-flex justify-content-between">
                            <span>الأقسام الإضافية</span>
                            <abbr title="إضافة قسم">
                                <a href="/dashboard/add_depart_second" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa fa-plus"></i></a>
                            </abbr>
                        </h4>
                    </div>
                    @php
                        $departs = Depart::where('id', '>', '8')->get();
                    @endphp

                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>اسم القسم</th>
                                <th>الصورة</th>
                                <th>التحكم</th>
                            </tr>

                            @foreach ($departs as $dep)
                                @php
                                $dep_id = $dep->id;
                                if($dep_id == 1){
                                $link = "https://iraqibayt.com/posts/view";
                                }else if($dep_id == 2){
                                $link = "https://iraqibayt.com/note/all";
                                }else if($dep_id == 3){
                                $link = "https://iraqibayt.com/tips";
                                }else if($dep_id == 4){
                                $link = "https://iraqibayt.com/exchange";
                                }else if($dep_id == 5){
                                $link = "https://iraqibayt.com/System";
                                }else if($dep_id == 6){
                                $link = "https://iraqibayt.com/quizeCat";
                                }else if($dep_id == 7){
                                $link = "https://iraqibayt.com/aboutIraq";
                                }else if($dep_id == 8){
                                $link = "https://iraqibayt.com/anylize";
                                }else{
                                $link =
                                "https://iraqibayt.com/depart?q=".$dep_id;
        }
         
       @endphp
       <tr>
                            <td>{{ $dep->name }}</td>
                            <td>
                                <img class="img-size-64"
                                src="https://iraqibayt.com/storage/app/public/images/{{ $dep->img }}" alt="">
                                </td>
                                <td>
                                    <a href="https://iraqibayt.com/dashboard/departs/{{ $dep->id }}/edit_depart_second?id={{ $dep->id }}"
                                        class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <a href="https://iraqibayt.com/dashboard/departs/{{ $dep->id }}/delete"
                                        class="btn btn-sm btn-info"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                </tr>
                            @endforeach


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </template>
@stop
