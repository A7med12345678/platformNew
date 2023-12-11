@extends('layouts.adminApp')
@section('title', 'Time Table : ' . $Global_platFormName)
@section('styles')
    <style>
        table {
            text-align: left;
            border-collapse: collapse;
        }

        th,
        td {
            vertical-align: top;
            padding: 0.75rem;
        }

        td {
            font-family: 'Caveat Brush', cursive;
            font-size: 1.2rem;
            border: 3px solid;
            min-width: 10rem;
        }

        td span {
            background-color: var(--pink);
        }

        td[data-cell] {
            height: 10rem;
        }

        .bg-yellow td span {
            background-color: var(--yellow);
        }

        .bg-green td span {
            background-color: var(--green);
        }

        thead th {
            border-right: 3px solid;
        }

        tbody th {
            border-top: 3px solid;
        }

        tbody tr:last-child th {
            border-bottom: 3px solid;
        }
    </style>
@endsection
@section('content')


    <div class="container p-4">
        @include('components.flashMsg')

        <div class="container">

            <h3>Current Instructions : </h3>

            <div class="table-responsive m-5" id="table">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <!--<th>ID</th>-->
                            <th>#</th>
                            <th>Sender Id</th>
                            <th>For</th>
                            <th>Lecture Day</th>
                            <th>Lecture Time</th>
                            <th>Exam Day</th>
                            <th>Exam Time</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @isset($timeTables)
                            @forelse ($timeTables as $timeTable)
                            <tr>
                                <!--<td>{{ $timeTable->id }}</td>-->
                                <td>
                                    <form class="form-inline" action="{{ route('deleteTimeTable', $timeTable->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger mb-2">Delete</button>
                                    </form>
                                </td>
                                <td>{{ $timeTable->sender_id }}</td>
                                <td>{{ $timeTable->for_course }}</td>

                                <td>
                                    <span>
                                        @if ($timeTable->lecture_day === null)
                                            <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse logo"
                                                width="40" height="40">
                                        @else
                                            {{ $timeTable->lecture_day }}
                                        @endif
                                    </span>

                                </td>

                                <td>
                                    <span>
                                        @if ($timeTable->lecture_time === null)
                                            <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse logo"
                                                width="40" height="40">
                                        @else
                                            {{ $timeTable->lecture_time }}
                                        @endif
                                    </span>
                                </td>

                                <td>
                                    <span>
                                        @if ($timeTable->exam_day === null)
                                            <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse logo"
                                                width="40" height="40">
                                        @else
                                            {{ $timeTable->exam_day }}
                                        @endif
                                    </span>
                                </td>

                                <td>
                                    <span>
                                        @if ($timeTable->exam_time === null)
                                            <img src="{{ asset('welcome/images/null.webp') }}" alt="no repsonse logo"
                                                width="40" height="40">
                                        @else
                                            {{ $timeTable->exam_time }}
                                        @endif
                                    </span>
                                </td>

                                {{-- <td>{{ $timeTable->lecture_day }}</td> --}}
                                {{-- <td>{{ $timeTable->lecture_time }}</td>
                        <td>{{ $timeTable->exam_day }}</td>
                        <td>{{ $timeTable->exam_time }}</td> --}}
                                <td>{{ $timeTable->created_at }}</td>

                            </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="p-3">No Time Tables found.</td>
                                </tr>
                                @endforelse
                            @endisset
                        </tbody>
                    </table>
                </div>

                <hr class="mt-5 mb-5">


                <h3>Add Time Table:</h3>
                <form method="POST" action="{{ route('addToTimeTable') }}">
                    @csrf
                    <!-- Laravel CSRF protection token -->
                    <div class="form-group mt-3">
                        <label for="for_course">Enable for:</label>
                        <select class="form-control" id="for_course" name="for_course">
                            @foreach ($currentGroups as $currentGroup)
                                <option value="{{ $currentGroup }}">{{ $currentGroup }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="type" class="mb-5">
                        <!-- Add radio buttons for "Lecture" and "Exam" -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="event_type" id="lecture" value="lecture"
                                checked>
                            <label class="form-check-label" for="lecture">Lecture</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="event_type" id="exam" value="exam">
                            <label class="form-check-label" for="exam">Exam</label>
                        </div>
                        <!-- End radio buttons -->

                    </div>


                    <!-- Lecture Section -->
                    <div class="Lecture mt-4">
                        <h5 class="mb-3">Lecture:</h5>
                        <div class="form-group">
                            <label for="lecture_day">Select a Day:</label>
                            <select class="form-control" id="lecture_day" name="lecture_day">
                                <option value="">Select a Day</option> <!-- Default null option -->
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lecture_time">Select an Hour:</label>
                            <select class="form-control" id="lecture_time" name="lecture_time">
                                <option value="">Select an Hour</option> <!-- Default null option -->
                                @for ($hour = 12; $hour >= 0; $hour--)
                                    @if ($hour == 12)
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 PM</option>
                                    @elseif ($hour == 0)
                                        <option value="00:00">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 AM</option>
                                    @else
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 PM</option>
                                    @endif
                                @endfor
                            </select>
                        </div>

                    </div>

                    <!-- Exam Section -->
                    <div class="Exam mt-4">
                        <h5 class="mb-3">Exam:</h5>
                        <div class="form-group">
                            <label for="exam_day">Select a Day:</label>
                            <select class="form-control" id="exam_day" name="exam_day">
                                <option value="">Select a Day</option> <!-- Default null option -->
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exam_time">Select an Hour:</label>
                            <select class="form-control" id="exam_time" name="exam_time">
                                <option value="">Select an Hour</option> <!-- Default null option -->
                                @for ($hour = 12; $hour >= 0; $hour--)
                                    @if ($hour == 12)
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 PM</option>
                                    @elseif ($hour == 0)
                                        <option value="00:00">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 AM</option>
                                    @else
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00 PM</option>
                                    @endif
                                @endfor
                            </select>
                        </div>

                    </div>

                    <!-- JavaScript code -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            // Get references to the "Lecture" and "Exam" sections
                            var lectureSection = document.querySelector(".Lecture");
                            var examSection = document.querySelector(".Exam");

                            // Hide both Lecture and Exam sections by default
                            lectureSection.style.display = "block";
                            examSection.style.display = "none";

                            // Get references to the radio buttons
                            var lectureRadio = document.querySelector("#lecture");
                            var examRadio = document.querySelector("#exam");

                            // Add an event listener for the radio button change event
                            lectureRadio.addEventListener("change", function() {
                                if (lectureRadio.checked) {
                                    lectureSection.style.display = "block";
                                    examSection.style.display = "none";
                                }
                            });

                            examRadio.addEventListener("change", function() {
                                if (examRadio.checked) {
                                    lectureSection.style.display = "none";
                                    examSection.style.display = "block";
                                }
                            });
                        });
                    </script>
                    <input type="submit" class="btn btn-success" value="Add">

                </form>


            </div>

        @endsection
