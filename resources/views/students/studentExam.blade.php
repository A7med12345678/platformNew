@php
    use App\Helpers\MediaValidationHelper;
@endphp
@extends('layouts.students.studentExamApp')
@section('title', 'امتحان')
@section('content')


    <div class="container-cus">

        {{-- Prepare exam (time , final mark , grade) in : select controller : weekExam --}}
        {{-- exam Questions (as photos from public/photos) : --}}
        <div class="photo-section">
            @foreach ($images as $image)
                @php
                    $photoName = $image->image;
                @endphp
                <div class="">
                    <img src="{{ asset('storage/photos/' . substr($isValidG, 0, 1) . '/' . $now . '/' . $photoName) }}"
                        alt="{{ $photoName }}" width="100%" height="100%">
                </div>
            @endforeach
        </div>


        {{-- Reusult & MCQ choises : --}}
        <div class="form-section -2">

            <div class="">


                {{-- Result : --}}
                <form id="quiz-form" method="POST" action="{{ route('quiz/process-score', ['isValidG' => $isValidG]) }}">
                    @csrf

                    @if (session()->has('result'))
                        {{--  --}}
                        @if (session('result'))
                            <div class="container">

                                <a class="btn btn-primary text-white mx-auto text-center" href="{{ route('home') }}">
                                    <!--HomePage-->
                                    الصفحة الرئيسية
                                </a>
                                {{-- <a class="btn btn-primary text-white mx-auto text-center" href="{{ route('home') }}">الصفحة
                                    الرئيسية
                                </a> --}}

                                <div class="alert {{ session('successORfail') >= 0.5 ? 'alert-success' : 'alert-danger' }} mt-3"
                                    id="flash-msg">
                                    <div class="h3 text-center">: لقد حصلت على</div>
                                    <!--<div class="h3 text-center">You Got :</div>-->
                                    <div class="h4 text-center" dir="rtl">
                                        <span class="p-3">
                                            {{ session('result') }}
                                        </span>
                                        <hr>
                                        <span class="p-3">
                                            {{ session('percentage') }}
                                        </span>
                                    </div>
                                </div>
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>
                                                <!--Correct Answer-->
                                                الاجابة الصحيحة
                                                </th>
                                            <th>
                                                <!--Student's Answer-->
                                                اختيار الطالب
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $correctAnswers = session('data');
                                            $studentAnswers = session('studentAnswers');
                                        @endphp

                                        @if ($correctAnswers && $studentAnswers)
                                            @for ($i = 1; $i <= $correctAnswers['num']; $i++)
                                                @php
                                                    $correctAnswer = MediaValidationHelper::formatValueEN($correctAnswers[$i]);
                                                    $userAnswerInfo = $studentAnswers[$i];
                                                    $formattedUserAnswer = MediaValidationHelper::formatValueEN($userAnswerInfo['userAnswer']);
                                                    $isMatch = substr($formattedUserAnswer, 0, 3) === substr($correctAnswer, 0, 3);
                                                @endphp

                                                <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>{{ $correctAnswer }}</td>
                                                    <td style="color: {{ $isMatch ? 'green' : 'red' }}">
                                                        {{ $formattedUserAnswer }}</td>
                                                </tr>
                                            @endfor
                                        @else
                                            <tr>
                                                <td colspan="3">No answers found in the session.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>



                                {{-- Fetch correct answers : --}}
                                {{-- <div class="h3 text-center">: الاجابات الصحيحة</div> --}}






                            </div>
                        @endif
                        {{--  --}}
                    @else
                        {{-- Answer submit & remaing time : --}}
                        <div class="exam-header" style="display: flex; flex-direction:column !important;">
                            <div class="mx-auto text-center mt-4">
                                <button type="submit" class="btn btn-success" id="submit-btn">
                                    <!--Submit-->
                                    إرسال
                                    </button>
                                {{-- <button type="submit" class="btn btn-success" id="submit-btn">إرسال</button> --}}
                            </div>
                            <div class="mx-auto text-center mt-4 h3 text-secondary">
                                <div id="timer-container"
                                    style="display: flex; flex-direction:row; justify-content: space-around;">
                                    <span class="remaining-text">
                                        <!--Remaining :-->
                                    </span>
                                    <span id="timer"> </span>
                                </div>
                                <div class="remaining-text">
                                    : متبقي
                                </div> 
                            </div>
                        </div>
                        @csrf

                        {{-- MCQ table Design : --}}
                        <div class="row mt-1">
                            <div class="col-2 mx-auto text-center h4"></div>
                            {{-- <div class="col-2 mx-auto text-center h4">ء</div>
                            <div class="col-2 mx-auto text-center h4">جـ</div>
                            <div class="col-2 mx-auto text-center h4">ب</div>
                            <div class="col-2 mx-auto text-center h4">أ</div> --}}
                            <div class="col-2 mx-auto text-center h4">#</div>

                            <div class="col-2 mx-auto text-center h4">a</div>
                            <div class="col-2 mx-auto text-center h4">b</div>
                            <div class="col-2 mx-auto text-center h4">c</div>
                            <div class="col-2 mx-auto text-center h4">d</div>


                        </div>

                        <input type="hidden" name="now" value="{{ $now }}">


                        {{-- echo mcq choises due to API exam num questions ($numQuestions), sent to controller as array : answer[1] to answer[$numQuestions] : --}}

                        @for ($question = 1; $question <= $numQuestions; $question++)
                            <div class="row mt-2">
                                <div class="col-2 mx-auto text-center">
                                </div>

                                <div class="col-2 text-center">{{ $question }}
                                </div>

                                <div class="col-2 mx-auto text-center">
                                    <input type="radio" class="radio-btn" name="answer[{{ $question }}]"
                                        value="a"required aria-invalid="true"
                                        ninvalid="this.setCustomValidity('الرجاء اختيار اجابة للسؤال')"
                                        title="الرجاء اختيار اجابة للسؤال">
                                </div>

                                <div class="col-2 mx-auto text-center">
                                    <input type="radio" class="radio-btn" name="answer[{{ $question }}]"
                                        value="b" required aria-invalid="true"
                                        ninvalid="this.setCustomValidity('الرجاء اختيار اجابة للسؤال')"
                                        title="الرجاء اختيار اجابة للسؤال">
                                </div>

                                <div class="col-2 mx-auto text-center">
                                    <input type="radio" class="radio-btn" name="answer[{{ $question }}]"
                                        value="c"required aria-invalid="true"
                                        ninvalid="this.setCustomValidity('الرجاء اختيار اجابة للسؤال')"
                                        title="الرجاء اختيار اجابة للسؤال">
                                </div>
                                <div class="col-2 mx-auto text-center">
                                    <input type="radio" class="radio-btn" name="answer[{{ $question }}]"
                                        value="d" required aria-invalid="true"
                                        ninvalid="this.setCustomValidity('الرجاء اختيار اجابة للسؤال')"
                                        title="الرجاء اختيار اجابة للسؤال">
                                </div>







                                <!--<div class="col-2 text-center">{{ str_replace(range(0, 9), range('٠', '٩'), $question) }}</div>-->
                            </div>
                        @endfor


                </form>

                @endif


            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        // Get the countdown date from local storage, or set it to 1 hour from the current time
        var countDownDate = localStorage.getItem("countDownDate{{ $week }}") || (new Date().getTime() +
            {{ $timeExam }});
        // console.log(countDownDate);

        // Update the countdown date in local storage and delete countdown on submit
        var hasResult = @json(session()->has('result'));
        if (!hasResult) {
            localStorage.setItem("countDownDate{{ request('week') }}", countDownDate);
        }

        // Calculate the remaining time and update the timer element
        // Calculate the remaining time and update the timer element
        function updateTimer() {
            // Get the current time
            var now = new Date().getTime();

            // Calculate the time remaining
            var distance = countDownDate - now;

            // If the timer has reached zero, submit the form and hide the exam details
            if (distance < 0) {
                clearInterval(x);
                // Remove countdown date from local storage
                localStorage.removeItem("countDownDate{{ $week }}");
                document.getElementById("quiz-form").submit();
                document.getElementById("container-cus").style.display = "none";
            }

            // Calculate the minutes and seconds remaining
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Format the time with minutes and seconds on the same line
            var formattedTime = minutes + "m " + seconds + "s";

            // Update the timer element
            document.getElementById("timer").innerHTML = formattedTime;
        }


        // Update the timer immediately
        updateTimer();

        // Update the timer every second
        var x = setInterval(updateTimer, 1000);

        // Get the quiz form element
        var quizForm = document.getElementById("quiz-form");
        quizForm.addEventListener("submit", function(event) {

            // remove current time after submit :
            localStorage.removeItem("countDownDate{{ $week }}");

            // Loop through all keys in local storage and remove each key-value pair
            // for (var i = 0; i < localStorage.length; i++) {
            //     var key = localStorage.key(i);
            //     if (key.startsWith("countDownDate")) {
            //         localStorage.removeItem(key);
            //     }
            // }
        });
    </script>
@endsection
