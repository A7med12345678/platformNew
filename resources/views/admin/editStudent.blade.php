@extends('layouts.adminApp')
@section('title', 'Edit (' . $user->id . ') : ' . $Global_platFormName)
@section('styles')
<link href="{{ asset('student-css/profileBorder.css') }}" rel="stylesheet">
@endsection
@section('content')


<div class="p-5">
    <div class="h1 m-3">Edit Profile :</div>

    @if($user->role == 'admin' or $user->role == 'Sadmin' )
    <div class="text-center">
        {{-- <img class="rounded-circle" 
        src="{{ asset('storage/profiles/' . $user->profile_photo) }}"
        alt="" width="200" height="200"> --}}

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

    </div>
    @endif

    <form action="{{ route('admin/updateStudent', $user->id) }}" method="post">
        {!! csrf_field() !!}
        @method('post')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Mobile</label>
            <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
        </div>

        <!--<div class="form-group">-->
        <!--    <label for="parent_phone">Parent Mobile</label>-->
        <!--    <input type="text" name="parent_phone" id="parent_phone" value="{{ $user->parent_phone }}" class="form-control">-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label for="whatsapp">WhatsApp</label>-->
        <!--    <input type="text" name="whatsapp" id="whatsapp" value="{{ $user->whatsapp }}" class="form-control">-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label for="grade">Grade</label>-->
        <!--    <input type="text" name="grade" id="grade" value="{{ $user->grade }}" class="form-control">-->
        <!--</div>-->
        
    <div class="form-group mt-3">
    <label for="grade-selector">Enable for:</label>
    <select class="form-control" id="grade-selector" name="grade">
        <option value="1" {{ $user->grade == 1 ? 'selected' : '' }}>1 Sec.</option>
        <option value="2" {{ $user->grade == 2 ? 'selected' : '' }}>2 Sec.</option>
        <option value="3" {{ $user->grade == 3 ? 'selected' : '' }}>3 Sec.</option>
    </select>
</div>

        <div class="form-group">
            <label for="center_code">Code</label>
            <input type="text" name="center_code" id="center_code" value="{{ $user->center_code }}" class="form-control">
        </div>

        <!--<div class="form-group">-->
        <!--    <label for="learn_type">Type</label>-->
        <!--    <select id="learn_type" class="form-control" name="learn_type" required>-->
        <!--        <option value="عام" {{ $user->learn_type === 'عام' ? 'selected' : '' }}>عام</option>-->
        <!--        <option value="أزهر" {{ $user->learn_type === 'أزهر' ? 'selected' : '' }}>أزهر</option>-->
        <!--    </select>-->
        <!--</div>-->

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="password" class="text-danger">Password</label>
            <input type="text" name="password" value="{{ $user->password }}" id="password" class="form-control">
        </div>

        <input type="submit" value="Update" class="btn btn-success">
    </form>

</div>

@endsection

@section('js')
<script src="{{ asset('student-js/profileAutoUpload.js') }}"></script>
@endsection
