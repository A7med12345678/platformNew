<!DOCTYPE html>
<html lang="en">

<head>
    @include('imports.head')
    <title>@yield('title')</title>

    {{-- PRIVATE : --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        html,
        body {
            height: 100%;
        }

        .auth-page {
            background: #f7f9fb;
            font-size: 14px;
        }

        .auth-page .card-wrapper {
            width: 400px;
        }

        .auth-page .card {
            border-color: transparent;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
        }

        .auth-page .card.fat {
            padding: 10px;
        }

        .auth-page .card .card-title {
            margin-bottom: 30px;
        }

        .auth-page .form-control {
            border-width: 2.3px;
        }

        .auth-page .form-group label {
            width: 100%;
        }

        .auth-page .btn.btn-block {
            padding: 12px 10px;
        }

        .auth-page .footer {
            margin: 40px 0;
            color: #888;
            text-align: center;
        }

        a:hover {
            text-decoration: none;
        }

        @media screen and (max-width: 425px) {
            .auth-page .card-wrapper {
                width: 100%;
                margin: 0 auto;
            }
        }

        @media screen and (max-width: 320px) {
            .auth-page .card.fat {
                padding: 0;
            }

            .auth-page .card.fat .card-body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-page p-5">
        <section class="h-100">
            @yield('auth-content')
        </section>

        <div class="mt-3 text-center">
            Copyright &copy; {{ $Global_currentYear }}, By : <b> {{ $Global_programmerName }} -
                {{ $Global_programmerPhone }} </b>
        </div>
    </div>

    <script>
        AOS.init();
    </script>
    <script src="{{ asset('general-js/disableF12.js') }}"></script>
</body>

</html>
