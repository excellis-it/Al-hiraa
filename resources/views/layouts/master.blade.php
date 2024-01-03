<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">
    <!-- Simplebar -->
    <link type="text/css" href="{{asset('assets/css/simplebar.min.css')}}" rel="stylesheet">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        rel="stylesheet">
    <!-- Slider -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link type="text/css" href="{{asset('assets/bootstrap-5.0.2/css/bootstrap.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    @stack('styles')
</head>

<body class="layout-default">
    <!-- <div class="preloader"></div> -->
    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        <div id="header" class="mdk-header js-mdk-header m-0 d-block d-xl-none">
            <div class="mdk-header__content">
                <div class="navbar navbar-expand-sm navbar-main mdk-header--fixed" id="navbar"
                    data-primary="data-primary">
                    <div class="container-fluid p-0">
                        <div class="d-flex justify-content-between w-100 ps-3">
                            <a href="index.html" class="">
                                <img class="navbar-brand-icon" src="{{asset('assets/images/logo.png')}}" width="100"
                                    alt="">
                            </a>
                            <button class="navbar-toggler navbar-toggler-right d-block d-xl-none" type="button">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars-staggered"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- // END Header -->
        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">
            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push="" data-responsive-width="992px">
                @yield('content')
                <!-- // END drawer-layout__content -->
                @include('includes.sidebar')
            </div>
            <!-- // END drawer-layout -->
        </div>
        <!-- // END header-layout__content -->
    </div>
    <!-- // END header-layout -->
    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap-5.0.2/js/bootstrap.bundle.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="{{asset('assets/js/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    @stack('scripts')
</body>

</html>
