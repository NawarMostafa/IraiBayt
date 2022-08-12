@php
use App\Setting;
$title = 'العقارات';
$default_img = Setting::first()->default_img;
$pCount = $posts->count();
@endphp

@extends('site.layouts.master')

@section('content')

    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-12">
            <advanced-search-component></advanced-search-component>
        </div>
    </div>


    @if (isset($byUser))
        <div class="row ml-3 mt-3 mb-3">
            <h3>الإعلانات التي أضيفت من قبل {{ $byUser }}</h3>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    @endif

    <div class="row justify-content-center mt-2">
        @if ($posts->count() == 0)
            <div class="col-md-12 text-left">
                <span>لم يتم العثور على نتائج</span>
            </div>
        @else
            <div class="col-md-12 ml-5 mb-2 text-left">
                <span>
                    <h4>عدد النتائج : {{ $posts->total() }} إعلان</h4>
                </span>
            </div>
            @foreach ($posts as $post)
                <div class="col-md-3 mb-3">

                    <div class="card img-thumbnail padd  text-left bg-wd mt-2" style=" position: relative;height:500px">

                        <a class="d-block text-dark" style="height:40%" href="{{ url('/post/' . $post->id . '/show') }}">
                            <div class="category-tag">{{ $post->sub->name }}</div>
                            <div class="price-tag">{{ $post->price }} {{ $post->currancy->name }}</div>
                            @if ($post->img != null)
                                <img src="{{ asset('storage/app/public/posts/' . $post->img) }}"
                                    class="card-img-top none-border-radius img-fluid" style="height: 100%" alt="...">
                            @else
                                <img src="https://iraqibayt.com/storage/app/public/posts/{{ $default_img }}"
                                    class="card-img-top none-border-radius  img-fluid" style="height: 100%" alt="not found">
                            @endif
                        </a>

                        <a class="d-block text-dark" href="{{ url('/post/' . $post->id . '/show') }}">

                            <div class="card-body">
                                <h6 class="card-title text-center small p-0 mb-2">
                                    {{ \Illuminate\Support\Str::substr($post->title, 0, 45) }}
                                </h6>
                                <hr class="w-100 p-0 m-0">
                                <span class="text-left d-block mt-1"><i
                                        class="fa fa-map-marker-alt t-bl"></i>{{ $post->city->name ?? ' ' }} -
                                    {{ $post->region->name ?? ' ' }}</span>
                                <span class="text-left d-block mt-1"><i class="fa fa-expand t-bl"></i> مساحة العقار :
                                    {{ $post->area }} {{ $post->unit->name }}</span>
                                <span class="text-left d-block mt-1"><i class="fa fa-plus-square t-bl"></i> أضيف :
                                    {{ $post->created_at }}</span>

                                @if ($post->sub->type == 'سكني')
                                    <div class="d-flex justify-content-around mt-2">
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-block"> <i
                                                    class="fa fa-car text-white"></i></div><span
                                                class="small d-block">{{ $post->num_car ?? 0 }}</span>
                                        </div>
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                                    class="fa fa-bed text-white"></i></div><span
                                                class="d-block small">{{ $post->bedroom ?? 0 }}</span>
                                        </div>
                                        <div class="text-center mb-2 mt-2">
                                            <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                                    class="fa fa-bath text-white"></i></div><span
                                                class="d-block small">{{ $post->bathroom ?? 0 }}</span>
                                        </div>

                                    </div>
                                @elseif($post->sub->type == 'غير سكني')
                                    <div class="d-flex justify-content-around mt-2" style="height:70px;">
                                    </div>
                                @endif

                            </div>
                        </a>
                        <div class="card-footer">
                            <button class="btn btn-sm w-75 phone mt-2"><a
                                    href="tel:{{ $post->phone }}">{{ $post->phone }}</a> <i
                                    class="fa fa-phone-alt t-bl"></i></button>
                            <button type="button" class="btn btn-sm btn-danger mt-2  z-fav"
                                onclick="addFav({{ $post->id }});"><i class="fa fa-heart"></i></button>
                        </div>
                    </div>


                </div>
            @endforeach

            <div class="col-md-12">
                {{ $posts->appends(request()->all())->links() }}
            </div>
        @endif
    </div>
    <script>
        function addFav(pid) {
            axios.get(base_site + '/favorit/' + pid + '/store')
                .then(function(response) {
                    if (response.status == 200 || response.status == 201) {
                        Toast.fire({
                            icon: 'success',
                            text: 'تمت الإضافة إلى المفضلة'
                        });
                    }
                }).catch(function(error) {
                    if (error.response.status == 500) {
                        Swal.fire({
                            title: 'يجب عليك تسجيل الدخول أولاً',
                            text: "لكي تتمكن من المتابعة",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'تسجيل الدخول',
                            cancelButtonText: 'إلغاء'
                        }).then((result) => {
                            if (result.value) {
                                location.href = base_site + '/login';
                            }
                        });
                    }
                });
        };
    </script>


@stop
