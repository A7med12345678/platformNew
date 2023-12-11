@extends('layouts.students.studentApp')
@section('title', 'تعديل حسابي')
@section('styles')
<style>
    /* Media query for screens with a maximum width of 768 pixels */
    @media (max-width: 768px) {
        .navbar-brand-div {
            transform: scale(0.7);
            padding-right: 15%;
            /*padding-top:5px;*/
        }
    }

</style>
{{-- <link href="{{ asset('student-css/profileBorder.css') }}" rel="stylesheet"> --}}
@endsection

@section('content')

<div class="container mt-5">
    <div class="h2 text-center mr-4 ml-4">
        <!--Edit Account-->
        تعديل حسابي
        </div>
    {{-- <div class="h2 text-center mr-4 ml-4">تعديل كلمة السر</div> --}}

    @if (session('error'))
    <div class="alert alert-danger mt-4">
        {{ session('error') }}
    </div>
    @endif

    @if (session('done'))
    <div class="alert alert-success text-center mt-4">
        {{ session('done') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="avatar-upload">
        <div class="avatar-edit" style="border-color: black;">
            <form action="{{ route('updateProfile', $user->center_code) }}" method="post" enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('POST')
                <input type="file" id="profile_photo" name="profile_photo" accept=".png, .jpg, .jpeg" style="display: none;" onchange="submitForm();" />
                <label for="profile_photo" class="btn btn-primary"></label>
            </form>
        </div>

        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url({{ asset('storage/profiles/' . $user->profile_photo) }});">
            </div>
        </div>
    </div>

    <form action="{{ route('updateAccount', $user->center_code) }}" method="post">
        @csrf
        <input type="hidden" name="center_code" value="{{ $user->center_code }}">

        <div class="form-group mb-3">
            <label for="name" style="float: right;">: الاسم</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" dir="rtl">
        </div>

        <div class="form-group mb-3">
            <label for="phone" style="float: right;">: رقم التليفون</label>
            <!--<label for="phone">Phone:</label>-->
            <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="current_password" style="float: right;">:كلمة المرور </label>
            <!--<label for="current_password">Old Password:</label>-->
            <input type="password" name="current_password" id="current_password" class="form-control">
        </div>

        <hr>

        <div class="form-group mb-3">
            <label for="password" style="float: right;">:كلمة المرور القديمة</label>
            <!--<label for="password">New Password:</label>-->
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation" style="float: right;">: كلمة السر الجديدة</label>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success m-3">
            <!--Update-->
            حفظ
        </button>
    </form>


</div>
</div>
@endsection

@section('js')
<script src="{{ asset('student-js/profileAutoUpload.js') }}"></script>
@endsection
