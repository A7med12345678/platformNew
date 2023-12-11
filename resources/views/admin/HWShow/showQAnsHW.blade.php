@extends('layouts.adminApp')
@section('title', 'Preview : ' . $Global_platFormName)
@section('styles')
    <link href="{{ asset('admin-css/addExam-part.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Content Start -->
    <div class="container">
        <!-- Navbar Start -->
        <div class="container pt-5 pb-5">

            <div class="h2 text-center"> Current Home Works : </div>
            <!-- Loop through the fetched JSON data and display the exams in reverse order -->
            @if (isset($exams))
                <div class="row">
                    @php
                        $sortedKeys = array_keys($exams);
                        rsort($sortedKeys);
                    @endphp
                    @foreach ($sortedKeys as $week)
                        @php
                            $exam = $exams[$week];
                        @endphp
                        <div class="col-11 mx-auto mt-5">
                            <div class="card">
                                <div class="card-header text-center">{{ substr($week, 0, -4) }} Home Work</div>
                                <div class="card-body">
                                    <p>َQuestions Num: {{ $exam['num'] }}</p>
                                    <p>Final Mark : {{ $exam['final_mark'] }}</p>
                                    {{-- <p>Exam Time : {{ $exam['time'] }}</p> --}}
                                    <ul>
                                        @foreach ($exam as $questionNumber => $answer)
                                            @if (is_numeric($questionNumber))
                                                @php
                                                    // Check if the answer ends with "2"
                                                    $isTwoMarks = substr($answer, -1) === '2';
                                                @endphp
                                                <li>Question {{ $questionNumber }}:
                                                    {{ substr($answer, 0, -1) }}
                                                    @if ($isTwoMarks)
                                                        (2 marks)
                                                    @else
                                                        {{ $answer }}
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No exams data available.</p>
            @endif

        </div>
    </div>
@endsection
