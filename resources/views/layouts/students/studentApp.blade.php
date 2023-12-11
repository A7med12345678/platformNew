<!doctype html>
<html lang="ar">

<head>

    @include('imports.head')
    <link rel="stylesheet" href="{{ asset('student-css/atomLogoStudent.css') }}" />

    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    {{-- 
    <script src="{{ asset('student-js/searchJquery.js') }}"></script>
     --}}
    {{-- <link rel="stylesheet" href="{{ asset('student-css/Nav.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('mix-css/studentAll.css') }}">

    <title>@yield('title')</title>

    @yield('styles')

</head>

<body>

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'Sadmin')
        <div class="text-center text-white bg-warning w-100 p-1">
            Acting as User. &nbsp;
            <a href="{{ route('adminDashboard') }}">Exit</a>
        </div>
    @endif

    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-right:25%;">
                <!--<ul class="navbar-nav mr-5">-->
                <!-- Use ml-auto class to align all links to the right -->
                <!--    <li class="nav-item">-->
                <!--        <a class="nav-link text-white" href="{{ route('currentWeek') }}">Current Week</a>-->
                <!--    </li>-->
                <!--    <li class="nav-item">-->
                <!--        <a class="nav-link text-white" href="{{ route('archive') }}">Archieve</a>-->
                <!--    </li>-->
                <!--    <li class="nav-item ml-auto">-->
                <!--        <a class="nav-link text-white" href="{{ route('complain') }}">Complain</a>-->
                <!--    </li>-->
                <!--    <li class="nav-item ml-auto">-->
                <!--        <a class="nav-link text-white" href="{{ route('FAQquestions') }}">Common Questions</a>-->
                <!--    </li>-->
                <!--    <li class="nav-item ml-auto">-->
                <!--        <a class="nav-link text-white"-->
                <!--            href="{{ route('editAccunt', Auth::user()->center_code) }}">Account</a>-->
                <!--    </li>-->
                <!--    <li class="nav-item ml-auto">-->
                <!--        <form action="{{ route('logout') }}" method="POST">-->
                <!--            @csrf-->
                <!--            <button type="submit" class=" btn nav-link text-white">Log Out</button>-->
                <!--        </form>-->
                <!--    </li>-->
                <!--</ul>-->

                <ul class="navbar-nav mr-5">
                    <!-- Use ml-auto class to align all links to the right -->
                    <li class="nav-item" style="font-family:Marhey;">
                        <a class="nav-link text-white" href="{{ route('currentWeek') }}">الدرس الحالي</a>
                    </li>
                    <li class="nav-item" style="font-family:Marhey;">
                        <a class="nav-link text-white" href="{{ route('archive') }}">الأرشيف</a>
                    </li>
                    <li class="nav-item ml-auto" style="font-family:Marhey;">
                        <a class="nav-link text-white" href="{{ route('complain') }}">اسال المستر</a>
                    </li>
                    <li class="nav-item ml-auto" style="font-family:Marhey;">
                        <a class="nav-link text-white" href="{{ route('FAQquestions') }}">اسئلة عامة</a>
                    </li>
                    <li class="nav-item ml-auto" style="font-family:Marhey;">
                        <a class="nav-link text-white"
                            href="{{ route('editAccunt', Auth::user()->center_code) }}">حسابي</a>
                    </li>
                    <li class="nav-item ml-auto" style="font-family:Marhey;">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class=" btn nav-link text-white">تسجيل خروج</button>
                        </form>
                    </li>
                </ul>

            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <i class="fa-solid fa-bars fa-1x text-white"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"
                style="color: white; font-family:Marhey; font-size:23px;">
                <div style="display:flex; flex-direction:row;">

                    <div id="atom" class="mt-2 mr-3 pr-3">
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
                    </div>

                    <div class="ml-3">
                        {{ $Global_platFormName }}

                    </div>
                </div>
            </a>

        </div>
    </nav>


    @if (Auth::check() && Auth::user()->force_stop === '0')

        @include('components.activation.develop1')
        @include('components.activation.pay0')

        @if (Auth::user()->develop_mode === '0')
            @if (Auth::user()->pay === '1')
                @yield('content')
            @endif
        @endif
    @endif
    @include('components.activation.block1')


    @yield('js')

    {{-- <script src="{{ asset('student-js/nav.js') }}"></script> --}}
    {{-- <script src="{{ asset('mix-js/stutentAll.js') }}"></script> --}}

    <script>
        var navbarToggler = document.querySelector(".navbar-toggler");
        navbarToggler.addEventListener("click", function() {
            var navbarCollapse = document.querySelector(".navbar-collapse");
            navbarCollapse.classList.toggle("show");
            setTimeout(function() {
                test();
            });
        });
    </script>

</body>

</html>
