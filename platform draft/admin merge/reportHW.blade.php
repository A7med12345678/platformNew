@extends('layouts.adminApp')
@section('title', 'Report HW : ' . $Global_platFormName)
@section('content')

    <!-- Content Start -->
    <div class="p-3">
        <!-- Navbar Start -->
        <div class="container">

            <h1>Home Work Report : </h1>

            <div class="h3 mt-5 mb-3 text-primary">Report By (ID) :</div>
            {{-- <div class="h3 mt-5 mb-3 text-primary">Report for : </div> --}}
            <form id="upload-form" method="POST" class="form-inline">
                @csrf
                <div class="form-group mx-sm-3 m-3">
                    <label for="id" class="sr-only">ID</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID">
                </div>

                <button type="submit" class="btn btn-primary mt-3"
                    action="{{ route('singleStudentHW') }}">Generate</button>
                <button type="submit" class="btn btn-danger mt-3" formaction="{{ route('singleStudentChartHW') }}">Generate
                    Chart</button>

                <!--Send report via whatsapp to parent : -->

                @if (session('message'))
                    <div class="text-center mx-auto mt-4">
                        <a class="btn btn-success text-center mx-auto" style="font-weight:bold;" target="_blank"
                            href="https://wa.me/+2{{ session('message') }}?text=الرجاء%20متابعة%20مستوى%20نجلكم%20في%20واجبات%20مادة%20اللغة%20الإنجليزية%20:%0A%0A{{ $Global_currentURL }}/storage/app/public/HW/{{ session('downloadLink') }}%0A%0Aمع%20تحيات%20فريق%20عمل%20منصة%20English%20for%20All%20-%20ا/محمد%20الشربيني">
                            <i class="fab fa-whatsapp"></i>
                            إرسال لولي الأمر
                        </a>
                    </div>
                @endif

                <!-- Donwload report : -->

                @if (session('downloadLink'))
                    <div class="text-center mx-auto mt-3">
                        <a class="btn btn-warning text-white"
                            href="{{ asset('storage/app/public/HW/' . session('downloadLink')) }}" style="font-weight:bold;"
                            download>
                            <i class="fas fa-download"></i>
                            تحميل التقرير
                        </a>
                    </div>
                @endif

                <!-- View report : -->

                @if (session('downloadLink'))
                    <div class="text-center mx-auto mt-3">
                        <a class="btn btn-secondary text-white" target="_blank"
                            href="{{ asset('storage/app/public/HW/' . session('downloadLink')) }}"
                            style="font-weight:bold;">
                            <i class="fas fa-file"></i>
                            عرض التقرير
                        </a>
                    </div>
                @endif

            </form>

            <hr class="mt-5 mb-5 ">

            <div class="h3 mt-5 mb-3 text-primary">Report By (Grade , Exam) : <span class="h5 text-danger">1 file , 1
                    exam</span> </div>
            <form id="upload-form" action="{{ route('singleGradeHW') }}" method="POST" class="form-inline">
                @csrf

                <div class="form-group">
                    <label for="section-selector mt-5">Exam For:</label>
                    <select class="form-control" id="section-selector" name="grade">
                        <option value="1">1 Sec.</option>
                        <option value="2">2 Sec.</option>
                        <option value="3">3 Sec.</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="week-selector">Exam Num:</label>
                    <select class="form-control" id="week-selector" name="exam" required>
                        @for ($week = 1; $week <= $Global_unitNum; $week++)
                            <option value="week{{ $week }}sec3">HW {{ $week }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Download</button>
            </form>

            <hr class="mt-5 mb-5 ">

            <div class="h3 mt-5 mb-3 text-primary">Report .rar (grade) : <span class="h5 text-danger"> each student , all
                    exams</span></div>
            <form id="upload-form" action="{{ route('groupStudentHW') }}" method="POST" class="form-inline">
                @csrf
                <label for="section-selector" class="mt-2">Grade Selector:</label>
                <select class="form-control" id="section-selector" name="sec">
                    <option value="1">Grade 1</option>
                    <option value="2">Grade 2</option>
                    <option value="3">Grade 3</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">Download</button>
            </form>


            <hr class="mt-5 mb-5 ">

            <div class="h3 mt-5 mb-3 text-primary">Report (all grade) : <span class="h5 text-danger">1 file , all
                    exams</span></div>
            <form id="upload-form" action="{{ route('allGradesHW') }}" method="POST" class="form-inline">
                @csrf
                <label for="section-selector" class="mt-2">Grade Selector:</label>
                <select class="form-control" id="section-selector" name="grade">
                    <option value="1">Grade 1</option>
                    <option value="2">Grade 2</option>
                    <option value="3">Grade 3</option>
                </select>
                <button type="submit" class="btn btn-primary mt-3">Download</button>
            </form>



            <br>

            {{-- session return: --}}
            @if (session('flash_msg'))
                <div class="alert alert-success mt-3">
                    {{ session('flash_msg') }}
                </div>
                <a href="{{ route('Admin.index') }}" class="btn btn-secondary">GO Home</a>
            @endif

            <hr class="m-4">

            <div class="h3 mt-5 mb-3 text-primary">Best Students : </div>

            <form id="upload-form" action="{{ route('getStatisticsHW') }}" method="POST" class="form-inline">
                @csrf
                <label for="section-selector" class="mt-2">Grade : </label>
                <select class="form-control" id="section-selector" name="grade" required>
                    @for ($i = 1; $i <= 3; $i++)
                        <option value="{{ $i }}"> {{ $i }} Sec.</option>
                    @endfor
                </select>

                <label for="section-selector" class="mt-2">from Exam : </label>
                <select class="form-control" id="section-selector" name="from" required>
                    @for ($i = 1; $i <= $Global_unitNum; $i++)
                        <option value="{{ $i }}">HW {{ $i }}</option>
                    @endfor
                </select>
                <label for="section-selector" class="mt-2">to Exam : </label>
                <select class="form-control" id="section-selector" name="to" required>
                    @for ($i = 1; $i <= $Global_unitNum; $i++)
                        <option value="{{ $i }}">HW {{ $i }}</option>
                    @endfor
                </select>

                <label for="section-selector2" class="mt-3"> Order By : </label>
                <select class="form-control" id="section-selector2" name="order" required>
                    <option value="DESC">Best</option>
                    <option value="ASC">Worthiest</option>
                </select>

                <label for="section-selector2" class="mt-3"> Students number needed : </label>
                <input type="number" name="num" class="form-control" required>


                <button type="submit" class="btn btn-primary mt-3">Get</button>
            </form>

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
@endsection

@section('js')
    <script src="{{ asset('admin-js/scrollBestStudent.js') }}"></script>
@endsection
