@php 
use App\Country;
use App\City;
use App\Region;
use App\Post;
use App\Http\Controllers\Admin\PostController as pController;

@endphp

@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">المناطق</li>
    @stop
@section('content')

@php
$city= City::find($id);
$city_name = $city->name;


@endphp


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

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span> أضف منطقة لمدينة {{$city_name}}</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                <form method="post" action="/dashboard/regions/save" >
                @csrf

                            <div class="form-group">
                                <label>اسم المنطقة</label>
                                <input type="hidden" name="city_id" value="{{$id}}">

                                <input type="text" name="name"
                                       class="form-control" >
                            </div>
                            
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        
                </form>
                    

                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>


    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between">
                        <span>مناطق مدينة {{$city_name}}</span>
                        
                    </h4>
                </div>
                <div class="card-body table-responsive">
                
                    <table class="table table-bordered">
                        <tr>
                            <th>الترقيم</th>
                            <th>المنطقة</th>
                            <th>المدينة</th>
                            <th>عدد الإعلانات ضمن المنطقة</th>
                            <th>التحكم</th>
                        </tr>

                        @php
                            $regions = Region::WHERE('city_id','=',$id)->get();
                            $country_counter = 1;
                        @endphp

                        @foreach($regions as $region)
                            <tr>
                                <td>{{$country_counter}}</td>
                                <td><a href='/dashboard/posts/{{$region->id}}/region'>{{$region->name}}</a></td>
                                <td>{{$region->City->name}}</td>
                                <td>{{pController::getPostsByRegionId($region->id)}}</td>
                                <td>
                                    <a href='/dashboard/regions/{{$region->id}}/edit' class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                    <button type="button" onclick="deleteRegion({{$region->id}} , {{pController::getPostsByRegionId($region->id)}} , {{$id}});" class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></a>
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
    <script>

        function deleteRegion(rid , rCount , cid)
            {
                Swal.fire({
                        title: 'هل انت متأكد من عملية الحذف ؟',
                        text: "يوجد "+rCount+" إعلان تابع لهذه المنطقة . في حال الموافقة سيتم حذف المنطقة مع الإعلانات المرتبطة بها",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'تأكيد الحذف',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.value) 
                        {
                            axios.delete(base_site + '/dashboard/regions/' + rid + '/delete').then(({data}) => {
                                    Toast.fire({
                                        icon: 'success',
                                        text: 'تم الحذف بنجاح .'
                                        }).then(function(){
                                            location.href = base_site +'/dashboard/'+cid+'/region';
                                    });
                                });
                        }
                    });
            };

    </script>
@endsection