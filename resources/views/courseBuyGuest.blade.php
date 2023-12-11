@extends('layouts.welcomeApp')
@section('title', 'Course Buy : ' . $Global_platFormName)

@section('page-content')

    {{-- @include('components.welcomepagesHeader', ['page_title' => 'Course Buy']) --}}

    <div class="container">

        @include('components.flashMsg')

        <div class="text-center m-4 choice">
            <input type="radio" name="formToggle" id="buyFormToggle" checked> Buy Course
            <input type="radio" name="formToggle" id="getFormToggle"> Inform
        </div>

        <div class="responses">
            @if (!empty(session('response')))
                <div class="bg-success p-4 m-4 text-white text-center">
                    <div>
                        Your course has been requested , code :
                    </div>
                    <div class="h3 text-center m-3">
                        {{ session('response') }}
                    </div>
                    <div class="">
                        Contant : {{ $Global_teacherPhone }} for more details ..
                    </div>
                    (please code safe to use it)
                </div>
            @endif
            @if (!empty(session('response_get')))
                <div class="bg-success p-4 m-4 text-white text-center">
                    <div>
                        @if (session('response_get')->status == '0')
                            Please contanct {{ $Global_teacherPhone }} to pay and first !
                        @elseif(session('response_get')->status == '1')
                            Your request has veen applied , please ait some time !
                        @elseif(session('response_get')->status == '2')
                            You can download your course now !
                            <a href="{{ route('deliverCourseRequest', session('code')) }}"
                                class="btn btn-primary">Download</a>
                        @endif
                    </div>
                </div>
            @endif
            @if (!empty(session('response_get_failed')))
                <div class="bg-success p-4 m-4 text-white text-center">
                    Course Request not found!
                </div>
            @endif
        </div>

        <div class="mb-5 forms">
            <form action="{{ route('submitCourseRequest') }}" method="POST" id="buy" class="form-toggle">
                @csrf
                <!-- Add CSRF token for security -->
                <h3 class="m-4">Buy Course:</h3>
                <div class="form-group mb-4">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group mb-4">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group mb-4">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Enter your phone number">
                </div>
                <div class="form-group mb-4">
                    <label for="course">Select a course:</label>
                    <select class="form-control" id="course" name="course">
                        <option value="course1">Course 1</option>
                        <option value="course2">Course 2</option>
                        <option value="course3">Course 3</option>
                        <option value="course4">Course 4</option>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" placeholder="Add any additional comments"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <form action="{{ route('getCourseRequest') }}" method="POST" id="get" class="form-toggle" class="m-5">
                @csrf
                <div class="form-group">
                    <label for="code">Request:</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter your code">
                    <button type="submit" class="btn btn-primary m-3">Submit</button>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('js')
    <!-- JavaScript to toggle between forms using jQuery -->
    <script>
        $(document).ready(function() {
            // Initially, make sure the "Buy Course" form is visible
            $("#buy").show();
            $("#get").hide();

            // Toggle forms based on radio button clicks
            $("input[name='formToggle']").click(function() {
                if ($("#buyFormToggle").prop("checked")) {
                    $("#buy").show();
                    $("#get").hide();
                } else if ($("#getFormToggle").prop("checked")) {
                    $("#buy").hide();
                    $("#get").show();
                }
            });
        });
    </script>
@endsection
