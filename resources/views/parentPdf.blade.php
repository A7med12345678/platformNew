@extends('layouts.welcomeApp')
@section('title', 'Parent Pdf : ' . $Global_platFormName)
@section('page-content')

    <div class="container">

        @include('components.flashMsg')

        <div class="m-5">

            <h2 class="mb-4" style="text-align: right; font-family:Marhey;">: متابعة ولي الأمر</h2>
            <form id="upload-form">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" id="id1" name="id1" placeholder="كود الطالب في السنتر"
                        dir="rtl">
                </div>

                @include('components.examOrHw')

                {{-- <div class="form-group mt-4">
                    <label for="course">Select a course:</label>
                    <select class="form-control" id="course" name="course">
                        <option value="1">Course 1</option>
                        <option value="2">Course 2</option>
                        <option value="3">Course 3</option>
                        <option value="4">Course 4</option>
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary mt-4" data-value="pdf" style="font-weight: bold;">تنزيل
                    ملف</button>
                <button type="submit" class="btn btn-danger mt-4" data-value="chart" style="font-weight: bold;">عرض رسم
                    بياني</button>
            </form>

            <div class="response">
                @include('components.reportMsg')
            </div>
        </div>

        </form>

    </div>

    {{-- route variables :  --}}
    <script>
        var singleStudent = "{{ route('singleStudent') }}";;
        var singleStudentHW = "{{ route('singleStudentHW') }}";
        var singleStudentChart = "{{ route('singleStudentChart') }}";
        var singleStudentChartHW = "{{ route('singleStudentChartHW') }}";
    </script>

    {{-- form submittion : --}}
    <script src="{{ asset('jquery/reports/reportSingle.js') }}"></script>

@endsection
