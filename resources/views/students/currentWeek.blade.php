@php
    use App\Helpers\MediaValidationHelper;
    use App\Models\exam;
@endphp
@extends('layouts.students.studentApp')
@section('title', 'محاضرات الأسبوع')
@section('content')
    @include('components.flashMsg')

    <div class="container mt-5">
        <!--{{$max_week}}-->
        <!---->
        <!--Each week content (lec , lec , exam) -->
        @if ($user_grade === $grade)
       
            @for ($week = $max_week; $week >= $max_week; $week--)
            
             
                {{-- session return: --}}
                @if (session('flash_msg'))
                    <div class="alert alert-danger m-5 h4 text-center p-3">
                        {{ session('flash_msg') }}
                    </div>
                @endif

                <div class="m-4 p-4 text-center week-content week{{ $max_week }} border"
                    style="background:#dde2e8; position:relative; ">
                    <div class="text-white p-3 m-3"
                        style="position:absolute; top:-30px; left:-30px; border-radius:50%; background:#da3807;">
                        {{ $Global_unitName }} {{ $max_week }}
                    </div>

                    @php
                        $okOrNo = null;
                        if ($max_week != 1) {
                            // Check if $max_week is not 1
                            $okOrNo = exam::where('user_id', Auth::user()->center_code)->pluck('week' . ($max_week - 1) . 'sec4');
                        }
                    @endphp

                    @if ($max_week != 1 && $okOrNo == '["#"]')
                        <!-- Check $max_week and $okOrNo -->
                        الرجاء اجتياز الامتحان السابق
                    @else
                        @if (Storage::exists('public/SepartePdfWeek/' . Auth::user()->grade . '/' . $max_week . '/' . $max_week . '.pdf'))
                            <div class="p-3 m-3 bg-primary"
                                style="position:absolute; top:-30px; right:-40px; border-radius:50%;">
                                <a class="text-white"
                                    href="{{ asset('storage/SepartePdfWeek/' . Auth::user()->grade . '/' . $max_week . '/' . $max_week . '.pdf') }}"
                                    download>
                                    {{ $Global_unitName_Download }}
                                </a>
                            </div>
                        @endif

                        @for ($section = 1; $section <= 5; $section++)
                            @php $videoInfo=MediaValidationHelper::getVideoInfo($max_week, $section, $user_grade); @endphp <!-- week exam : (pass -> current week , exam of week , user grade) -->
                            @if ($section == 5)
                                <hr class="mt-4">
                                <form method="POST" action="{{ route('liveStream') }}">
                                    @csrf
                                    <input type="hidden" name="link" value="{{ $element['live'] }}">

                                    <button type="submit" class="btn btn_live">
                                        <span class="live-button live p-2 pr-4 pl-4">
                                            <span class="mr-3">
                                                <!--LIVE-->
                                                لايف الحصة
                                                </span>
                                            <span>
                                                <i class="fa-solid fa-tower-broadcast ml-2"></i>
                                            </span>
                                        </span>
                                    </button>
                                </form>
                            @elseif ($section == 4)
                                <div class="m-4 mt-5 sec-content sec{{ $section }}"
                                    style="display: {{ $content && ($max_week < $content->selected_week || ($max_week == $content->max_week && $section <= intval(substr($content->selected_section, -1)))) ? 'block' : 'none' }};">
                                    <a class="btn btn-success"
                                        href="{{ route('weeks/weekExam', ['week' => $max_week, 'section' => $section, 'isValidG' => Auth::user()->grade . $random_mask]) }}">
                                        <!--Exam-->
                                        امتحان
                                        </a>
                                </div>
                            @elseif ($section == 3)
                                <div class="p-2 m-3 sec-content sec text-white bg-warning"
                                    style="position:absolute; top:-30px; left:70px; border-radius:50%; display: {{ $max_week &&
                                    ($max_week < $content->selected_week ||
                                        ($max_week == $content->selected_week && $section <= intval(substr($content->selected_section, -1))))
                                        ? 'block'
                                        : 'none' }}">

                                    <a class="btn text-white"
                                        href="{{ route('weeks/weekHW', ['week' => $max_week, 'section' => $section, 'isValidG' => Auth::user()->grade . $random_mask]) }}">
                                        <!--Home Work-->
                                        واجب
                                    </a>
                                </div>
                            <!--week lec1, 2 if exists : -->
                            @elseif ($section == 1 || $section == 2)
                                @foreach ($data["week{$max_week}"] ?? [] as $element)
                                    @if ($element['sec'] == $section)
                                        <div class="m-4 sec-content sec{{ $section }}"
                                            style="display: {{ $content && ($max_week < $content->selected_week || ($max_week == $content->selected_week && $section <= intval(substr($content->selected_section, -1)))) ? 'block' : 'none' }};">
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
                                                    <video preload="none"
                                                        poster="{{ asset('storage/image/posters/' . Auth::user()->grade . '/' . $poster) }}"
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
                    @endif
                </div>
            @endfor
        @endif
        <!---->
    </div>

@endsection
