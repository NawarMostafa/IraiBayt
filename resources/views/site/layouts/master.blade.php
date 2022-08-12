@php 
use \App\Http\Controllers\Site\DepartController; 
use App\Depart;

@endphp
 
<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/css/bootstrap-rtl.min.css" integrity="sha512-+1C9xBCl0azgGjU6bIsATfB4XOQ0MSFduPs388NiyzwYt4nfelS72KSPSFZT338FjP7F3mMme2re8+gUJe2HZQ==" crossorigin="anonymous" />
	<link rel="stylesheet" href="{{asset('/css/app-site.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap-modal-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/ekko-lightbox.css') }}">
    <link rel="icon" href="https://iraqibayt.com/storage/app/public/images/1604088157.fav_icon.png">
    <meta name="base_storage" content="{{asset('storage/app/public/')}}">
    <meta name="base_site" content="{{url('/')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<meta name="keywords" content="البيت العراقي, العراق, عقارات العراق, طقس العراق, عملات العراق, قوانين العراق, نصائح عن العقارات,">
    <style>
        @font-face {
            src: url("{{asset('public/fonts/neo.ttf')}}");
            font-family: 'neo';
        }
        @font-face {
            src: url("{{asset('public/fonts/digital-7.ttf')}}");
            font-family: 'digital';
        }
        body {
            min-height: 100vh !important;
        }
        .footer {
            position: relative;
            bottom: 0px;
            z-index: 10000000;
        }
        .border-right-1{
            border-left: 1px solid #000000;
        }
        .dashboard-btn{
            position: fixed;
            top:45%;
            left:0px;
            z-index:1000000
        }

		

        .carousel-control-next-icon {
		background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='red' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
		}

		.carousel-control-prev-icon {
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='red' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");

			
		}
		.carousel-control-next-dev{
			border: 2px solid #000;
			
		}

		.ekko-lightbox-nav-overlay a{opacity:1;transition:opacity 1s;color:#fff;}
				
		.modal-dialog .ekko-lightbox-loader>div>div{background-color:#000;opacity:0;}



		.close{
			color: #000;
			float: left;
		}

		.modal-backdrop{
		backdrop-filter: blur(5px);
		background-color: #000000;
		}
		.modal-backdrop.in{
		opacity: 1 !important;
		}


		
		label
		{
			margin-right: 8px;
		}
		

		/* Dropdown menu css style */

		
		.dd 
		{
			z-index:1;
			position:relative;
			display: inline-block;
			width: 100%;
			margin-right: 30px;
		}
		.dd-a 
		{
			padding:5px 5px 5px 5px;
			background:white;
			position:relative;
			-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.0);
			-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.0);
			box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.0);
			transition-duration: 0.2s;
			-webkit-transition-duration: 0.2s;
			border-radius: 5px;
			text-align: right;
		}
		/* .dd-a>span{
			margin-right: 15px;
		} */
		.dd>input:after 
		{
			content:"";
			width:100%;
			height:2px;
			position:absolute;
			display:block;
			background:#C63D0F;
			bottom:0;
			right:0;
			transform: scaleX(0);
			transform-origin: bottom left;
			transition-duration: 0.2s;
			-webkit-transform: scaleX(0);
			-webkit-transform-origin: bottom left;
			-webkit-transition-duration: 0.2s;
		}
		.dd>input 
		{
			top:0;
			opacity:0;
			display:block;
			padding:0;
			margin:0;
			border:0;
			position:absolute;
			height:100%;
			width:100%;
		}
		.dd>input:hover 
		{
			cursor:pointer;
		}
		.dd>input:hover ~ .dd-a 
		{
			-webkit-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
			-moz-box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
			box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
		}
		.dd>input:checked:after 
		{
			transform: scaleX(1);
			-webkit-transform: scaleX(1);
		}
		.dd>input:checked ~ .dd-c 
		{
			transform: scaleY(1);
			-webkit-transform: scaleY(1);
		}
		
		.dd-c
		{
			display:block;
			position: absolute;
			background:white;
			height:auto;
			width:auto;
			transform: scaleY(0);
			transform-origin: top left;
			transition-duration: 0.2s;
			-webkit-transform: scaleY(0);
			-webkit-transform-origin: top left;
			-webkit-transition-duration: 0.2s;
			right: 0px;
		}
		.dd-c ul 
		{
			margin:0;
			padding:0;
			list-style-type: none;
		}
		.dd-c li 
		{
			margin-top:5px;
			word-break: keep-all;
			white-space:nowrap;
			display:block;
			position:relative;
			align-items: right;
		}



    </style>
    @isset($title)
    <title>{{$setting->name}} - {{$title}}</title>
	<meta name="description" content="{{$setting->name}} - {{$title}}">

    @else
    <title>{{$setting->name}}</title>
	<meta name="description" content="{{$setting->name}} ">

    @endisset


    

</head>
<body>

