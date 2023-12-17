@extends('layouts.adminApp')
@section('title', 'Reset Exam : ' . $Global_platFormName)

@section('content')

    <div class="container p-3 pt-5">
        {{-- <h1>Exam Manager</h1> --}}

        @include('components.flashMsg')

        <div class="enable">
            <div class="h3 mt-5 mb-3 text-primary">Enable Assessment Again</div>
            <form id="upload-form" method="POST" class="form-inline"
                onsubmit="return confirm('Are you sure you want to enable assesment ?');">

                @csrf
                <div class="form-group mx-sm-3 m-3">
                    <label for="id" class="sr-only">ID</label>
                    <input type="text" class="form-control" id="id1" name="id1" placeholder="Enter ID">
                </div>
                <div class="form-group mx-sm-3 m-3">
                    <label for="pay" class="mb-2">Exam :</label>
                    <select class="form-control" id="selected1" name="selected1">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            {{-- @php
                            $section = 'week' . $week . 'sec4';
                        @endphp --}}
                            <option value="{{ $week }}">Assessment {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                @include('components.examOrHw')

                <label for="orno" class="mb-2 mt-2">Enable once :</label>
                <div class="form-group" id="orno">
                    {{-- <label>Select Report Type:</label> --}}
                    <div class="form-check">
                        <input type="radio" id="incOrdec" name="incOrdec" value="yes" class="form-check-input"
                            required>
                        <label for="incOrdec" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="incOrdec2" name="incOrdec" value="no" class="form-check-input"
                            required>
                        <label for="incOrdec2" class="form-check-label">No</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mb-2 mt-3">Enable</button>
            </form>

            <script></script>
        </div>

        <hr>

        <div class="disable">
            <div class="h3 mt-5 mb-3 text-primary">Disable Assessment :</div>

            <form method="POST" enctype="multipart/form-data" id="upload-form2"
                onsubmit="return confirm('Are you sure you want to Stop Assement ?');">

                @csrf

                <div class="form-group">
                    <label for="grade">For:</label>
                    <select class="form-control" id="grade2" name="grade2">
                        @include('components.gradeChoose')
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label for="week">ُExam Selector:</label>
                    <select class="form-control" id="current2" name="current2">
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="{{ $week }}">{{ $Global_unitName }} {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                @include('components.examOrHw')

                <button type="submit" class="btn btn-primary m-3">Stop</button>
            </form>

        </div>

        <hr>


        <div class="access">
            <div class="h3 mt-5 mb-3 text-primary">Exam Accessing :</div>

            <form method="post" action="{{ route('updateAssigmentAccess') }}" class="mt-3">
                @csrf
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="comment" name="comment" value="1">
                    <label class="form-check-label" for="comment">change Access</label>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>

        </div>

    </div>

@endsection

@section('js')
    {{-- route variables :  --}}
    <script>
        var quiz_enableExam = "{{ route('quiz/enable-exam') }}";
        var quiz_enableHW = "{{ route('quiz/enable-HW') }}";
        var disableExam = "{{ route('disableExam') }}";
        var disableHW = "{{ route('disableHW') }}";
    </script>

    {{-- form submittion : --}}
    <script src="{{ asset('jquery/asseementManager/enableAgain.js') }}"></script>
    <script src="{{ asset('jquery/asseementManager/stopExam.js') }}"></script>
@endsection
