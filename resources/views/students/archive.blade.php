@php
    use App\Helpers\MediaValidationHelper;
    use App\Models\exam;
    // $user_start_from = [1, 7 , 14]; // Example start range
    // $user_end_to = [3, 8 , 19]; // Example end range
@endphp

@extends('layouts.students.studentApp')
@section('title', 'أرشيف المحاضرات')
@section('content')
    <div class="container mt-5">
        
        <!-- Lesson Titles -->
        @for ($i = 0; $i < count($user_start_from); $i++)
            <hr>
            @php
                $startWeek = $user_start_from[$i];
                $endWeek = $user_end_to[$i];
                $displayed_lessons = [];
                $isFirstIteration = true; // Flag to check if it's the first iteration
            @endphp

            {{-- session return: --}}
            @if (session('flash_msg'))
                <div class="alert alert-danger m-5 h4 text-center p-3">
                    {{ session('flash_msg') }}
                </div>
            @endif

            @for ($week = $startWeek; $week <= $endWeek; $week++)
                @if (!in_array($week, $displayed_lessons))
                    <div class="m-4 p-4 text-center week-content week{{ $week }} border"
                        style="background:#dde2e8; position:relative; display: {{ $content && $content->selected_section && $content->selected_week >= $week ? 'block' : 'none' }};">
                        <div class="text-white p-3 m-3"
                            style="position:absolute; top:-30px; left:-30px; border-radius:50%; background:#da3807;">
                            {{ $Global_unitName }} {{ $week }}
                        </div>

                        @php
                            $okOrNo = null;
                            // Skip exam condition for the first iteration in the outer loop
                            if ($isFirstIteration) {
                                $isFirstIteration = false; // Set the flag to false after the first iteration
                            } else {
                                $okOrNo = exam::where('user_id', Auth::user()->center_code)->pluck('week' . ($week - 1) . 'sec4');
                            }
                        @endphp

                        @if ($okOrNo == '["#"]')
                            الرجاء اجتياز الامتحان السابق
                        @else
                            {{-- lesson content start : --}}
                            @if (Storage::exists('public/SepartePdfWeek/' . Auth::user()->grade . '/' . $week . '/' . $week . '.pdf'))
                                <div class="p-3 m-3 bg-primary"
                                    style="position:absolute; top:-30px; right:-40px; border-radius:50%;">
                                    <a class="text-white"
                                        href="{{ asset('storage/SepartePdfWeek/' . Auth::user()->grade . '/' . $week . '/' . $week . '.pdf') }}"
                                        download>
                                        {{ $Global_unitName_Download }}
                                    </a>
                                </div>
                            @endif

                            @for ($section = 1; $section <= 5; $section++)
                                @php $videoInfo=MediaValidationHelper::getVideoInfo($week, $section, $user_grade); @endphp
                                @if ($section == 5)
                                    <hr class="mt-4">
                                    <form method="POST" action="{{ route('liveStream') }}">
                                        @csrf
                                        <!-- CSRF token to protect against cross-site request forgery -->
                                        <input type="hidden" name="link" value="{{ $element['live'] }}">
                                        <button type="submit" class="btn btn_live">
                                            <span class="live-button live p-2 pr-4 pl-4">
                                                <span class="mr-3">
                                                    <!--Live-->
                                                    لايف الحصة</span>
                                                <span>
                                                    <i class="fa-solid fa-tower-broadcast ml-2"></i>
                                                </span>
                                            </span>
                                        </button>
                                    </form>
                                @elseif ($section == 4)
                                    <div class="m-4 mt-5 sec-content sec{{ $section }}"
                                        style="display: {{ $content && ($week < $content->selected_week || ($week == $content->selected_week && $section <= intval(substr($content->selected_section, -1)))) ? 'block' : 'none' }};">
                                        <a class="btn btn-success"
                                            href="{{ route('weeks/weekExam', ['week' => $week, 'section' => $section, 'isValidG' => Auth::user()->grade . $random_mask]) }}">
                                            <!--Exam-->
                                            امتحان
                                        </a>
                                    </div>
                                @elseif ($section == 3)
                                    <div class="p-2 m-3 sec-content sec text-white bg-warning"
                                        style="position:absolute; top:-30px; left:70px;  display: {{ $content &&
                                        ($week < $content->selected_week ||
                                            ($week == $content->selected_week && $section <= intval(substr($content->selected_section, -1))))
                                            ? 'block'
                                            : 'none' }}">


                                        <a class="btn text-white"
                                            href="{{ route('weeks/weekHW', ['week' => $week, 'section' => $section, 'isValidG' => Auth::user()->grade . $random_mask]) }}">
                                            <!--Home Work-->
                                            واجب
                                        </a>
                                    </div>
                                <!--week lec1, 2 if exists : -->
                                @elseif ($section == 1 || $section == 2)
                                    @foreach ($data["week{$week}"] ?? [] as $element)
                                        @if ($element['sec'] == $section)
                                            <div class="m-4 sec-content sec{{ $section }}"
                                                style="display: {{ $content && ($week < $content->selected_week || ($week == $content->selected_week && $section <= intval(substr($content->selected_section, -1)))) ? 'block' : 'none' }};">

                                                <!--each lec title (from api) : -->
                                                <div class="h3 flex-end title" style="color: #3f4c6b;"> المحاضرة
                                                    :
                                                    {{ $element['title'] }}
                                                </div>
                                                <!--each lec video with (mp4, mkv) -->
                                                @if ($videoInfo['videoExists'] or $videoInfo['videoExists2'])
                                                    <!--mp4 existnce : -->
                                                    @if ($videoInfo['videoExists'])
                                                        <video
                                                            poster="{{ asset('storage/image/posters/' . Auth::user()->grade . '/' . $poster->content) }}"
                                                            preload="none"
                                                            src="{{ asset('storage/videos/' . $grade . '/' . $videoInfo['videoName']) }}"
                                                            controls style="width:100%;" class="p-4"
                                                            controlsList="nodownload"></video>

                                                        <!--mkv existnce : -->
                                                    @elseif ($videoInfo['videoExists2'])
                                                        <video
                                                            poster="{{ asset('storage/image/posters/' . Auth::user()->grade . '/' . $poster->content) }}"
                                                            preload="none"
                                                            src="{{ asset('storage/videos/' . $grade . '/' . $videoInfo['videoName2']) }}"
                                                            controls style="width:100%;" class="p-4"
                                                            controlsList="nodownload"></video>
                                                    @endif
                                                @else
                                                    <p class="text-danger font-weight-bold m-4">
                                                        {{ $Global_videoError }}
                                                    </p>
                                                @endif

                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endfor
                            {{-- lesson content end --}}
                        @endif

                    </div>
                    @php
                        $displayed_lessons[] = $week;
                    @endphp
                @endif
            @endfor
        @endfor
    </div>
@endsection
