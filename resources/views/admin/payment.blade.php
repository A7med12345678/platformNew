@extends('layouts.adminApp')
@section('title', 'Activation : ' . $Global_platFormName)
@section('styles')
    <link href="{{ asset('admin-css/addExam-part.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content Start -->
    <div class="container">

        <div class="container pt-5">
            <div class="text-left mb-5 h1">Activations : </div>


            @include('components.flashMsg')

            <div class="mt-5">

                <!--<div class="text-primary h2"> a : </div>-->

                <!--<form action="{{ route('admin/addGrade') }}" method="POST">-->
                <!--    @csrf-->
                <!--    <div class="form-group">-->
                <!--        <label for="student_code">Student Code:</label>-->
                <!--        <input type="text" class="form-control" name="student_code" id="student_code" required>-->
                <!--    </div>-->
                <!--    <div class="form-group">-->
                <!--        <label for="new_grade">Select a new_grade:</label>-->
                <!--        <select class="form-control" id="new_grade" name="new_grade">-->
                <!--            <option value="course1">Course 1</option>-->
                <!--            <option value="course2">Course 2</option>-->
                <!--            <option value="course3">Course 3</option>-->
                <!--            <option value="course4">Course 4</option>-->
                <!--        </select>-->
                <!--    </div>-->
                <!--    <button type="submit" class="btn btn-primary">Add Grade</button>-->
                <!--</form>-->

                <!--<hr class="mt-5 mb-5">-->

                <div class="text-primary h2"> Search & Delete Peirod : </div>

                <form id="upload-form" action="{{ route('admin/studentSearch') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group mx-sm-3 m-3">
                        <label for="user_id" class="sr-only">ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter ID">
                    </div>


                    <button type="submit" class="btn btn-primary mb-2">Find</button>
                </form>

                <div class="hide">
                    @if (session('userStartFrom') !== null && session('userEnd') !== null)
                        <div class="mr-5 mt-5 mb-5 container">
                            <div class="text-primary h2">Search Results:</div>

                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Start From</th>
                                        <th>User End</th>
                                        <th>Action</th> <!-- Add a column for delete buttons -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (session('userStartFrom') as $index => $userStart)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $userStart }}</td>
                                            <td>{{ session('userEnd')[$index] }}</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('admin/deleteLessonfromuser', ['index' => $index, 'user' => session('userId')]) }}">

                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="p-3">No Lessons found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <button id="toggleButton" class="btn btn-success">Hide</button>

                    @endif
                </div>

                <script>
                    toggleButton.addEventListener('click', function() {
                        console.log("Button clicked");
                        const hideDiv = document.querySelector('.hide');
                        if (hideDiv) {
                            hideDiv.classList.toggle('d-none');
                        }
                    });
                </script>

                <hr class="m-5">


                <div class="text-primary h2">Add Peirod : </div>

                <form id="upload-form" action="{{ route('admin/addLessonToUser') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group mx-sm-3 m-3">
                        <label for="id" class="sr-only">ID</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID"
                            required>
                    </div>
                    <div class="form-group mx-sm-3 m-3">
                        <label for="start" class="mb-2">Peirod Start :</label>
                        <input type="number" class="form-control" id="start" name="start" required>
                    </div>

                    <div class="form-group mx-sm-3 m-3">
                        <label for="end" class="mb-2">Peirod End : </label>
                        <input type="number" class="form-control" id="end" name="end" required>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Add</button>
                </form>

                <hr class="m-5">


                <div class="text-primary h2">Student Payment</div>

                <form id="upload-form" action="{{ route('admin/updatePayment') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group mx-sm-3 m-3">
                        <label for="id" class="sr-only">ID</label>
                        <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID"
                            required>
                    </div>
                    <div class="form-group mx-sm-3 m-3">
                        <label for="pay" class="mb-2">Pay:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay" id="pay-enable"
                                value="1" required>
                            <label class="form-check-label" for="pay-enable">Enable Course Material</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pay" id="pay-disable"
                                value="0" required>
                            <label class="form-check-label" for="pay-disable">Disable Course Material</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Update</button>

                    <div class="m-4">
                        <a href="{{ route('Admin/showAllActivations') }}" class="btn btn-success">More &#8594;</a>
                    </div>


                </form>

                <hr class="mt-5">


                {{-- <div class="mt-5">
                    <div class="text-primary h2">Student End : </div>

                    <form id="upload-form" action="{{ route('admin/studentEnd') }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group mx-sm-3 m-3">
                <label for="idForce" class="sr-only">ID</label>
                <input type="text" class="form-control" id="idForce" name="id" placeholder="Enter ID">
            </div>

            <div class="form-group mt-3 mb-3">
                <label for="week-selector">Week Selector:</label>
                <select class="form-control" id="week-selector" name="week">
                    @php
                    $currentMonth = 1;
                    @endphp
                    @for ($week = 1; $week <= 45; $week++) <option value="{{ $week }}">{{ $Global_unitName }} {{ $week }}
                        (Month
                        {{ $currentMonth }})</option>
                        @if ($week % 4 === 0)
                        @php
                        $currentMonth++;
                        @endphp
                        @endif
                        @endfor
                </select>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Save</button>
            </form>
        </div> --}}



                <hr class="mt-5">

                <div class="mt-5">
                    <h1 class="text-danger">Force Stop</h1>

                    <form id="upload-form" action="{{ route('admin/forceStop') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="form-group mx-sm-3 m-3">
                            <label for="idForce" class="sr-only">ID</label>
                            <input type="text" class="form-control" id="idForce" name="id"
                                placeholder="Enter ID">
                        </div>
                        <div class="form-group mx-sm-3 m-3">
                            <label for="pay" class="mb-2"></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="force_stop" id="ban"
                                    value="1">
                                <label class="form-check-label" for="enable">Ban Account</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="force_stop" id="unban"
                                    value="0">
                                <label class="form-check-label" for="disable">Un-Ban Account</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger mb-2">Stop</button>
                    </form>
                </div>

                <hr>


                <div class="h1 mb-3 text-danger mt-5">Monthly Dislapling</div>
                <div class="container mt-5 mb-5">

                    <form action="{{ route('admin/disableGrade') }}" method="POST" class="mt-5">
                        @csrf
                        <label for="section-selector">Disable for Grade:</label>
                        <select class="form-control" id="section-selector" name="disable_grade">
                            @include('components.gradeChoose')
                        </select>
                        <button type="submit" class="btn btn-danger mt-3">Display</button>
                    </form>

                    {{-- <hr class="w-50 text-center mx-auto mt-5"> --}}
                    <h2 class="mt-5 mb-5 text-center text-danger"><span>or</span></h2>

                    <form action="{{ route('admin/disableAllGrades') }}" method="POST" class="mx-auto text-center">
                        @csrf
                        <button type="submit" class="btn btn-danger">Display All Grades</button>
                    </form>

                </div>
                <hr class="mt-5 mb-5">



                <div class="h1 mb-3 text-primary mt-5">Develop Mode :</div>

                <form id="upload-form" action="{{ route('admin/developMode') }}" method="POST" class="form-inline">
                    @csrf

                    <select class="form-control" id="section-selector" name="mood">
                        <option value="1">On</option>
                        <option value="0">Off</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Change</button>
                </form>
            </div>

        @endsection
