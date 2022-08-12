@php
use App\Setting;
$title = $id->title;
$default_img = Setting::first()->default_img;
@endphp

@extends('site.layouts.master')


@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card img-thumbnail ">
                <div class="card-body">
                    <h3 class="text-left"><i class="small fa fa-circle mr-2 t-orange"></i> <span>{{ $id->title }}</span>
                    </h3>
                    <div class="text-left mt-3 mb-3">



                        <div id="carouselExampleIndicators" class="carousel slide carousel-fit" data-ride="carousel"
                            style="background:#eee; padding: 0;">

                            <ol class="carousel-indicators">


                                @php
                                    $counter = 1;
                                    echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" ></li>';
                                    
                                    foreach ($id->imgs as $img) {
                                        echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$counter.'"></li>';
                                    
                                        $counter++;
                                    }
                                    
                                @endphp


                            </ol>

                            <div class="carousel-inner ">

                                @php
                                    $counter = 2;
                                    
                                    if ($id->img == null) {
                                        echo '<div class="carousel-item active center-block"><center>';
                                        echo '<img onclick="openModal();currentSlide(1)" class="center-block img-fluid " src="https://iraqibayt.com/storage/app/public/posts/'.$default_img.'" style="height:350px;display: block;
    margin-left: 0 auto;
    margin-right: 0 auto;"> </center></div>';
                                    } else {
                                        echo '<div class="carousel-item active center-block"><center>';
                                        echo '<a href="https://iraqibayt.com/storage/app/public/posts/'.$id->img.'" data-toggle="lightbox" data-gallery="example-gallery" ><img class="center-block img-fluid " src="https://iraqibayt.com/storage/app/public/posts/'.$id->img.'" style="height:350px;display: block;
    margin-left: 0 auto;
    margin-right: 0 auto;"> </a></center></div>';
                                    }
                                    
                                    foreach ($id->imgs as $img) {
                                        echo '<div class="carousel-item center-block" style="text-align:center;"><center>';
                                    
                                        $data = getimagesize('https://iraqibayt.com/storage/app/public/posts/' . $img);
                                        $width = $data[0];
                                        $height = $data[1];
                                    
                                        if ($width > $height) {
                                            $new_width = (350 * $width) / $height;
                                            echo '<a href="https://iraqibayt.com/storage/app/public/posts/'.$img.'" data-toggle="lightbox" data-gallery="example-gallery" ><img class="center-block img-fluid " onclick="openModal();currentSlide('.$counter.')" src="https://iraqibayt.com/storage/app/public/posts/'.$img.'" style="width:'.$new_width.'px;height:350px;display: block;
    margin-left: 0 auto;
    margin-right: 0 auto;"> </a></center></div>';
                                        } elseif ($width < $height) {
                                            $new_width = (350 * $width) / $height;
                                            echo '<a href="https://iraqibayt.com/storage/app/public/posts/'.$img.'" data-toggle="lightbox" data-gallery="example-gallery" ><img class="center-block img-fluid " onclick="openModal();currentSlide('.$counter.')" src="https://iraqibayt.com/storage/app/public/posts/'.$img.'" style="width:'.$new_width.'px;height:350px;display: block;
    margin-left: 0 auto;
    margin-right: 0 auto;"> </a></center></div>';
                                        } elseif ($width == $height) {
                                            echo '<a href="https://iraqibayt.com/storage/app/public/posts/'.$img.'" data-toggle="lightbox" data-gallery="example-gallery" ><img class="center-block img-fluid " onclick="openModal();currentSlide('.$counter.')" src="https://iraqibayt.com/storage/app/public/posts/'.$img.'" style="width:350px;height:350px;display: block;
    margin-left: 0 auto;
    margin-right: 0 auto;"> </a></center></div>';
                                        }
                                        $counter++;
                                    }
                                    
                                @endphp
                            </div>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle-fill"
                                    fill="black" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z" />
                                </svg>
                            </a>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-left-circle-fill"
                                    fill="black" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z" />
                                </svg>
                            </a>


                        </div>

                    </div>


                    <div class="info text-left ">
                        <p class="mt-2"><i class="fa fa-map-marker-alt t-bl"></i> <span>{{ $id->city->name ?? ' ' }} -
                                {{ $id->region->name ?? ' ' }}</span></p>
                        <p class="mt-2"><i class="fa fa-info-circle t-bl"></i>
                            <span>{{ $id->category->name . '-' . $id->sub->name }}</span>
                        </p>
                        <p class="mt-2"><i class="fa fa-chart-area t-bl"></i>
                            <span>{{ $id->area . '-' . $id->unit->name }}</span>
                        </p>
                        <p class="mt-2"><i class="fa fa-calendar-alt t-bl"></i> <span>{{ $id->created_at }}</span></p>
                        <p class="mt-2"><i class="fa fa-user-plus t-bl"></i><span>أضافه : <a
                                    href="/posts/{{ $id->user_id }}/user?username={{ $id->user->name }}">{{ $id->user->name }}</a></span>
                        </p>

                    </div>
                    <div class="text-left">

                        <div class="d-flex  mt-2 justify-content-between pr-3">
                            <table class="table">
                                <tr>
                                    <td> <i class="fa fa-map-marker-alt t-bl f-s-15"></i> المدينة:
                                        {{ $id->city->name ?? ' ' }}</td>
                                    <td>المنطقة: {{ $id->region->name ?? ' ' }}</td>
                                    @if ($id->sub->type == 'سكني')
                                        <td> <i class="fa fa-shower t-bl f-s-15"></i> عدد الحمامات: {{ $id->bathroom }}
                                        </td>
                                    @endif
                                </tr>

                                <tr>

                                    <td><i class="fa fa-pencil-ruler t-bl f-s-15"></i> المساحة :
                                        {{ $id->area . '-' . $id->unit->name }}</td>
                                    @if ($id->sub->type == 'سكني')
                                        <td colspan="2"> <i class="fa fa-procedures t-bl f-s-15"></i> عدد غرف النوم:
                                            {{ $id->bedroom }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td> <i class="fas fa-hand-holding-usd t-bl f-s-15"></i> السعر:
                                        {{ $id->price . '-' . $id->currancy->name }}</td>
                                    @if ($id->floor != null)
                                        <td> الطابق : {{ $id->floor }}</td>
                                    @endif
                                    <td {{ $id->floor == null ? 'colspan="2"' : '' }}> <i
                                            class="fa fa-cash-register t-bl f-s-15"></i> طريقة الدفع: {{ $id->payment }}
                                    </td>
                                </tr>
                                <tr>
                                    @if ($id->carage == 'تحتوي كراج')
                                        <td><i class="fa fa-warehouse t-bl f-s-15"></i>الكراج: {{ $id->carage }}</td>
                                        <td colspan="2"><i class="fa fa-car t-bl f-s-15"></i>عدد السيارات :
                                            {{ $id->num_car }}</td>
                                    @endif

                                </tr>
                            </table>


                        </div>
                        <div class="d-flex mt-2  justify-content-between pr-3">


                        </div>
                        <div class="d-flex mt-2  justify-content-between pr-3">


                        </div>
                        <div class="d-flex mt-2  justify-content-between pr-3">


                        </div>


                    </div>
                    <div class="text-left mt-4">
                        <h4 class="text-left"><i class="fa fa-circle mr-2 text-muted small"></i> <span>وصف وتفاصيل
                                الإعلان</span></h4>
                        <p class="lead mt-3 ml-4">{{ $id->description }}</p>
                    </div>
                    <div class="text-left mt-4">
                        <h4 class="text-left mb-3"><i class="fa fa-circle mr-2 text-muted small"></i> <span>التواصل عن
                                طريق</span></h4>
                        <p class="lead mt-3 ml-4">
                            <span class="text-muted d-block">يمكنك التواصل معي على الرقم <span
                                    class="t-bl">{{ $id->phone }}</span> </span>

                            @foreach (array_unique($id->contact) as $c)
                                @php
                                    $tel='';
                                    $icon='';
                                    $class = '';
                                    switch ($c) {
                                        case 'واتسآب':
                                            $tel='https://wa.me/' . $id->phone;
                                            $icon='fab fa-whatsapp';
                                            $class = 'btn-success';
                                            break;
                                        case 'إتصال مباشر':
                                            $tel='https://tel:' . $id->phone;
                                            $icon='fa fa-phone';
                                            $class = 'btn-dark';
                                            break;
                                        case 'فايبر':
                                            $tel='viber://chat?number=' . $id->phone;
                                            $icon="fab fa-viber";
                                            $class = 'btn-purple';
                                    
                                            break;
                                        case 'تلغرام':
                                            $tel='https://t.me/' . $id->phone;
                                            $icon='fab fa-telegram';
                                            $class = 'btn-primary';
                                    
                                            break;
                                    }
                                @endphp
                                <button onclick="location.href = '{{ $tel }}';" type="button"
                                    class="btn {{ $class }} btn-circle btn-lg mt-3">
                                    <i class="{{ $icon }}"></i>
                                </button>
                            @endforeach
                        </p>
                    </div>
                    <div class="text-left mt-4">
                        @if (isset($myFavorite))
                            @if ($myFavorite->count() > 0)
                                <button class="btn btn-lg btn-info mt-3" type="button">ضمن المفضلة <li
                                        class="fa fa-heart"></li></button>
                            @else
                                <button class="btn btn-lg btn-danger mt-3" onclick="addFav({{ $id->id }});"
                                    type="button">إضافة إلى المفضلة <li class="fa fa-heart"></li></button>
                            @endif
                        @else
                            <button class="btn btn-lg btn-danger mt-3" onclick="addFav({{ $id->id }});"
                                type="button">إضافة إلى المفضلة <li class="fa fa-heart"></li></button>
                        @endif
                    </div>

                    @auth()
                        <div class="text-left mt-3">
                            <h4 class="text-left"><i class="fa fa-circle mr-2 text-muted small"></i> <span>إضافة تعليق</span>
                            </h4>
                            <add-comment-component post_id="{{ $id->id }}" user_id="{{ auth()->id() }}">
                            </add-comment-component>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="row  mt-5">
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12 mt-5">
            <h5 class="text-left"><i class="fa fa-circle mr-2 t-orange"></i>إعلانات مشابهة</h5>
        </div>
        @foreach ($posts as $post)
            <div class="col-md-3 mb-3">

                <div class="card img-thumbnail padd  text-left bg-wd mt-2" style=" position: relative;;height:500px">
                    <a class="d-block text-dark" style="height:40%" href="{{ url('/post/' . $post->id . '/show') }}">
                        <div class="category-tag">{{ $post->sub->name }}</div>
                        <div class="price-tag">{{ $post->price }} {{ $post->currancy->name }}</div>
                        @if ($post->img != null)
                            <img src="{{ asset('storage/app/public/posts/' . $post->img) }}"
                                class="card-img-top none-border-radius img-fluid" style="height: 100%" alt="...">
                        @else
                            <img src="https://iraqibayt.com/storage/app/public/posts/{{ $default_img }}"
                                class="card-img-top none-border-radius  img-fluid" style="height: 100%" alt="...">
                        @endif
                    </a>
                    <a class="d-block text-dark" href="{{ url('/post/' . $post->id . '/show') }}">

                        <div class="card-body">
                            <h6 class="card-title text-center small p-0 mb-2">
                                {{ \Illuminate\Support\Str::substr($post->title, 0, 45) }}
                            </h6>
                            <hr class="w-100 p-0 m-0">
                            {{-- <p class="card-text text-left">{{\Illuminate\Support\Str::substr($post->description,0,85)}}</p> --}}
                            <span class="text-left d-block mt-1"><i class="fa fa-map-marker-alt t-bl"></i>
                                {{ $post->city->name }}- {{ $post->region->name }}</span>
                            <span class="text-left d-block mt-1"><i class="fa fa-expand t-bl"></i> مساحة العقار :
                                {{ $post->area }} {{ $post->unit->name }}</span>
                            <span class="text-left d-block mt-1"><i class="fa fa-plus-square t-bl"></i> أضيف :
                                {{ $post->created_at }}</span>
                            <div class="d-flex justify-content-around mt-2">
                                <div class="text-center mb-2 mt-2">
                                    <div class="icon-rounded text-center bg-bl pt-1 d-block"> <i
                                            class="fa fa-car text-white"></i></div><span class="small d-block">
                                        @if ($post->num_car == '' || $post->num_car == ' ' || $post->num_car == null)
                                            0
                                        @else
                                            {{ $post->num_car }}
                                        @endif
                                    </span>
                                </div>
                                <div class="text-center mb-2 mt-2">
                                    <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                            class="fa fa-bed text-white"></i></div><span
                                        class="d-block small">{{ $post->bedroom }}</span>
                                </div>
                                <div class="text-center mb-2 mt-2">
                                    <div class="icon-rounded text-center bg-bl pt-1 d-inline-block"><i
                                            class="fa fa-bath text-white"></i></div><span
                                        class="d-block small">{{ $post->bathroom }}</span>
                                </div>

                            </div>
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
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class=" modal fade" id="exampleModal2" role="dialog" tabindex="-1" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إبلاغ عن العرض</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send.clim') }}" method="post">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $id->id }}">
                        <div class="form-group">
                            <select name="type" class="form-control">
                                <option value="إساءة">إساءة</option>
                                <option value="مشكلة">مشكلة</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="أكتب وصف الإبلاغ"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>

                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    @if (session()->has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                text: "{{ session('success') }}"
            })
        </script>
    @endif



    <script>
        function addFav(pid) {
            axios.get(base_site + '/favorit/' + pid + '/store')
                .then(function(response) {
                    if (response.status == 200 || response.status == 201) {
                        Toast.fire({
                            icon: 'success',
                            text: 'تمت الإضافة إلى المفضلة'
                        }).then(function() {
                            location.href = base_site + '/post/' + pid + '/show';
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
