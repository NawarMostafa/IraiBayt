@php
use App\Depart;
@endphp

@extends('site.layouts.master')

@section('content')

    <div class="row mt-5">
        <div class="col-md-12 text-left">
            <h3>خريطة الموقع</h3>
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="https://iraqibayt.com/">الرئيسية</a></li>
                        <li><a href="https://iraqibayt.com/register">التسجيل</a></li>
                        <li><a href="https://iraqibayt.com/login">تسجيل الدخول</a></li>
                        <li><a href="https://iraqibayt.com/posts/view">العقارات</a></li>
                        <ul>
                            <li><a href="https://iraqibayt.com/addPost">أضف إعلان</a></li>
                        </ul>
                        <li><a href="https://iraqibayt.com/note/all">هل تعلم</a></li>
                        <li><a href="https://iraqibayt.com/tips">نصائح عن العقارات</a></li>
                        <li><a href="https://iraqibayt.com/exchange">أسعار العملات</a></li>
                        <li><a href="https://iraqibayt.com/System">قوانين العراق</a></li>
                        <li><a href="https://iraqibayt.com/quizeCat">مسابقات</a></li>
                        <li><a href="https://iraqibayt.com/aboutIraq">عن العراق</a></li>
                        <li><a href="https://iraqibayt.com/anylize">احصائيات عالمية</a></li>

                        @php
                            $departs = Depart::all();
                        @endphp




                        @foreach ($departs as $dep)
                            @if ($dep->id > 8)
                                @php
                                    $dep_id = $dep->id;
                                    
                                    $link = 'https://iraqibayt.com/depart/' . $dep_id;
                                    
                                    $name = $dep->name;
                                    
                                @endphp
                                <li><a href="{{ $link }}">{{ $name }}</a></li>
                            @endif
                        @endforeach

                        <li><a href="https://iraqibayt.com/aboutUs"> من نحن</a></li>
                        <li><a href="https://iraqibayt.com/Privacy"> سياسة الخصوصية</a></li>
                        <li><a href="https://iraqibayt.com/terms"> شروط الاستخدام</a></li>
                    </ul>
                </div>

            </div>
            </section>
        </div>
    </div>
@stop
