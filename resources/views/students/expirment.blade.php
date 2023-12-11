@extends('students.app')
@section('title', 'رشيف المحاضرات ')
@section('styles')
    {{-- <script src="{{ asset('student-css/archieve.css') }}"></script> --}}
@endsection
@section('content')
 <div class="container mt-5">
        @if (session('done'))
        <div class="alert alert-success">
            {{ session('done') }}
        </div>
     @endif
    <div class="h2 text-right">تجارب عملية</div>
    
    <div class="video-list">
        @foreach($videoFiles as $video)
            <video width="320" height="240" controls>
                <source src="{{ asset('videos/' . $video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endforeach
    </div>
@endsection