@if(auth()->check() && (auth()->user()->role=='admin' ||
                        auth()->user()->role=='RealEstate-admin' ||
                        auth()->user()->role=='Currancy-admin' ||
                        auth()->user()->role=='Weather-admin' ||
                        auth()->user()->role=='Material-admin' ||
                        auth()->user()->role=='Quiz-admin' ||
                        auth()->user()->role=='Rules-admin' ||
                        auth()->user()->role=='AboutIraq-admin' ||
                        auth()->user()->role=='Info-admin' ||
                        auth()->user()->role=='Analize-admin' ))
<a href="{{url('dashboard/settings')}}" class="btn btn-sm btn-success dashboard-btn"><i class="fas fa-tachometer-alt"></i></a>
@endif

<main id="app">

<div class="container-fullwidth mb-3">
    
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top navbar-dark " style="background:#275879;" >

    <div class="container mb-3">
    

    <div class="d-flex align-items-center justify-content-between" style="color:#fff;">
  <button class="navbar-toggler navbar-toggler-left" style="color:#ffffff;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color:#ffffff;"><i class="fas fa-bars" style="color:#fff; font-size:28px;"></i></span>
  </button>
  <a class="navbar-brand " href="{{url('/')}}" >
            <img  src="{{$setting->logo}}" width="188" height="75" class="d-inline-block align-top" alt="">
  </a>

  @if(auth()->check())
  <div class="dd">
        <div class="dd-a">
          <i class="fa fa-bell"
          ><span
            id="badge-content"
            class="badge bg-danger"
          ></span
        ></i>
        </div>
        <input type="checkbox" />
        
        <div
          class="dd-c"
        >
        <ul>
            <li>
                <div class="media">
                    <div class="media-body">
                        <h6 class="media-heading text-right">
                            لا يوجد أي إشعارات حتى الآن
                        </h6>
                        <small style="direction: ltr">
                            <p class="text-muted text-right" style="direction: ltr"></p>
                        </small>
                    </div>
                </div>
            </li>
        </ul>
        </div>
      </div>
	@endif
</div>

    

    
      
  
        
            <form class="form-inline">
                    @if(!auth()->check())
                                <a href="{{route('register')}}" class="btn btn-light ml-2" type="button"><span class="item-label" style="color:#000;">تسجيل </span><i
                                            class="fa fa-user-plus"></i> </a>
                            <a href="{{route('login')}}" class="btn btn-light ml-2" type="button"><span class="item-label" style="color:#000;">دخول </span><i
                                            class="fa fa-sign-in-alt"></i></a>
                            @else
                                <a href="{{route('SignOut')}}" class="btn btn-light ml-2" type="button"><span class="item-label" style="color:#000;"> تسجيل
                                    الخروج </span><i class="fa fa-sign-out-alt"></i> </a>
                                <a href="{{route('profile.edit')}}" class="btn btn-light ml-2" type="button"><span class="item-label" style="color:#000;" > حسابي </span><i class="fa fa-user"></i></a>
                            @endif
                            {{--<a href="" class="btn btn-light" type="button"><i class="fa fa-plus"></i> --}}{{--<img class="img-fluid img-add-ads"  src="{{asset('public/img/add.png')}}" alt="">--}}{{--</a>--}}
                            <a href="{{route('add.post')}}" class="btn btn-dager ml-2" style="background:#ed5f59;color:#ffffff" type="button"><span class="item-label" style="color:#fff;">أضف إعلانك
                                مجانا</span> <i class="fa fa-plus"></i> </a>

            </form>

            


  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="color:#fff;">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item ">
        <a class="nav-link" style="text-align: right;" href="https://iraqibayt.com/">الرئيسية <span class="sr-only">(current)</span></a>
      </li>
      
      
        @php
            $departs = Depart::all();
        @endphp

        @foreach($departs as $dep)
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
            $link = "https://iraqibayt.com/depart/".$dep_id;
        }

        if($dep_id > 8){
            $name = $dep->name;
            $img = 'https://iraqibayt.com/storage/app/public/images/'.$dep->img;
        }else{
            $name = $dep->data['name'];
            $img  = 'https://iraqibayt.com/storage/app/public/images/'.$dep->data['img'];
        }
         
       @endphp
       <li class="nav-item " style="text-align: right;" style="color:#c3e5f2;" >
        <a class="nav-link" href="{{$link}}" style="color:#c3e5f2;" >{{$name}} </a>
    </li>

        @endforeach
    </ul>
    
    </div>
    </div>
    </nav>

    </div>

<div class="container">
@isset($title)
    
    <div class="row">
    <div class="col-md-12 p-12  mt-5" style="text-align: right;"><span style="font-size: 30px;">{{$title}}</span><hr  style="width:100%;" /></div>
    
    
    </div>
    @endisset

    @yield('content')

    @php

    $email = '';

    if(auth()->check()){
        $email = auth()->user()->email;
    }
    @endphp


        <div id="contactUs" class="mt-5">
            <contact-us-component email="{{$email}}"></contact-us-component>
        </div>
</div>



