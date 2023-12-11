<!doctype html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('storage/image/favicon.ico') }}" rel="icon">

    <!-- Custom JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <link href="{{ asset('student-css/exam-css/style.css') }}" rel="stylesheet">

    <title>@yield('title')</title>

    @yield('styles')


</head>

<body>




    @if (Auth::check() && Auth::user()->force_stop === '0')


        @if (Auth::user()->develop_mode === '1')
            <div class="container">
                <div class="alert alert-primary m-5 h1 text-center p-5" role="alert">
                    .
                    جاري التعديل على المنصة الآن, الرجاء الدخول لاحقًا
                    <br>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary text-white m-3">تسجيل خروج</button>
                    </form>
                </div>
            </div>
        @endif

        @if (Auth::check() && Auth::user()->force_stop === '0')
            @if (Auth::user()->develop_mode === '0')

                @if (Auth::user()->pay === '1')
                    @yield('content')
                @endif

            @endif
        @endif


        @if (Auth::user()->pay === '0')
            <div class="container">
                <div class="alert alert-danger m-5" role="alert">
                    You should pay first to access this feature.
                </div>
            </div>
        @endif

    @endif


    @if (Auth::check() && Auth::user()->force_stop === '1')
        <div class="container">
            <div class="alert alert-danger m-5 text-center font-weight-bold h3" role="alert">
                عذرا, تم ايقاف حسابك على منصة الوافي بسبب سلوك غير أخلاقي أو خطأ ما
                <br>
                <br>
                الرجاء الرجوع للإدارة لمراجعة نشاطك
            </div>
        </div>
    @endif


    <script src="{{ asset('js/disableF12.js') }}"></script>
    @include('imports.headFooter')

    @yield('js')

</body>

</html>
