@php
use App\Setting;
$title = 'العروض المميزة';

$default_img = Setting::first()->default_img;
@endphp

@extends('site.layouts.master')

@section('content')

    <div class="row justify-content-center mt-4">
        @if ($posts->count() == 0)
            <div class="col-md-12 text-left">
                <span>لم يتم العثور على نتائج</span>
            </div>
        @else
            @foreach ($posts as $post)
                <div class="col-md-3 mb-3">

                    <div class="card img-thumbnail padd bg-wd text-left  mt-2" style=" position: relative;height:500px">

                        <a class="d-block text-dark" style="height:40%" href="{{ url('/post/' . $post->id . '/show') }}">
                            <div class="category-tag" style="background:#ed5f59;color:#ffffff">{{ $post->sub->name }}</div>
                            <div class="price-tag" style="background:#ed5f59;color:#ffffff">{{ $post->price }}
                                {{ $post->currancy->name }}</div>
                            @if ($post->img != null)
                                <img src="{{ asset('storage/app/public/posts/' . $post->img) }}"
                                    class="card-img-top none-border-radius img-fluid"
                                    style="height: 100%;object-fit: cover;" alt="...">
                            @else
                                <img src="https://iraqibayt.com/storage/app/public/posts/{{ $default_img }}"
                                    class="card-img-top none-border-radius  img-fluid"
                                    style="height: 100%;object-fit: cover;" alt="not found">
                            @endif
                        </a>

                        <a class="d-block text-dark" href="{{ url('/post/' . $post->id . '/show') }}">

                            <div class="card-body  pr-0 pl-0">
                                <h5 class="text-center pr-1 pl-1 mb-2">
                                    {{ \Illuminate\Support\Str::substr($post->title, 0, 42) }}

                                    <?php if (strlen($post->title) > 42) {
                                        echo '...';
                                    } ?>
                                </h5>
                                <hr class="w-100 p-0 m-0" style="color:#275879;background:#275879;">
                                {{-- <p class="card-text text-left mt-1 pr-1 pl-1"> {{\Illuminate\Support\Str::substr($post->description,0,85)}}</p> --}}
                                <span class="text-left d-block mt-1 pr-1 pl-1"><i
                                        class="fa fa-map-marker-alt t-bl"></i>{{ $post->city->name ?? ' ' }} -
                                    {{ $post->region->name ?? ' ' }}</span>
                                <span class="text-left d-block mt-1 pr-1 pl-1"><i class="fa fa-expand t-bl"></i> مساحة
                                    العقار : {{ $post->area }} {{ $post->unit->name }}</span>
                                <span class="text-left d-block mt-1 pr-1 pl-1"><i class="fa fa-plus-square t-bl"></i> أضيف :
                                    {{ $post->created_at }}</span>

                                @if ($post->sub->type == 'سكني')
                                    <div class="d-flex justify-content-around mt-2 pr-2 pl-2">
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