<!-- Footer -->
<footer class="page-footer font-small blue pt-4" style="background:#275879;color:#ffffff;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">


    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-3 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase" style="color:#ff9f9b;"></h5>
        <img  src="{{$setting->logo}}" width="188" height="75" class="d-inline-block align-top" alt="">
		</br></br>
                    <ul class="nav">
                        <li class="nav-item p-0 m-0">
                            <a class="nav-link f-s-30 p-2 m-0" href="{{$setting->face}}"><i class="fab fa-facebook-square" style="color:#c3e5f2;"></i></a>
                        </li>
                        <li class="nav-item p-0 m-0">
                            <a class="nav-link f-s-30 p-2 m-0" href="{{$setting->twitter}}"><i class="fab fa-twitter-square" style="color:#c3e5f2;"></i></a>
                        </li>
                        <li class="nav-item p-0 m-0">
                            <a class="nav-link f-s-30 p-2 m-0" href="{{$setting->lenkedin}}"><i class="fab fa-linkedin" style="color:#c3e5f2;"></i></a>
                        </li>
                    </ul>
					<a href=""><img src="https://iraqibayt.com/storage/app/public/cats/60146cff229ad.png" width="200px" height="65px"/></a><br />
					<a href="https://play.google.com/store/apps/details?id=com.iraqibayt&hl=en_US&gl=US"><img src="https://iraqibayt.com/storage/app/public/cats/60146d2c15fd4.png" width="200px" height="65px"/></a>

	  	
      </div>
	  <div class="col-md-3 mb-md-0 mb-3">
	  
	  </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h4 class="text-uppercase" style="color:#c3e5f2;">أقسام الموقع</h4></br>

        <ul class="list-unstyled">
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
                                $link = "https://iraqibayt.com/depart/".$dep_id;
                            }

                            if($dep_id > 8){
                                $name = $dep->name;
                                $img = 'https://iraqibayt.com/storage/app/public/images/'.$dep->img;
                            }else{
                                $name = $dep->data['name'];
                                $img  = 'https://iraqibayt.com/storage/app/public/images/'.$dep->data['img'];
                            }
                            @endphp
                            <li class="nav-item p-0 m-0">
                            <a class="nav-link  p-0 m-0" style="color:#ffffff;" href="{{$link}}">{{$name}}</a>
                            </li>
                       @endforeach
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h4 class="text-uppercase" style="color:#c3e5f2;" >صفحات الموقع</h4>
                        </br>
        <ul class="list-unstyled">
          <li>
          <a class="nav-link  p-0 m-0" style="color:#ffffff;" href="{{url('aboutUs')}}">من نحن</a>
          </li>
          <li>
          <a class="nav-link active p-0 m-0" style="color:#ffffff;" href="{{url('Privacy')}}">سياسة الخصوصية</a>
          </li>
          <li>
          <a class="nav-link active p-0 m-0" style="color:#ffffff;" href="{{url('terms')}}">شروط الإستخدام</a>
          </li>
          <li>
          <a class="nav-link active p-0 m-0" style="color:#ffffff;" href="https://iraqibayt.com/sitemap"> خريطة الموقع</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">جميع الحقوق محفوظة لموقع <a href="{{url('/')}}">
                        البيت العراقي</a>&copy; {{date('Y')}}</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

</main>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
<script>

    /*!
 * Lightbox for Bootstrap by @ashleydw
 * https://github.com/ashleydw/lightbox
 *
 * License: https://github.com/ashleydw/lightbox/blob/master/LICENSE
 */
+function ($) {

'use strict';

var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ('value' in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError('Cannot call a class as a function'); } }

