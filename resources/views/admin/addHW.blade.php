@extends('layouts.adminApp')
@section('title', 'HW : ' . $Global_platFormName)
@section('content')
    <!-- Content Start -->

    <div class="container">

        <div class="container pt-5">

            @include('components.flashMsg')

            <h1>Add Home Work Answers</h1>

            <form method="POST" action="{{ route('admin/storeHW') }}" onsubmit="return confirmSubmit();" id="addExam">
                @csrf

                <div class="form-group">
                    <label for="section-selector mt-5">Exam For:</label>
                    <select class="form-control" id="section-selector" name="grade">
                        {{-- <option value="1">1 Sec.</option>
                        <option value="2">2 Sec.</option>
                        <option value="3">3 Sec.</option> --}}
                        @include('components.gradeChoose')
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="week-selector">Exam Num:</label>
                    <select class="form-control" id="week-selector" name="selected_week" required>
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}sec3">Exam {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="numInputs">Number of questions:</label>
                    <input type="number" name="numQuestions" id="numInputs" onchange="createInputs()" min="0"
                        class="form-control" required>
                </div>

                {{-- <div class="form-group mt-3">
                    <label for="minutes">Exam Time : </label>
                    <input type="number" id="minutes" name="minutes" required class="form-control">
                </div> --}}

                <div id="dynamicInputs" class="mt-4 mb-4"></div>
                <input type="hidden" id="selectedOptions" name="selectedOptions">

                <button type="submit" class="btn btn-success">Submit</button>

            </form>

            <hr class="mt-5">

            @if (session('store_msg'))
                <div class="alert alert-success mt-5">
                    <pre>{!! session('store_msg') !!}</pre>
                </div>
            @endif

            <hr>
            <h1 class="mt-5">Add Home Work questions :</h1>

            <form method="POST" action="{{ route('admin/uploadExamHW') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="section-selector mt-5">Exam For:</label>
                    <select class="form-control" id="section-selector" name="grade">
                        @include('components.gradeChoose')
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="week-selector">HW Num:</label>
                    <select class="form-control" id="week-selector" name="HWNum" required>
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}sec3">Home Work {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <!--<div class="form-group mt-4">-->
                <!--    <label for="image">Exam questions: <span class="text-danger">photos only !</span></label><br>-->
                <!--    <input type="file" class="form-control-file mt-2" id="image" name="images[]" multiple-->
                <!--        accept="image/*" required>-->
                <!--    <small class="form-text text-muted">Only images files are allowed.</small>-->
                <!--</div>-->
                <div class="form-group mt-4">
                    <label for="images">Exam questions: <span class="text-danger">photos only!</span></label><br>
                    <input type="file" class="form-control-file mt-2" id="images" name="images[]" multiple
                        accept="image/*" required>
                    <small class="form-text text-muted">Only image files are allowed.</small>
                </div>
                <input type="submit" value="Upload" class="btn btn-success mt-4">
            </form>


        </div>
    </div>

@endsection

@section('js')
    {{-- <script src="{{ asset('admin-js/alertC.js') }}"></script> --}}
    <script src="{{ asset('admin-js/examAskQ.js') }}"></script>
@endsection
