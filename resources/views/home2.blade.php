@extends('layouts.students.studentApp')
@section('title', 'Complain - Student')
@section('styles')
    <style>
        /* Your styles go here */
    </style>
@endsection

@section('content')


    <div class="center">
        <div class="container">
            {{-- @include('components.flashMsg') --}}

         

            <!--</div>-->
            <div class="p-3 bg-success border text-white m-5 mb-2"
                style="border-radius:20px; display:flex; justify-content:space-around; align-items:center; font-weight:bold;">

                <div class="course-request">
                    @if (isset($courseRequests->status))
                        @if ($courseRequests->status == '0' || $courseRequests->status == '1')
                            <div class=""
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <div class="text-white mb-3">
                                    تم تسجيل طلبك لشراء الكورس,
                                    <br>
                                    الرجاء التواصل مع رقم
                                    {{$Global_teacherPhone}}
                                    لإتمام الشراء
                                    <!--Your request has been applied! @if ($courseRequests->status == '0')-->
                                    <!--    Contact 01142333048 to complete payment.-->
                                    @else
                                    الرجاء الانتظار بعض الوقت, جاري تجهيز الكورس
                                        <!--Please wait some time to download it.-->
                                    @endif
                                </div>
                                <div>
                                    <form action="{{ route('deleteRequestCourse', Auth::user()->grade) }}">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-danger text-white mt-1">
                                            <!--Delete-->
                                            إلغاء الطلب
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif($courseRequests->status == '2')
                            <a href="{{ route('courseBuy') }}" class="btn btn-primary text-white">
                                <!--Your course is ready !-->
                                تم الشراء بنجاح, اضغط هنا لتحميل المحتوى
                                </a>
                        @endif
                    @else
                        <div class=""
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                            <div class="text-white mb-3">
                                <!--Request to buy the current Course!-->
                                طلب شراء كورس

                            </div>
                            <div>
                                <a href="{{ route('requestCourse', Auth::user()->grade) }}"
                                    class="btn btn-primary text-white">
                                    <!--Buy Now!-->
                                    اشترِ الآن
                                    </a>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
            {{-- @include('components.flashMsg') --}}

       <div class="quarter-lesson p-5">
                <div class="grid-xl-2-sm-1">
                    <div>
                        <a class="bg-primary text-center text-white h2 p-5" href="{{ route('currentWeek') }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class="">الدرس الحالي</div>
                            <div class=""><i class="fa-solid fa-book fa-2x mt-4"></i></div>
                        </a>
                    </div>

                    <div>
                        <a class="bg-primary text-center text-white h2 p-5" href="{{ route('archive') }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class="">أرشيف الدروس</div>
                            <div class=""><i class="fa-solid fa-box-archive fa-2x mt-4"></i></div>
                        </a>
                    </div>
                </div>

                <div class="grid-xl-2-sm-1 mt-4">
                    <div>
                        <a class="bg-primary text-center text-white h2 p-5" href="{{ route('complain') }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class=""> اسأل المستر</div>
                            <div class=""><i class="fa-solid fa-question fa-2x mt-4"></i></div>
                        </a>
                    </div>

                    <div>
                        <a class="bg-primary text-center text-white h2 p-5" href="{{ route('FAQquestions') }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class=""> أسئلة عامة</div>
                            <div class=""><i class="fa-solid fa-question fa-2x mt-4"></i></div>
                        </a>
                    </div>
                </div>

                <div class="grid-xl-2-sm-1 mt-4">
                    <div>
                        <a class="bg-primary text-center text-white h2 p-5"
                            href="{{ route('editAccunt', Auth::user()->center_code) }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class="">حسابي</div>
                            <div class=""><i class="fa-solid fa-user fa-2x mt-4"></i></div>
                        </a>
                    </div>

                    <div>
                        <a class="bg-primary text-center text-white h2 p-5" href="{{ route('timeTable') }}"
                            style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">
                            <div class="">جدول المحاضرات</div>
                            <div class=""><i class="fa-solid fa-calendar-days fa-2x mt-4"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <!--<div class="quarter-lesson p-5">-->
            <!--    <div class="grid-xl-2-sm-1">-->
            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5" href="{{ route('currentWeek') }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class="">Current Lesson</div>-->
            <!--                <div class=""><i class="fa-solid fa-book fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->

            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5" href="{{ route('archive') }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class="">Archieve</div>-->
            <!--                <div class=""><i class="fa-solid fa-box-archive fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    <div class="grid-xl-2-sm-1 mt-4">-->
            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5" href="{{ route('complain') }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class=""> Complain</div>-->
            <!--                <div class=""><i class="fa-solid fa-question fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->

            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5" href="{{ route('FAQquestions') }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class=""> Common Questions</div>-->
            <!--                <div class=""><i class="fa-solid fa-question fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--    <div class="grid-xl-2-sm-1 mt-4">-->
            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5"-->
            <!--                href="{{ route('editAccunt', Auth::user()->center_code) }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class="">Edit Account</div>-->
            <!--                <div class=""><i class="fa-solid fa-user fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->

            <!--        <div>-->
            <!--            <a class="bg-primary text-center text-white h2 p-5" href="{{ route('timeTable') }}"-->
            <!--                style="border-radius:25px; display:flex; flex-direction:column; justify-content:center;">-->
            <!--                <div class="">Time Table</div>-->
            <!--                <div class=""><i class="fa-solid fa-calendar-days fa-2x mt-4"></i></div>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="instructions p-5 bg-secondary text-right text-white mb-5" style="text-align: right; border-radius:30px;">
                <h2 class="text-white">
                    :
                    تعليمات الصف
                    {{ Auth::user()->grade }}
                    الثانوي
                </h2>
                @forelse($instructions as $key => $instruction)
                    <h4 class="p-3">
                        {{ $instruction->content }}
                        <strong>-</strong>
                    </h4>
                @empty
                <div class="text-center m-5 h4">لا يوجد تعليمات</div>
                @endforelse
            </div>
        </div>
    </div>


@endsection
