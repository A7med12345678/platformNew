@extends('layouts.adminApp')
@section('title', 'Report Exam : ' . $Global_platFormName)
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Content Start -->
    <div class="p-3">
        <div class="container">

            {{-- <h1>Exam Report : </h1> --}}

            @include('components.flashMsg')

            <div class="mt-5" id="singleStudent">

                <div class="h3 mt-5 mb-3 text-primary">Report By (ID) :</div>

                <form id="upload-form">
                    @method('POST')
                    <div class="form-group">
                        <input type="text" class="form-control" id="id1" name="id1" placeholder="Enter ID">
                    </div>

                    @include('components.examOrHw')

                    <!--<div class="form-group">-->
                    <!--    <label for="course">Select a course:</label>-->
                    <!--    <select class="form-control" id="course" name="course">-->
                    <!--        <option value="1">Course 1</option>-->
                    <!--        <option value="2">Course 2</option>-->
                    <!--        <option value="3">Course 3</option>-->
                    <!--        <option value="4">Course 4</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="buttons mt-3">
                        <button type="submit" class="btn btn-primary" data-value="pdf">Generate PDF</button>
                        <button type="submit" class="btn btn-danger" data-value="chart">Generate Chart</button>
                    </div>
                </form>
                {{-- 
                <div class="response">
                    @include('components.reportMsg')
                </div> --}}

            </div>

            <hr class="mt-5 mb-5">

            <div class="" id="singleGrade">

                <div class="h3 mt-5 mb-3 text-primary">Report By (Grade , Exam) : <span class="h5 text-danger">1 file , 1
                        exam</span> </div>
                <form id="upload-form2" method="POST" class="form-inline">
                    <div class="form-group">
                        <label for="section-selector mt-5">Exam For:</label>
                        <select class="form-control" id="grade2" name="grade2">
                            @include('components.gradeChoose')
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="week-selector">Exam Num:</label>
                        <select class="form-control" id="exam2" name="exam2" required>
                            @for ($week = 1; $week <= $Global_unitNum; $week++)
                                <option value="{{ $week }}">Exam {{ $week }}</option>
                            @endfor
                        </select>
                    </div>

                    @include('components.examOrHw')

                    <button type="submit" class="btn btn-primary mt-3">Download</button>
                </form>
            </div>

            <hr class="mt-5 mb-5">

            <div class="" id="rar">

                <div class="h3 mt-5 mb-3 text-primary">Report .rar (grade) : <span class="h5 text-danger"> each student ,
                        all
                        exams</span></div>
                <form id="upload-form3" method="POST" class="form-inline">
                    @csrf
                    <label for="section-selector" class="mt-2">Section Selector:</label>
                    <div class="form-group">
                        <select class="form-control" id="sec3" name="sec3">
                            @include('components.gradeChoose')
                        </select>
                    </div>

                    @include('components.examOrHw')

                    <button type="submit" class="btn btn-primary mt-3">Download</button>
                </form>


            </div>

            <hr class="mt-5 mb-5">

            <div class="" id="allGrade">

                <div class="h3 mt-5 mb-3 text-primary">Report (all grade) : <span class="h5 text-danger">1 file , all
                        exams</span></div>
                <form id="upload-form4" method="POST" class="form-inline">
                    @csrf
                    <label for="section-selector" class="mt-2">Section Selector:</label>
                    <div class="form-group">
                        <select class="form-control" id="sec4" name="sec4">
                            @include('components.gradeChoose')
                        </select>
                    </div>

                    @include('components.examOrHw')

                    <button type="submit" class="btn btn-primary mt-3">Download</button>
                </form>


            </div>

            <hr class="mt-5 mb-5">

            <div class="" id="getStatistics">
                <div class="h3 mt-5 mb-3 text-primary">Best Students : </div>

                <form id="upload-form5" action="{{ route('getStatistics') }}" method="POST" class="form-inline">
                    @csrf

                    <div class="form-group">
                        <select class="form-control" id="grade5" name="grade5">
                            @include('components.gradeChoose')
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="from" class="mt-2">From Exam:</label>
                        <select class="form-control" id="from5" name="from5" required>
                            @for ($i = 1; $i <= $Global_unitNum; $i++)
                                <option value="{{ $i }}">Exam {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="to" class="mt-2">To Exam:</label>
                        <select class="form-control" id="to5" name="to5" required>
                            @for ($i = 1; $i <= $Global_unitNum; $i++)
                                <option value="{{ $i }}">Exam {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order" class="mt-3">Order By:</label>
                        <select class="form-control" id="order5" name="order5" required>
                            <option value="DESC">Best</option>
                            <option value="ASC">Worthiest</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="num" class="mt-3">Students number needed:</label>
                        <input type="number" id="num5" name="num5" class="form-control" required>
                    </div>

                    @include('components.examOrHw')


                    <button type="submit" class="btn btn-primary mt-3">Get</button>
                </form>

                <div class="serponse">
                    @if (session('results'))
                        <table class="table mt-5" id="results-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Total Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1; // Initialize the counter
                                @endphp
                                @foreach (session('results') as $result)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $result->user_id }}</td>
                                        <td>{{ $result->user_name }}</td>
                                        <td>{{ $result->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>

    </div>
@endsection

@section('js')

    {{-- route variables :  --}}
    <script>
        var singleStudent = "{{ route('singleStudent') }}";;
        var singleStudentHW = "{{ route('singleStudentHW') }}";
        var singleStudentChart = "{{ route('singleStudentChart') }}";
        var singleStudentChartHW = "{{ route('singleStudentChartHW') }}";

        var singleGradeRoute = "{{ route('singleGrade') }}";
        var singleGradeRouteHW = "{{ route('singleGradeHW') }}";

        var groupStudent = "{{ route('groupStudent') }}";;
        var groupStudentHW = "{{ route('groupStudentHW') }}";

        var allGrades = "{{ route('allGrades') }}";;
        var allGradesHW = "{{ route('allGradesHW') }}";

        var getStatistics = "{{ route('getStatistics') }}";
        var getStatisticsHW = "{{ route('getStatisticsHW') }}";
    </script>

    {{-- form submittion : --}}
    <script src="{{ asset('jquery/reports/reportSingle.js') }}"></script>
    <script src="{{ asset('jquery/reports/reportGrade.js') }}"></script>
    <script src="{{ asset('jquery/reports/reportRar.js') }}"></script>
    <script src="{{ asset('jquery/reports/reportAll.js') }}"></script>
    <script src="{{ asset('jquery/reports/reportStatistics.js') }}"></script>
    <script src="{{ asset('admin-js/scrollBestStudent.js') }}"></script>
<!-- jQuery CDN -->

@endsection
