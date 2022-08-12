<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم| {{ $setting->name }}</title>
    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_storage" content="{{ asset('storage/app/public/') }}">
    {{-- <meta name="base_storage" content="{{storage_path('app/public/')}}"> --}}
    <meta name="base_site" content="{{ url('/') }}">
    <meta name="csrf" content="{{ csrf_token() }}">

    <link rel="icon" href="https://iraqibayt.com/storage/app/public/images/1604088157.fav_icon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/css/bootstrap-rtl.min.css"
        integrity="sha512-+1C9xBCl0azgGjU6bIsATfB4XOQ0MSFduPs388NiyzwYt4nfelS72KSPSFZT338FjP7F3mMme2re8+gUJe2HZQ=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">



    <style>
        @font-face {
            src: url("{{ asset('public/fonts/arbickufi.ttf') }}");
            font-family: 'janna';

        }

        * {
            font-family: 'janna';
        }

        .swal2-top-end {
            z-index: 10000 !important;
        }

        .modal {
            z-index: 10000;
        }

        select {
            border-radius: 0px !important;
        }
    </style>
    @yield('css')
</head>

<body class="hold-transition sidebar-mini swal2-rtl">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>

            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav mr-auto">


            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ $setting->logo }}" alt=" Logo" class="brand-image img-size-64 img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">معاينة الموقع</span>
            </a>


            @include('layouts.nav')

            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 100vh">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <ol class="breadcrumb bg-white p-1 ">

                                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                                @yield('bread')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content', 'Default Content')
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>جميع الحقوق محفوظة &copy; 2020 <a
                    href="mailto:{{ $setting->email }}">{{ $setting->name }}</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.5.2-1/js/bootstrap.min.js"
        integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ=="
        crossorigin="anonymous"></script>

    <script>
        $(function() {
            $('.has-treeview').click(function() {
                $(this).siblings().removeClass('menu-open').removeClass('active').children(
                    'ul.nav-treeview').css('display', 'none')
            });

        })
    </script>


    @yield('js')

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
