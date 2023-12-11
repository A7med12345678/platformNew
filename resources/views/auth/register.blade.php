@extends('layouts.auth')

@section('title', $Global_teacherName)

@section('auth-content')

    <div data-aos="zoom-in-down">
        <div class="row justify-content-md-center">
            <div class="card-wrapper">
                <div class="card fat">
                    <div class="card-body">
                        <h4 class="card-title text-center" style="font-size: 1.2rem">
                            <span
                                style=" color: #ffbd50; font-size: larger; font-family: 'Lumanosimo', sans-serif; font-weight:bold;">
                                {{ $Global_platFormName }}
                            </span>
                        </h4>
                        <h5 class="card-title text-center mt-3" style="font-size: 1rem">Create new Account</h5>


                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">

                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="my-register-validation">
                            @csrf
                            <div class="form-group">
                                {{-- <label for="name" class="text-right">الاسم رباعي</label> --}}
                                <label for="name" class="text-left">Student Name <strong>(بالعربي)</strong> :
                                </label>
                                <input id="name" type="text" class="form-control" name="name" maxlength="30"
                                    required>
                                <div class="invalid-feedback">
                                    الاسم مطلوب
                                </div>
                            </div>

                            {{-- <div class="form-group">
                            <label for="name" class="text-left">
                                Student Code <strong>(999 or 9999 only)</strong>  :
                            </label>
                            <input id="name" type="text" class="form-control" name="center_code"
                                pattern="[0-9]{3}" required>
                            @error('center_code')
                                <div class="error  alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback">
                                الكود مطلوب
                            </div>
                        </div> --}}

                            <div class="form-group">
                                <label for="email" class="text-left">Email :</label>
                                {{-- <label for="email" class="text-right">البريد الالكتروني</label> --}}
                                <input id="email" type="email" class="form-control" name="email" required>
                                <div class="invalid-feedback">
                                    البريد الالكتروني مطلوب
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="text-left">
                                    Password (At least 8 characters) :
                                </label>
                                {{-- <label for="password" class="text-right">
                                كلمة السر (لا تقل عن 8 حروف)
                            </label> --}}

                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback">
                                    كلمة السر مطلوبة
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="text-left">Password Confirm : </label>
                                {{-- <label for="password-confirm" class="text-right">تأكيد كلمة السر</label> --}}
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required>
                                <div class="invalid-feedback">
                                    كلمات السر غير متطابقة
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="text-left">
                                    Phone Number <b> (Whatsapp) </b> :
                                </label>
                                {{-- <label for="phone" class="text-right">
                                رقم التليفون <b>(باللغة الانجليزية) </b>
                            </label> --}}
                                <input id="phone" class="form-control" type="text" maxlength="11" name="phone"
                                    pattern="[0-9]{11}" required>
                                <div class="invalid-feedback">
                                    رقم التليفون مطلوب
                                </div>
                            </div>

                           <div class="form-group">
                               <label for="phone" class="text-left">
                                   Whatsapp Number :
                               </label>
                               {{-- <label for="phone" class="text-right">
                               رقم واتساب <b>(باللغة الانجليزية) </b>
                           </label> --}}
                               <input id="phone" class="form-control" type="text" maxlength="11" name="whatsapp"
                                   pattern="[0-9]{11}" required>
                               <div class="invalid-feedback">
                                   رقم التليفون مطلوب
                               </div>
                           </div>

                            <div class="form-group">
                                <label for="parent-phone" class="text-left">
                                    Parent Phone :
                                </label>
                                {{-- <label for="parent-phone" class="text-right">
                                رقم تليفون ولي الأمر <b>(باللغة الانجليزية) </b>
                            </label> --}}
                                <input id="parent-phone" class="form-control" type="text" maxlength="11"
                                    name="parent_phone" pattern="[0-9]{11}" required>
                                <div class="invalid-feedback">
                                    رقم تليفون ولي الأمر مطلوب
                                </div>
                            </div>

                            <!--<div class="form-group">-->
                            <!--    <label for="grade" class="text-right">الصف الدراسي</label>-->
                            <!--    <input id="grade" type="number" class="form-control" name="grade" required min="1" max="3">-->
                            <!--    <div class="invalid-feedback">-->
                            <!--        الصف الدراسي مطلوب (أدخل رقم صحيح بين 1 و 3)-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="form-group">
                                <label for="grade" class="text-left">Grade : </label>
                                {{-- <label for="grade" class="text-right">الصف الدراسي</label> --}}
                                <select id="grade" class="form-control" name="grade" required>
                                    <!--<option value="1">1 secondary</option>-->
                                    <option value="2">2 secondary</option>
                                    <option value="3">3 secondary</option>
                                    {{-- <option value="1" disabled>الصف الاول الثانوي</option>
                                <option value="2" disabled>صف الثانوي الثانوي</option>
                                <option value="3">الصف الثالث الثانوي</option> --}}
                                </select>
                                <div class="invalid-feedback">
                                    الصف الدراسي مطلوب (يرجى اختيار رقم صحيح بين 1 و 3)
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="grade" class="text-left">Learn Type : </label>
                                {{-- <label for="grade" class="text-right">نوع الدراسة</label> --}}
                                <select id="grade" class="form-control" name="learn_type" required>
                                    <option value="عام">عام</option>
                                    <option value="ازهر">أزهر</option>
                                </select>
                                <div class="invalid-feedback">
                                    نوع الدراسة مطلوب
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="grade" class="text-left"> Group : </label>
                                {{-- <label for="grade" class="text-right">نوع الدراسة</label> --}}
                                <select id="grade" class="form-control" name="group" required>
                                    <option value="saturday">السبت</option>
                                    <option value="sunday">الأحد</option>
                                    <option value="monday">الاثنين</option>
                                </select>
                                <div class="invalid-feedback">
                                    المجموعة مطلوبة
                                </div>
                            </div>


                            <div class="form-group m-0">
                                <button type="submit" class="btn btn-block text-white" style="background: #ffbd50;">
                                    Create Account
                                </button>
                            </div>
                            <div class="mt-4 text-center">
                                Already have an account ? <a class="text-primary" href="{{ asset('login') }}">Login !</a>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('welcome') }}" style="background: #ffbd50"
                                    class="btn text-white">Dashboard</a>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
