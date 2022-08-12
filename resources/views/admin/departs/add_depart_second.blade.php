@extends('layouts.master')

@section('content')
    <template>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><span>
                            أضف القسم
                        </span></div>
                    <div class="card-body">
                        <form class="m-2" method="post" action="/dashboard/add_depart_second" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>اسم القسم</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label>صورة القسم</label>
                                <input id="image" type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label> الرابط</label>
                                <input type="text" class="form-control" id="url" name="url">
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
@stop
