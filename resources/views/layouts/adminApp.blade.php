<!doctype html>
<html lang="en">

<head>
    @include('imports.head')
    <!-- Private : -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @if (isset(Auth::user()->center_code) && Auth::user()->center_code == '2001')
        <link href="{{ asset('admin-css/guest.css') }}" rel="stylesheet">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link href="{{ asset('admin-css/adminDot.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-css/dashmin.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('mix-css/AdminAll.css') }}"> --}}

    <title>@yield('title')</title>
    @yield('styles')
</head>

<body>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light  no-collapse">
            <a href="{{ route('adminDashboard') }}" class="navbar-brand mt-1 mb-3 mx-auto text-center">
                <!--<h3 class="text-primary">-->
                <!--    <span class="waviy">-->
                <!--        <span style="--i:1" class="text-primary">S</span>-->
                <!--        <span style="--i:2" class="text-primary">m</span>-->
                <!--        <span style="--i:3" class="text-primary">a</span>-->
                <!--        <span style="--i:4" class="text-primary">r</span>-->
                <!--        <span style="--i:5" class="text-primary">t</span>-->
                <!--        <br>-->
                <!--        <span style="--i:7" class="text-primary">L</span>-->
                <!--        <span style="--i:8" class="text-primary">e</span>-->
                <!--        <span style="--i:9" class="text-primary">a</span>-->
                <!--        <span style="--i:10" class="text-primary">r</span>-->
                <!--        <span style="--i:11" class="text-primary">n</span>-->
                <!--    </span>-->
                <!--</h3>-->
                <div class="pl-5 ml-5">
                    <img src="{{ asset('storage/image/logo.png') }}" width="140" height="100"
                        alt="syntax company logo">
                </div>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">

                    @if (isset(Auth::user()->profile_photo))
                        <img class="rounded-circle" src="{{ asset('storage/profiles/' . Auth::user()->profile_photo) }}"
                            alt="{{ Auth::user()->name }}'s Profile Photo" style="width: 40px; height: 40px;">
                    @endif
                    @if (isset(Auth::user()->center_code) &&
                            (Auth::user()->center_code == '1000' ||
                                Auth::user()->center_code == '1001' ||
                                Auth::user()->center_code == '2000' ||
                                Auth::user()->center_code == '3000'))
                        <div class="bg-danger rounded-circle border border-2 border-white position-absolute end-0 bottom-0"
                            style="padding:0.35rem;">
                        </div>
                    @else
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    @endif
                </div>
                <div class="ms-3 text-center">
                    <div>
                        @isset(Auth::user()->name)
                            {{ Auth::user()->name }}
                        @endisset
                    </div>
                    <div style="font-weight: bold;">
                        @isset(Auth::user()->role)
                            {{ Auth::user()->role }}
                        @endisset

                    </div>
                    {{-- <div class="mt-2">
                        <a href="{{ route('admin/editStudentPage', Auth::user()->center_code) }}"
                            class="btn btn-secondary text-white">Edit Profile</a>
                    </div> --}}
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="{{ route('adminDashboard') }}"
                    class="nav-item nav-link {{ Request::is('adminDashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <hr class="w-75 mx-auto">

                <a href="{{ url('user-monitoring/authentications-monitoring') }}"
                    class="nav-item nav-link {{ Request::is('user-monitoring/authentications-monitoring') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Online Students
                </a>
                <a href="{{ route('Admin/showAll') }}"
                    class="nav-item nav-link {{ Request::is('admin/showAll') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Students
                </a>

                <a href="{{ route('admin/timeTable') }}"
                    class="nav-item nav-link {{ Request::is('admin/timeTable') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Time Tables
                </a>


                <a href="{{ route('admin/showAllComplains') }}"
                    class="nav-item nav-link {{ Request::is('admin/showAllComplains') ? 'active' : '' }}">
                    <i class="fas fa-users me-2"></i>Complains
                </a>

                <hr class="w-75 mx-auto">

                <a href="{{ route('admin/addLec') }}"
                    class="nav-item nav-link {{ Request::is('admin/addLec') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-book me-2"></i>Enable Lec.
                </a>
                <hr class="w-75 mx-auto">

                <a href="{{ route('admin/report') }}"
                    class="nav-item nav-link {{ Request::is('admin/report') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="far fa-file-alt me-2"></i>General : Reports
                </a>

                <a href="{{ route('admin/AssesmentManager') }}"
                    class="nav-item nav-link {{ Request::is('admin/AssesmentManager') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-cogs me-2"></i>General : Reset
                </a>

                <a href="{{ route('admin/AssesmantShow') }}"
                    class="nav-item nav-link
                     {{ Request::is('admin/AssesmantShow') || Request::is('admin/examShow/showExams') || Request::is('admin/examShow/showExamPhoto') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-upload me-2"></i>General : Preview
                </a>

                <hr class="w-75 mx-auto">

                {{-- <a href="{{ route('admin/HWManager') }}"
                class="nav-item nav-link {{ Request::is('admin/HWManager') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="fas fa-cogs me-2"></i>HW : Reset
                </a> --}}

                <a href="{{ route('admin/addHW') }}"
                    class="nav-item nav-link {{ Request::is('admin/addHW') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-cogs me-2"></i>HW : Upload
                </a>
                {{-- <a href="{{ route('admin/HWShow') }}"
                class="nav-item nav-link {{ Request::is('admin/HWShow') || Request::is('admin/HWShow/showExams') || Request::is('admin/HWShow/showHWPhoto') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="fas fa-upload me-2"></i>HW : Preview
                </a> --}}
                {{-- <a href="{{ route('admin/reportHW') }}"
                class="nav-item nav-link {{ Request::is('admin/reportHW') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="far fa-file-alt me-2"></i>HW : Reports
                </a> --}}
                {{-- <hr class="w-75 mx-auto"> --}}

                {{-- <a href="{{ route('admin/examManager') }}"
                class="nav-item nav-link {{ Request::is('admin/examManager') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="fas fa-cogs me-2"></i>Exam : Reset
                </a> --}}

                <a href="{{ route('admin/addExam') }}"
                    class="nav-item nav-link {{ Request::is('admin/addExam') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-upload me-2"></i>Exam : Upload
                </a>

                {{-- <a href="{{ route('admin/examShow') }}"
                class="nav-item nav-link {{ Request::is('admin/examShow') || Request::is('admin/examShow/showExams') || Request::is('admin/examShow/showExamPhoto') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="fas fa-upload me-2"></i>Quiz : Preview
                </a> --}}

                {{-- <a href="{{ route('admin/report') }}"
                class="nav-item nav-link {{ Request::is('admin/report') ? 'active' : '' }}"
                style="font-size: smaller;">
                <i class="far fa-file-alt me-2"></i>Exam : Reports
                </a> --}}

                <hr class="w-75 mx-auto">

                <a href="{{ route('admin/payment') }}"
                    class="nav-item nav-link {{ Request::is('admin/payment') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-money-check-alt me-2"></i>Activation
                </a>

                <a href="{{ route('admin/courseBuyRequests') }}"
                    class="nav-item nav-link {{ Request::is('admin/courseBuyRequests') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-money-check-alt me-2"></i>Course Buy
                </a>

                <hr class="w-75 mx-auto">


                <a href="{{ route('Admin/showAllChats') }}"
                    class="nav-item nav-link {{ Request::is('admin/showAllChats') ? 'active' : '' }}">
                    <i class="fas fa-comments me-2"></i>Admin Chat
                </a>

                <a href="{{ route('admin/welcomeMsg') }}"
                    class="nav-item nav-link {{ Request::is('admin/welcomeMsg') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-envelope-open-text me-2"></i>Welcome Msg.
                </a>

                <a href="{{ route('admin/instructions') }}"
                    class="nav-item nav-link {{ Request::is('admin/instructions') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-envelope-open-text me-2"></i>Instructions
                </a>
                <hr class="w-75 mx-auto">

                {{-- @if (Auth::user()->center_code === '1001' || Auth::user()->center_code === '002') --}}
                <a href="{{ route('admin/removeAdmin') }}"
                    class="nav-item nav-link {{ Request::is('admin/removeAdmin') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-envelope-open-text me-2"></i>Admin Manager
                </a>

                <a href="{{ route('admin/resetTables') }}"
                    class="nav-item nav-link {{ Request::is('admin/resetTables') ? 'active' : '' }}"
                    style="font-size: smaller;">
                    <i class="fas fa-envelope-open-text me-2"></i>Platform : Reset
                </a>
                {{-- @endif --}}
            </div>
        </nav>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4" aria-label="specifc link">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0" aria-label="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>


            <div class="navbar-nav align-items-center ms-auto">

                <a href="{{ isset(Auth::user()->center_code) ? route('admin/editStudentPage', Auth::user()->center_code) : '#' }}"
                    class="btn btn-secondary text-white">
                    Edit Profile
                    <i class="fa-regular fa-user"></i>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger m-3" id="logout">
                        Log Out
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </nav>
        @yield('content')

        @if (!Request::is('adminDashboard'))
            <!--Admin Dashboard : -->
            <div class="mt-5 text-center p-5">
                <a href="{{ route('adminDashboard') }}" class="btn btn-warning text-white">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </div>
        @endif
    </div>

    @yield('js')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top h5"> &#8593;</a>
    </div>

    <script>
        // Sidebar Toggler
        $('.sidebar-toggler').click(function() {
            $('.sidebar, .content').toggleClass("open");
            return false;
        });
    </script>

    <!-- Private : -->
    <script src="{{ asset('admin-js/searchJquery.js') }}"></script>
    <script src="{{ asset('admin-js/searchJquery.js') }}"></script>
    {{-- <script src="{{ asset('mix-js/AdminAll.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> --}}

    @include('imports.headFooter')

</body>

</html>
