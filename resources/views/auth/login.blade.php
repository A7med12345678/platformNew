@extends('layouts.auth')

@section('title', $Global_teacherName)

@section('auth-content')

<div class="mt-5" data-aos="zoom-in-up">
    <div class="row justify-content-md-center">
        <div class="card-wrapper">
            <div class="card fat">
                <div class="card-body">
                    <h4 class="card-title text-center" style="font-size: 1.2rem">
                        <span style="font-size: larger; font-family: 'Lumanosimo', sans-serif; color:#ffbd50; font-weight:bold;">
                            {{ $Global_platFormName }}
                        </span>
                        <br>
                        <br>
                    </h4>
                    <form method="POST" action="{{ route('login') }}" class="my-login-validation">
                        @csrf
                        <div class="form-group" data-aos="fade-right" data-aos-duration="5500">
                            <label for="login">Email or Phone:</label>
                            <input id="login" type="text" class="form-control" name="login" value="" required autofocus>
                            <div class="invalid-feedback">
                                Email or Phone is invalid
                            </div>
                        </div>


                        <div class="form-group mt-3" data-aos="fade-left" data-aos-duration="3500">
                            <label for="password" {{-- class="text-right" --}}>Password :</label>
                            <input id="password" type="password" class="form-control" name="password" required data-eye>
                            <div class="invalid-feedback">
                                Password is required
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-block text-white" style="background: #ffbd50;">
                                Login
                            </button>
                        </div>
                        <div class="mt-4 text-center">
                            Don't have an account ?
                            <a class="text-primary" href="{{ route('register') }}">Create now !</a>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('welcome') }}" class="btn text-white" style="background: #ffbd50">Dashboard</a>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="alert alert-danger mt-5 text-center" role="alert">
                        {{ $errors->first()}}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
