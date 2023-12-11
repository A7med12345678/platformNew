<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <title>
        @yield('title')
    </title>
    {{-- <meta name="description" content="" /> --}}
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1" /> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" /> --}}
    <!-- Place favicon.ico in the root directory -->

    <!-- Web Font -->
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> --}}
    {{-- <link href="{{ asset('general-js/bootstrap-icons.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('welcome/css/bootstrap.min.css') }}" />  --}}
    {{-- <link rel="stylesheet" href="{{ asset('welcome/css/LineIcons.2.0.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('welcome/css/tiny-slider.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('welcome/css/glightbox.min.css') }}" /> --}}

    @include('imports.head')


    <link rel="stylesheet" href="{{ asset('welcome/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('welcome/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('welcome/css/atomLogo.css') }}" />
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <!-- Toolbar Start -->
        <div class="toolbar-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-12">

                        <div class="toolbar-social">
                            <ul>
                                <li>
                                    <span>
                                        @include('components.language_swither')
                                    </span>
                                </li>
                                <!--{{ $Global_teacherWhatsApp }}-->
                                <li><a href="{{ $Global_teacherFaceBook }}"><i
                                            class="fab fa-facebook text-white"></i></a></li>
                                <li><a href="{{ $Global_teacherWhatsApp }}"><i
                                            class="fab fa-whatsapp text-white"></i></a></li>
                                <li><a href="{{ $Global_teacherYoutube }}"><i class="fab fa-youtube text-white"></i></a>
                                </li>
                                <li><a href="tel: +2{{ $Global_teacherPhone }}"><i
                                            class="fas fa-phone text-white"></i></a></li>
                                <li><span class="title">: تابعنا على </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="toolbar-login">
                            <div class="button">
                                <a href="{{ route('register') }}">إنشاء حساب</a>
                                <a href="{{ route('login') }}" class="btn">تسجيل دخول</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Toolbar End -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <nav class="navbar navbar-expand-lg">
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent"
                                style="margin-right:35%;">
                                <ul id="nav" class="navbar-nav ms-auto" style="font-family:Marhey;">
                                    <li class="nav-item">
                                        <a class="page-scroll dd-menu collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">المحتوى المجاني</a>
                                        <ul class="sub-menu collapse" id="submenu-1-4">
                                            <li class="nav-item">
                                                <a class="{{ Route::currentRouteName() === 'FreeContent' ? 'active' : '' }}"
                                                    href="{{ route('FreeContent') }}">
                                                    المحتوي المجاني فيديوهات
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="{{ Route::currentRouteName() === 'FreeContent' ? 'active' : '' }}"
                                                    href="{{ route('freeContentPDF') }}">
                                                    المحتوي المجاني PDF
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    <!--<li class="nav-item">-->
                                    <!--    <a class="{{ Route::currentRouteName() === 'FreeContent' ? 'active' : '' }}"-->
                                    <!--        href="{{ route('FreeContent') }}">-->
                                    <!--       المحتوي المجاني-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName() === 'parentPDF' ? 'active' : '' }}"
                                            href="{{ route('parentPDF') }}">تقارير ولي الأمر
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName() === 'courseBuyGuest' ? 'active' : '' }}"
                                            href="{{ route('courseBuyGuest') }}">شراء كورس
                                            <!--courseBuyGuest-->
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ Route::currentRouteName() === 'welcome' ? 'active' : '' }}"
                                            href="{{ route('welcome') }}">الصفحة الرئيسية
                                        </a>
                                    </li>
                                </ul>
                                <!--<form class="d-flex search-form">-->
                                <!--    <input class="form-control me-2" type="search" placeholder="Search"-->
                                <!--        aria-label="Search">-->
                                <!--    <button class="btn btn-outline-success" type="submit"><i-->
                                <!--            class="lni lni-search-alt"></i></button>-->
                                <!--</form>-->
                            </div> <!-- navbar collapse -->

                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <a class="navbar-brand" href="{{ route('welcome') }}"
                                style="color: #0EDC8D; font-family:Marhey; font-size:23px;">
                                <span id="atom">
                                    <div id="nucleus">
                                    </div>
                                    <div class="orbit">
                                        <div class="electron"></div>
                                    </div>
                                    <div class="orbit">
                                        <div class="electron"></div>
                                    </div>
                                    <div class="orbit">
                                        <div class="electron"></div>
                                    </div>
                                </span>
                                {{ $Global_platFormName }}
                            </a>

                        </nav> <!-- navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    @yield('page-content')

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Bottom -->
        <div class="footer-bottom mt-5">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-12">
                            <div class="left">
                                <p class="mb-2">
                                    للتواصل مع فريق عمل مستر إبراهيم عمار
                                    <br>
                                    (<i class="fas fa-mobile-alt"></i> {{ $Global_teacherPhone }})

                                </p>
                                <hr class="mt-4 mb-4">
                                <p style="font-weight:bold;" class="text-white">
                                    Syntax تمت برمجة المنصة بواسطة فريق
                                    <br>
                                    :
                                    للتواصل
                                    <br>
                                    م/أحمد خالد الداخلي
                                    (<i class="fas fa-mobile-alt"></i> {{ $Global_programmerPhone }})
                                <ul class="socialList" style="list-style: none; display: inline;">
                                    <li style="display: inline-block; margin-right: 10px;"><a
                                            href="{{ $Global_programmerWhatsApp }}"><i
                                                class="fab fa-whatsapp text-white"></i></a></li>
                                    <li style="display: inline-block; margin-right: 10px;"><a
                                            href="{{ $Global_programmeFaceBook }}"><i
                                                class="fab fa-facebook text-white"></i></a></li>
                                    <li style="display: inline-block; margin-right: 10px;"><a
                                            href="{{ $Global_programmerMail }}"><i
                                                class="fas fa-envelope text-white"></i></a></li>
                                </ul>

                                <br>
                                <span class="text-white mt-2" style="font-weight:bold;">
                                    م/ بلال ابراهيم
                                    (<i class="fas fa-mobile-alt"></i> +201147278302)
                                </span>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Middle -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    {{-- <script src="{{ asset('welcome/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('welcome/js/count-up.min.js') }}"></script>
    <script src="{{ asset('welcome/js/wow.min.js') }}"></script>
    {{-- <script src="{{ asset('welcome/js/tiny-slider.js') }}"></script> --}}
    {{-- <script src="{{ asset('welcome/js/glightbox.min.js') }}"></script> --}}
    <script src="{{ asset('welcome/js/main.js') }}"></script>
    <!-- <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/main.js"></script> -->
    {{-- <script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            items: 1,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: true,
            controls: false,
            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
        });
        //====== Clients Logo Slider
        tns({
            container: '.client-logo-carousel',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 4,
                },
                1170: {
                    items: 6,
                }
            }
        });
        //========= glightbox
        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
    </script> --}}
    @yield('js')

</body>

</html>