var Lightbox = (function ($) {

	var NAME = 'ekkoLightbox';
	var JQUERY_NO_CONFLICT = $.fn[NAME];

	var Default = {
		title: '',
		footer: '',
		maxWidth: 9999,
		maxHeight: 9999,
		showArrows: true, //display the left / right arrows or not
		wrapping: true, //if true, gallery loops infinitely
		type: null, //force the lightbox into image / youtube mode. if null, or not image|youtube|vimeo; detect it
		alwaysShowClose: false, //always show the close button, even if there is no title
		loadingMessage: '<div class="ekko-lightbox-loader"><div><div></div><div></div></div></div>', // http://tobiasahlin.com/spinkit/
		leftArrow: '<span style="background:#000;">&#10095;</span>',
		rightArrow: '<span style="background:#000;">&#10094;</span>',
		strings: {
			close: 'Close',
			fail: 'Failed to load image:',
			type: 'Could not detect remote target type. Force the type using data-type'
		},
		doc: document, // if in an iframe can specify top.document
		onShow: function onShow() {},
		onShown: function onShown() {},
		onHide: function onHide() {},
		onHidden: function onHidden() {},
		onNavigate: function onNavigate() {},
		onContentLoaded: function onContentLoaded() {}
	};

	var Lightbox = (function () {
		_createClass(Lightbox, null, [{
			key: 'Default',

			/**
       Class properties:
   	 _$element: null -> the <a> element currently being displayed
    _$modal: The bootstrap modal generated
       _$modalDialog: The .modal-dialog
       _$modalContent: The .modal-content
       _$modalBody: The .modal-body
       _$modalHeader: The .modal-header
       _$modalFooter: The .modal-footer
    _$lightboxContainerOne: Container of the first lightbox element
    _$lightboxContainerTwo: Container of the second lightbox element
    _$lightboxBody: First element in the container
    _$modalArrows: The overlayed arrows container
   	 _$galleryItems: Other <a>'s available for this gallery
    _galleryName: Name of the current data('gallery') showing
    _galleryIndex: The current index of the _$galleryItems being shown
   	 _config: {} the options for the modal
    _modalId: unique id for the current lightbox
    _padding / _border: CSS properties for the modal container; these are used to calculate the available space for the content
   	 */

			get: function get() {
				return Default;
			}
		}]);

		function Lightbox($element, config) {
			var _this = this;

			_classCallCheck(this, Lightbox);

			this._config = $.extend({}, Default, config);
			this._$modalArrows = null;
			this._galleryIndex = 0;
			this._galleryName = null;
			this._padding = null;
			this._border = null;
			this._titleIsShown = false;
			this._footerIsShown = false;
			this._wantedWidth = 0;
			this._wantedHeight = 0;
			this._touchstartX = 0;
			this._touchendX = 0;

			this._modalId = 'ekkoLightbox-' + Math.floor(Math.random() * 1000 + 1);
			this._$element = $element instanceof jQuery ? $element : $($element);

			this._isBootstrap3 = $.fn.modal.Constructor.VERSION[0] == 3;

			var h4 = '<h4 class="modal-title">' + (this._config.title || "&nbsp;") + '</h4>';
			var btn = '<button type="button" class="close" data-dismiss="modal" aria-label="' + this._config.strings.close + '" style="font-size:50px; color:#fff;"><span aria-hidden="true">&times;</span></button>';

			var header = '<div class="modal-header' + (this._config.title || this._config.alwaysShowClose ? '' : ' hide') + '">' + (this._isBootstrap3 ? btn + h4 : h4 + btn) + '</div>';
			var footer = '<div class="modal-footer' + (this._config.footer ? '' : ' hide') + '">' + (this._config.footer || "&nbsp;") + '</div>';
			var body = '<div class="modal-body" style="padding:0;"><div class="ekko-lightbox-container"><div class="ekko-lightbox-item fade in show"></div><div class="ekko-lightbox-item fade"></div></div></div>';
			var dialog = '<div class="modal-dialog" role="document" ><div class="modal-content" style="background:rgba(0,0,0,0);">' +btn +  body +  '</div></div>';
			$(this._config.doc.body).append('<div id="' + this._modalId + '" class="ekko-lightbox modal fade" tabindex="-1" tabindex="-1" role="dialog" aria-hidden="true">' + dialog + '</div>');

			this._$modal = $('#' + this._modalId, this._config.doc);
			this._$modalDialog = this._$modal.find('.modal-dialog').first();
			this._$modalContent = this._$modal.find('.modal-content').first();
			this._$modalBody = this._$modal.find('.modal-body').first();
			this._$modalHeader = this._$modal.find('.modal-header').first();
			this._$modalFooter = this._$modal.find('.modal-footer').first();

			this._$lightboxContainer = this._$modalBody.find('.ekko-lightbox-container').first();
			this._$lightboxBodyOne = this._$lightboxContainer.find('> div:first-child').first();
			this._$lightboxBodyTwo = this._$lightboxContainer.find('> div:last-child').first();

			this._border = this._calculateBorders();
			this._padding = this._calculatePadding();

			this._galleryName = this._$element.data('gallery');
			if (this._galleryName) {
				this._$galleryItems = $(document.body).find('*[data-gallery="' + this._galleryName + '"]');
				this._galleryIndex = this._$galleryItems.index(this._$element);
				$(document).on('keydown.ekkoLightbox', this._navigationalBinder.bind(this));

				// add the directional arrows to the modal
				if (this._config.showArrows && this._$galleryItems.length > 1) {
					this._$lightboxContainer.append('<div class="ekko-lightbox-nav-overlay " ><a href="#" style="position: fixed;left: 0;top: 0;bottom:0;  font-size:50px;">' + this._config.leftArrow + '</a><a href="#" style="position: fixed;right: 0;top:0;bottom:0; font-size:50px;">' + this._config.rightArrow + '</a></div>');
					this._$modalArrows = this._$lightboxContainer.find('div.ekko-lightbox-nav-overlay').first();
					this._$lightboxContainer.on('click', 'a:first-child', function (event) {
						event.preventDefault();
						return _this.navigateLeft();
					});
					this._$lightboxContainer.on('click', 'a:last-child', function (event) {
						event.preventDefault();
						return _this.navigateRight();
					});
					this.updateNavigation();
				}
			}

			this._$modal.on('show.bs.modal', this._config.onShow.bind(this)).on('shown.bs.modal', function () {
				_this._toggleLoading(true);
				_this._handle();
				return _this._config.onShown.call(_this);
			}).on('hide.bs.modal', this._config.onHide.bind(this)).on('hidden.bs.modal', function () {
				if (_this._galleryName) {
					$(document).off('keydown.ekkoLightbox');
					$(window).off('resize.ekkoLightbox');
				}
				_this._$modal.remove();
				return _this._config.onHidden.call(_this);
			}).modal(this._config);

			$(window).on('resize.ekkoLightbox', function () {
				_this._resize(_this._wantedWidth, _this._wantedHeight);
			});
			this._$lightboxContainer.on('touchstart', function () {
				_this._touchstartX = event.changedTouches[0].screenX;
			}).on('touchend', function () {
				_this._touchendX = event.changedTouches[0].screenX;
				_this._swipeGesure();
			});
		}

		_createClass(Lightbox, [{
			key: 'element',
			value: function element() {
				return this._$element;
			}
		}, {
			key: 'modal',
			value: function modal() {
				return this._$modal;
			}
		}, {
			key: 'navigateTo',
			value: function navigateTo(index) {

				if (index < 0 || index > this._$galleryItems.length - 1) return this;

				this._galleryIndex = index;

				this.updateNavigation();

				this._$element = $(this._$galleryItems.get(this._galleryIndex));
				this._handle();
			}
		}, {
			key: 'navigateLeft',
			value: function navigateLeft() {

				if (!this._$galleryItems) return;

				if (this._$galleryItems.length === 1) return;

				if (this._galleryIndex === 0) {
					if (this._config.wrapping) this._galleryIndex = this._$galleryItems.length - 1;else return;
				} else //circular
					this._galleryIndex--;

				this._config.onNavigate.call(this, 'left', this._galleryIndex);
				return this.navigateTo(this._galleryIndex);
			}
		}, {
			key: 'navigateRight',
			value: function navigateRight() {

				if (!this._$galleryItems) return;

				if (this._$galleryItems.length === 1) return;

				if (this._galleryIndex === this._$galleryItems.length - 1) {
					if (this._config.wrapping) this._galleryIndex = 0;else return;
				} else //circular
					this._galleryIndex++;

				this._config.onNavigate.call(this, 'right', this._galleryIndex);
				return this.navigateTo(this._galleryIndex);
			}
		}, {
			key: 'updateNavigation',
			value: function updateNavigation() {
				if (!this._config.wrapping) {
					var $nav = this._$lightboxContainer.find('div.ekko-lightbox-nav-overlay');
					if (this._galleryIndex === 0) $nav.find('a:first-child').addClass('disabled');else $nav.find('a:first-child').removeClass('disabled');

					if (this._galleryIndex === this._$galleryItems.length - 1) $nav.find('a:last-child').addClass('disabled');else $nav.find('a:last-child').removeClass('disabled');
				}
			}
		}, {
			key: 'close',
			value: function close() {
				return this._$modal.modal('hide');
			}

			// helper private methods
		}, {
			key: '_navigationalBinder',
			value: function _navigationalBinder(event) {
				event = event || window.event;
				if (event.keyCode === 39) return this.navigateRight();
				if (event.keyCode === 37) return this.navigateLeft();
			}

			// type detection private methods
		}, {
			key: '_detectRemoteType',
			value: function _detectRemoteType(src, type) {

				type = type || false;

				if (!type && this._isImage(src)) type = 'image';
				if (!type && this._getYoutubeId(src)) type = 'youtube';
				if (!type && this._getVimeoId(src)) type = 'vimeo';
				if (!type && this._getInstagramId(src)) type = 'instagram';
				if (type == 'audio' || type == 'video' || !type && this._isMedia(src)) type = 'media';
				if (!type || ['image', 'youtube', 'vimeo', 'instagram', 'media', 'url'].indexOf(type) < 0) type = 'url';

				return type;
			}
		}, {
			key: '_getRemoteContentType',
			value: function _getRemoteContentType(src) {
				var response = $.ajax({
					type: 'HEAD',
					url: src,
					async: false
				});
				var contentType = response.getResponseHeader('Content-Type');
				return contentType;
			}
		}, {
			key: '_isImage',
			value: function _isImage(string) {
				return string && string.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i);
			}
		}, {
			key: '_isMedia',
			value: function _isMedia(string) {
				return string && string.match(/(\.(mp3|mp4|ogg|webm|wav)((\?|#).*)?$)/i);
			}
		}, {
			key: '_containerToUse',
			value: function _containerToUse() {
				var _this2 = this;

				// if currently showing an image, fade it out and remove
				var $toUse = this._$lightboxBodyTwo;
				var $current = this._$lightboxBodyOne;

				if (this._$lightboxBodyTwo.hasClass('in')) {
					$toUse = this._$lightboxBodyOne;
					$current = this._$lightboxBodyTwo;
				}

				$current.removeClass('in show');
				setTimeout(function () {
					if (!_this2._$lightboxBodyTwo.hasClass('in')) _this2._$lightboxBodyTwo.empty();
					if (!_this2._$lightboxBodyOne.hasClass('in')) _this2._$lightboxBodyOne.empty();
				}, 500);

				$toUse.addClass('in show');
				return $toUse;
			}
		}, {
			key: '_handle',
			value: function _handle() {

				var $toUse = this._containerToUse();
				this._updateTitleAndFooter();

				var currentRemote = this._$element.attr('data-remote') || this._$element.attr('href');
				var currentType = this._detectRemoteType(currentRemote, this._$element.attr('data-type') || false);

				if (['image', 'youtube', 'vimeo', 'instagram', 'media', 'url'].indexOf(currentType) < 0) return this._error(this._config.strings.type);

				switch (currentType) {
					case 'image':
						this._preloadImage(currentRemote, $toUse);
						this._preloadImageByIndex(this._galleryIndex, 3);
						break;
					case 'youtube':
						this._showYoutubeVideo(currentRemote, $toUse);
						break;
					case 'vimeo':
						this._showVimeoVideo(this._getVimeoId(currentRemote), $toUse);
						break;
					case 'instagram':
						this._showInstagramVideo(this._getInstagramId(currentRemote), $toUse);
						break;
					case 'media':
						this._showHtml5Media(currentRemote, $toUse);
						break;
					default:
						// url
						this._loadRemoteContent(currentRemote, $toUse);
						break;
				}

				return this;
			}
		}, {
			key: '_getYoutubeId',
			value: function _getYoutubeId(string) {
				if (!string) return false;
				var matches = string.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);
				return matches && matches[2].length === 11 ? matches[2] : false;
			}
		}, {
			key: '_getVimeoId',
			value: function _getVimeoId(string) {
				return string && string.indexOf('vimeo') > 0 ? string : false;
			}
		}, {
			key: '_getInstagramId',
			value: function _getInstagramId(string) {
				return string && string.indexOf('instagram') > 0 ? string : false;
			}

			// layout private methods
		}, {
			key: '_toggleLoading',
			value: function _toggleLoading(show) {
				show = show || false;
				if (show) {
					this._$modalDialog.css('display', 'none');
					this._$modal.removeClass('in show');
					$('.modal-backdrop').append(this._config.loadingMessage);
				} else {
					this._$modalDialog.css('display', 'block');
					this._$modal.addClass('in show');
					$('.modal-backdrop').find('.ekko-lightbox-loader').remove();
				}
				return this;
			}
		}, {
			key: '_calculateBorders',
			value: function _calculateBorders() {
				return {
					top: this._totalCssByAttribute('border-top-width'),
					right: this._totalCssByAttribute('border-right-width'),
					bottom: this._totalCssByAttribute('border-bottom-width'),
					left: this._totalCssByAttribute('border-left-width')
				};
			}
		}, {
			key: '_calculatePadding',
			value: function _calculatePadding() {
				return {
					top: this._totalCssByAttribute('padding-top'),
					right: this._totalCssByAttribute('padding-right'),
					bottom: this._totalCssByAttribute('padding-bottom'),
					left: this._totalCssByAttribute('padding-left')
				};
			}
		}, {
			key: '_totalCssByAttribute',
			value: function _totalCssByAttribute(attribute) {
				return parseInt(this._$modalDialog.css(attribute), 10) + parseInt(this._$modalContent.css(attribute), 10) + parseInt(this._$modalBody.css(attribute), 10);
			}
		}, {
			key: '_updateTitleAndFooter',
			value: function _updateTitleAndFooter() {
				var title = this._$element.data('title') || "";
				var caption = this._$element.data('footer') || "";

				this._titleIsShown = false;
				if (title || this._config.alwaysShowClose) {
					this._titleIsShown = true;
					this._$modalHeader.css('display', '').find('.modal-title').html(title || "&nbsp;");
				} else this._$modalHeader.css('display', 'none');

				this._footerIsShown = false;
				if (caption) {
					this._footerIsShown = true;
					this._$modalFooter.css('display', '').html(caption);
				} else this._$modalFooter.css('display', 'none');

				return this;
			}
		}, {
			key: '_showYoutubeVideo',
			value: function _showYoutubeVideo(remote, $containerForElement) {
				var id = this._getYoutubeId(remote);
				var query = remote.indexOf('&') > 0 ? remote.substr(remote.indexOf('&')) : '';
				var width = this._$element.data('width') || 560;
				var height = this._$element.data('height') || width / (560 / 315);
				return this._showVideoIframe('//www.youtube.com/embed/' + id + '?badge=0&autoplay=1&html5=1' + query, width, height, $containerForElement);
			}
		}, {
			key: '_showVimeoVideo',
			value: function _showVimeoVideo(id, $containerForElement) {
				var width = this._$element.data('width') || 500;
				var height = this._$element.data('height') || width / (560 / 315);
				return this._showVideoIframe(id + '?autoplay=1', width, height, $containerForElement);
			}
		}, {
			key: '_showInstagramVideo',
			value: function _showInstagramVideo(id, $containerForElement) {
				// instagram load their content into iframe's so this can be put straight into the element
				var width = this._$element.data('width') || 612;
				var height = width + 80;
				id = id.substr(-1) !== '/' ? id + '/' : id; // ensure id has trailing slash
				$containerForElement.html('<iframe width="' + width + '" height="' + height + '" src="' + id + 'embed/" frameborder="0" allowfullscreen></iframe>');
				this._resize(width, height);
				this._config.onContentLoaded.call(this);
				if (this._$modalArrows) //hide the arrows when showing video
					this._$modalArrows.css('display', 'none');
				this._toggleLoading(false);
				return this;
			}
		}, {
			key: '_showVideoIframe',
			value: function _showVideoIframe(url, width, height, $containerForElement) {
				// should be used for videos only. for remote content use loadRemoteContent (data-type=url)
				height = height || width; // default to square
				$containerForElement.html('<div class="embed-responsive embed-responsive-16by9"><iframe width="' + width + '" height="' + height + '" src="' + url + '" frameborder="0" allowfullscreen class="embed-responsive-item"></iframe></div>');
				this._resize(width, height);
				this._config.onContentLoaded.call(this);
				if (this._$modalArrows) this._$modalArrows.css('display', 'none'); //hide the arrows when showing video
				this._toggleLoading(false);
				return this;
			}
		}, {
			key: '_showHtml5Media',
			value: function _showHtml5Media(url, $containerForElement) {
				// should be used for videos only. for remote content use loadRemoteContent (data-type=url)
				var contentType = this._getRemoteContentType(url);
				if (!contentType) {
					return this._error(this._config.strings.type);
				}
				var mediaType = '';
				if (contentType.indexOf('audio') > 0) {
					mediaType = 'audio';
				} else {
					mediaType = 'video';
				}
				var width = this._$element.data('width') || 560;
				var height = this._$element.data('height') || width / (560 / 315);
				$containerForElement.html('<div class="embed-responsive embed-responsive-16by9"><' + mediaType + ' width="' + width + '" height="' + height + '" preload="auto" autoplay controls class="embed-responsive-item"><source src="' + url + '" type="' + contentType + '">' + this._config.strings.type + '</' + mediaType + '></div>');
				this._resize(width, height);
				this._config.onContentLoaded.call(this);
				if (this._$modalArrows) this._$modalArrows.css('display', 'none'); //hide the arrows when showing video
				this._toggleLoading(false);
				return this;
			}
		}, {
			key: '_loadRemoteContent',
			value: function _loadRemoteContent(url, $containerForElement) {
				var _this3 = this;

				var width = this._$element.data('width') || 560;
				var height = this._$element.data('height') || 560;

				var disableExternalCheck = this._$element.data('disableExternalCheck') || false;
				this._toggleLoading(false);

				// external urls are loading into an iframe
				// local ajax can be loaded into the container itself
				if (!disableExternalCheck && !this._isExternal(url)) {
					$containerForElement.load(url, $.proxy(function () {
						return _this3._$element.trigger('loaded.bs.modal');l;
					}));
				} else {
					$containerForElement.html('<iframe src="' + url + '" frameborder="0" allowfullscreen></iframe>');
					this._config.onContentLoaded.call(this);
				}

				if (this._$modalArrows) //hide the arrows when remote content
					this._$modalArrows.css('display', 'none');

				this._resize(width, height);
				return this;
			}
		}, {
			key: '_isExternal',
			value: function _isExternal(url) {
				var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
				if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol) return true;

				if (typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(':(' + ({
					"http:": 80,
					"https:": 443
				})[location.protocol] + ')?$'), "") !== location.host) return true;

				return false;
			}
		}, {
			key: '_error',
			value: function _error(message) {
				console.error(message);
				this._containerToUse().html(message);
				this._resize(300, 300);
				return this;
			}
		}, {
			key: '_preloadImageByIndex',
			value: function _preloadImageByIndex(startIndex, numberOfTimes) {

				if (!this._$galleryItems) return;

				var next = $(this._$galleryItems.get(startIndex), false);
				if (typeof next == 'undefined') return;

				var src = next.attr('data-remote') || next.attr('href');
				if (next.attr('data-type') === 'image' || this._isImage(src)) this._preloadImage(src, false);

				if (numberOfTimes > 0) return this._preloadImageByIndex(startIndex + 1, numberOfTimes - 1);
			}
		}, {
			key: '_preloadImage',
			value: function _preloadImage(src, $containerForImage) {
				var _this4 = this;

				$containerForImage = $containerForImage || false;

				var img = new Image();
				if ($containerForImage) {
					(function () {

						// if loading takes > 200ms show a loader
						var loadingTimeout = setTimeout(function () {
							$containerForImage.append(_this4._config.loadingMessage);
						}, 200);

						img.onload = function () {
							if (loadingTimeout) clearTimeout(loadingTimeout);
							loadingTimeout = null;
							var image = $('<img />');
							image.attr('src', img.src);
							image.addClass('img-fluid');

							// backward compatibility for bootstrap v3
							image.css('width', '100%');

							$containerForImage.html(image);
							if (_this4._$modalArrows) _this4._$modalArrows.css('display', ''); // remove display to default to css property

							_this4._resize(img.width, img.height);
							_this4._toggleLoading(false);
							return _this4._config.onContentLoaded.call(_this4);
						};
						img.onerror = function () {
							_this4._toggleLoading(false);
							return _this4._error(_this4._config.strings.fail + ('  ' + src));
						};
					})();
				}

				img.src = src;
				return img;
			}
		}, {
			key: '_swipeGesure',
			value: function _swipeGesure() {
				if (this._touchendX < this._touchstartX) {
					return this.navigateRight();
				}
				if (this._touchendX > this._touchstartX) {
					return this.navigateLeft();
				}
			}
		}, {
			key: '_resize',
			value: function _resize(width, height) {

				height = height || width;
				this._wantedWidth = width;
				this._wantedHeight = height;

				var imageAspecRatio = width / height;

				// if width > the available space, scale down the expected width and height
				var widthBorderAndPadding = this._padding.left + this._padding.right + this._border.left + this._border.right;

				// force 10px margin if window size > 575px
				var addMargin = this._config.doc.body.clientWidth > 575 ? 20 : 0;
				var discountMargin = this._config.doc.body.clientWidth > 575 ? 0 : 20;

				var maxWidth = Math.min(width + widthBorderAndPadding, this._config.doc.body.clientWidth - addMargin, this._config.maxWidth);

				if (width + widthBorderAndPadding > maxWidth) {
					height = (maxWidth - widthBorderAndPadding - discountMargin) / imageAspecRatio;
					width = maxWidth;
				} else width = width + widthBorderAndPadding;

				var headerHeight = 0,
				    footerHeight = 0;

				// as the resize is performed the modal is show, the calculate might fail
				// if so, default to the default sizes
				if (this._footerIsShown) footerHeight = this._$modalFooter.outerHeight(true) || 55;

				if (this._titleIsShown) headerHeight = this._$modalHeader.outerHeight(true) || 67;

				var borderPadding = this._padding.top + this._padding.bottom + this._border.bottom + this._border.top;

				//calculated each time as resizing the window can cause them to change due to Bootstraps fluid margins
				var margins = parseFloat(this._$modalDialog.css('margin-top')) + parseFloat(this._$modalDialog.css('margin-bottom'));

				var maxHeight = Math.min(height, $(window).height() - borderPadding - margins - headerHeight - footerHeight, this._config.maxHeight - borderPadding - headerHeight - footerHeight);

				if (height > maxHeight) {
					// if height > the available height, scale down the width
					width = Math.ceil(maxHeight * imageAspecRatio) + widthBorderAndPadding;
				}

				this._$lightboxContainer.css('height', maxHeight);
				this._$modalDialog.css('flex', 1).css('maxWidth', width);

				var modal = this._$modal.data('bs.modal');
				if (modal) {
					// v4 method is mistakenly protected
					try {
						modal._handleUpdate();
					} catch (Exception) {
						modal.handleUpdate();
					}
				}
				return this;
			}
		}], [{
			key: '_jQueryInterface',
			value: function _jQueryInterface(config) {
				var _this5 = this;

				config = config || {};
				return this.each(function () {
					var $this = $(_this5);
					var _config = $.extend({}, Lightbox.Default, $this.data(), typeof config === 'object' && config);

					new Lightbox(_this5, _config);
				});
			}
		}]);

		return Lightbox;
	})();

	$.fn[NAME] = Lightbox._jQueryInterface;
	$.fn[NAME].Constructor = Lightbox;
	$.fn[NAME].noConflict = function () {
		$.fn[NAME] = JQUERY_NO_CONFLICT;
		return Lightbox._jQueryInterface;
	};

	return Lightbox;
})(jQuery);
//# sourceMappingURL=ekko-lightbox.js.map

}(jQuery);


</script>
<script src="{{asset('public/js/app-site.js?v=3')}}"></script>

<script>
    $(document).ready(function ($) {
                            // delegate calls to data-toggle="lightbox"
                            $(document).on('click', '[data-toggle="lightbox"]:not([data-gallery="navigateTo"]):not([data-gallery="example-gallery-11"])', function(event) {
                                event.preventDefault();
                                return $(this).ekkoLightbox({
                                    alwaysShowClose: true,
                                    onShown: function() {
                                        if (window.console) {
                                            return console.log('Checking our the events huh?');
                                        }
                                    },
                                    onNavigate: function(direction, itemIndex) {
                                        if (window.console) {
                                            return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                                        }
                                    }
                                });
                            });

                        });

</script>
@yield('js')



</body>
</html>