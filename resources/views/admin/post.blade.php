@extends('layouts.master')
@section('bread')

    <li class="breadcrumb-item active">الإعلانات</li>
    @stop
@section('content')

<div class="container" >
<center>
{{$value}} | <a href="/dashboard/posts/activeAll" class="btn btn-sm btn-blue-dark">تبديل الحالة</a>

</br></br>

<a href='https://iraqibayt.com/postexport' target="_blank">تحميل ملف اكسل</a></br ></br>
</center><br />
        
    <post-component :user="{{auth()->user()}}"></post-component>

</div>
@endsection
