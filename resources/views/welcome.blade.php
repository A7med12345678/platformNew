@extends('layouts.welcomeApp')
@section('title', $Global_teacherName)
@section('page-content')


    <!-- Start Hero Area -->
    <section class="hero-area">
        <div class="hero-slider">
            <!-- Single Slider -->
            <!--<div class="hero-inner overlay" style="background-image: url(asset('welcome/images/slider/slider-bg1.webp'));">-->
            <!--        <div class="container">-->
            <!--            <div class="row ">-->
            <!--                <div class="col-lg-8 offset-lg-2 col-md-12 co-12">-->
            <!--                    <div class="home-slider">-->
            <!--                        <div class="hero-text">-->
            <!--                            <h5 class="wow fadeInUp" data-wow-delay=".3s">Start to Learning Today</h5>-->
            <!--                            <h1 class="wow fadeInUp" data-wow-delay=".5s">Excellent And Friendly <br> Faculty Members</h1>-->
            <!--                            <p class="wow fadeInUp" data-wow-delay=".7s">Lorem Ipsum is simply dummy text of the-->
            <!--                                printing and typesetting <br> industry. Lorem Ipsum has been the industry's-->
            <!--                                standard-->
            <!--                                <br>dummy text ever since an to impression.</p>-->
            <!--                            <div class="button wow fadeInUp" data-wow-delay=".9s">-->
            <!--                                <a href="about-us.html" class="btn">Learn More</a>-->
            <!--                                <a href="courses-grid.html" class="btn alt-btn">Our Courses</a>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--/ End Single Slider -->
            <!-- Single Slider -->
            <div class="hero-inner" style="background-image: url('{{ asset('welcome/images/slider/hero.png') }}');">

                <div class="container">
                    <div class="row ">
                        <div class="col-lg-8 offset-lg-2 col-md-12 co-12">
                            <div class="home-slider">
                                <div class="hero-text">
                                    <h5 class="wow fadeInUp" data-wow-delay=".3s" style="font-weight:bold;">
                                        {{ __('messages.dashboard_label') }}
                                        {{-- ابدا من اليوم --}}
                                    </h5>
                                    <div class="border p-5 m-2"
                                        style="border-radius:15px; background:rgb(255 , 255 , 255 , 0.7);">
                                        <h1 class="wow fadeInUp" data-wow-delay=".5s"
                                            style="font-family:Marhey; color:black; font-weight:bold;">
                                            م/ إبراهيم عمار
                                        </h1>
                                        <p class="wow fadeInUp" data-wow-delay=".7s"
                                            style="font-family:Marhey; color:black; font-weight:bold;">
                                            {{-- منصة متخصصة في علوم الفيزياء للمرحلة الثانوية --}}
                                            {{ __('messages.dashboard_about') }}
                                            <br>
                                            <br>
                                            {{-- (الطالب أولًا) --}}
                                            {{ __('messages.dashboard_label2') }}
                                        </p>
                                    </div>
                                    <div class="button wow fadeInUp" data-wow-delay=".9s">
                                        <a href="{{ route('FreeContent') }}" class="btn" style="font-family:Changa;">
                                            {{-- المحتوى المجاني --}}
                                            {{ __('messages.dashboard_link') }}
                                        </a>
                                        <a href="{{ route('register') }}" class="btn alt-btn" style="font-family:Changa;">
                                            {{-- إنضم إلينا --}}
                                            {{ __('messages.dashboard_join') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Single Slider -->
            <!-- Single Slider -->
            <!--<div class="hero-inner overlay" style="background-image: url('assets/images/hero/slider-bg3.jpg');">-->
            <!--    <div class="container">-->
            <!--        <div class="row ">-->
            <!--            <div class="col-lg-8 offset-lg-2 col-md-12 co-12">-->
            <!--                <div class="home-slider">-->
            <!--                    <div class="hero-text">-->
            <!--                        <h5 class="wow fadeInUp" data-wow-delay=".3s">Start to learning Today</h5>-->
            <!--                        <h1 class="wow fadeInUp" data-wow-delay=".5s">Your Ideas Will Be <br> Heard & Supported</h1>-->
            <!--                        <p class="wow fadeInUp" data-wow-delay=".7s">Lorem Ipsum is simply dummy text of the-->
            <!--                            printing and typesetting <br> industry. Lorem Ipsum has been the industry's-->
            <!--                            standard-->
            <!--                            <br>dummy text ever since an to impression.</p>-->
            <!--                        <div class="button wow fadeInUp" data-wow-delay=".9s">-->
            <!--                            <a href="about-us.html" class="btn">Learn More</a>-->
            <!--                            <a href="#" class="btn alt-btn">Our Courses</a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--/ End Single Slider -->
        </div>
    </section>
    <!--/ End Hero Area -->

    <!-- Start About Us Area -->
    <section class="about-us section">
        <div class="container">

            <div class="row  mx-auto text-center ml-5 pl-5">
                <div class="col-lg-6 col-12">
                    <div class="about-left">
                        <div class="about-title align-center">
                            <span class="wow fadeInDown" data-wow-delay=".2s">About Our University</span>
                            <h2 class="wow fadeInUp mt-2" data-wow-delay=".4s" style="font-family:Marhey;">
                                {{-- ? ما الجديد لدينا --}}
                                {{ __('messages.dashboard_what_new') }}
                            </h2>
                            <p class="wow fadeInUp text-right" data-wow-delay=".6s"
                                style="text-align:right; font-family:Changa;">

                                تقدم منصة فيزياء التعليمية للمرحلة الثانوية تجربة تعلم فريدة وشيقة للطلاب. تم تصميم المنصة
                                بعناية لتلبية احتياجات الطلاب في مجال الفيزياء، وتوفير بيئة تعلم محفزة تسهم في تطوير
                                مهاراتهم وفهمهم العميق للمفاهيم العلمية.
                                <br>
                                <br>
                                يقدم البرنامج الدراسي على المنصة شرحاً وافياً للمواضيع الرئيسية في مجال الفيزياء، مع توضيحات
                                ورسوم توضيحية تسهم في توضيح الأفكار الصعبة. يمكن للطلاب استكشاف الدروس بشكل تفاعلي، مما يجعل
                                عملية التعلم أكثر إشراكاً ومتعة.
                                <br>
                                <br>
                                توفر المنصة أيضاً مجموعة متنوعة من التمارين والأسئلة التي تساعد الطلاب على تطبيق المفاهيم
                                التي تعلموها. كما يتاح لهم متابعة تقدمهم وفحص إجاباتهم لفهم أوجه القوة والضعف.
                            </p>
                            <div class="button wow fadeInUp" data-wow-delay="1s">
                                <a href="{{ $Global_teacherWhatsApp }}" class="btn">
                                    {{-- تواصل معنا --}}
                                    {{ __('messages.dashboard_contact_with') }}
                                </a>
                                <a href="{{ $Global_dashboard_video_youtube }}" class="glightbox video btn">
                                    {{-- ! المزيد --}}
                                    {{ __('messages.dashboard_link') }}
                                    <i class="lni lni-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-right wow fadeInRight" data-wow-delay=".4s">
                        <img src="{{ asset('storage/image/' . $view_image) }}" alt="#">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /End About Us Area -->

    <!-- Start Courses Area -->
    <section class="courses section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <div class="section-icon wow zoomIn" data-wow-delay=".4s">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s" style="font-family:Changa;">
                            {{-- الكورسات المتاحة --}}
                            {{ __('messages.dashboard_courses_above') }}
                        </h2>
                        <br>
                        <p class="wow fadeInUp" data-wow-delay=".6s">
                            {{ __('messages.dashboard_courses_desc') }}
                            {{-- : نوفر مجموعة وافية من الكورسات للمرحلة الثانوي ما يشمل --}}
                            <br>
                            {{ __('messages.dashboard_courses_desc2') }}
                            {{-- (شرح, امتحان, واجب, متابعة ولي الأمر) --}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Course -->
                        <div class="single-course wow fadeInUp" data-wow-delay=".2s"
                            style="border: 1px gray solid; border-radius:15px;">
                            <div class="content" style="text-align:center;">
                                <h3>
                                    <a href="course-details.html">
                                        {{-- الصف الثاني الثانوي --}}
                                        {{ __('messages.dashboard_course3_title') }}
                                    </a>
                                </h3>
                                <p>
                                    {{-- كورس شامل لمحتوى الصف الثاني الثانوي --}}
                                    {{ __('messages.dashboard_course3_title') }}
                                </p>
                            </div>
                            <div class="bottom-content">
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li>
                                        {{-- 200 :عدد الطلاب الحالي --}}
                                        {{-- {{ __('messages.dashboard_course3_current') }} --}}
                                    </li>
                                </ul>
                                <div class="text-center">
                                    {{ __('messages.dashboard_course3_current') }}
                                </div>
                                <span class="tag">
                                    <i class="lni lni-tag"></i>
                                    <a href="{{ route('register') }}">
                                        {{-- مدة الكورس: إشتراك متجدد --}}
                                        {{ __('messages.dashboard_course_2_3_time') }}
                                    </a>
                                </span>
                            </div>
                        </div>
                        <!-- End Single Course -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-course wow fadeInUp" data-wow-delay=".2s"
                            style="border: 1px gray solid; border-radius:15px;">
                            <div class="content" style="text-align:center;">
                                <h3>
                                    <a href="{{ route('register') }}">
                                        {{-- الصف الثالث الثانوي --}}
                                        {{ __('messages.dashboard_course2_title') }}
                                    </a>
                                </h3>
                                <p>
                                    {{-- كورس شامل لمحتوى الصف الثالث الثانوي --}}
                                    {{ __('messages.dashboard_course2_title') }}
                                </p>
                            </div>
                            <div class="bottom-content">
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    {{-- <li>
                                        200 :عدد الطلاب الحالي
                                    </li> --}}
                                </ul>
                                <div class="text-center">
                                    {{ __('messages.dashboard_course2_current') }}
                                </div>
                                <br>
                                <span class="tag">
                                    <i class="lni lni-tag"></i>
                                    <a href="{{ route('register') }}">
                                        {{-- مدة الكورس: إشتراك متجدد --}}
                                        {{ __('messages.dashboard_course_2_3_time') }}
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-course wow fadeInUp" data-wow-delay=".2s"
                            style="border: 1px gray solid; border-radius:15px;">
                            <div class="content" style="text-align:center;">
                                <h3>
                                    <a href="{{ route('freeContentPDF') }}">
                                        {{-- كورسات مجانية --}}
                                        {{ __('messages.dashboard_course1_title') }}
                                    </a>
                                </h3>
                                <p>
                                    {{-- محتىوي مجاني من الفيديوهات والملازم يتم نشره للطلاب بصورة مجانية داخل المنصة على مدار
                                    العام --}}
                                    {{ __('messages.dashboard_course1_desc') }}
                                </p>
                            </div>
                            <div class="bottom-content">
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <!--<li>200 :عدد الطلاب الحالي</li>-->
                                </ul>
                                <span class="tag">
                                    <i class="lni lni-tag"></i>
                                    <a href="{{ route('register') }}">
                                        {{-- مدة الكورس: إشتراك متجدد --}}
                                        {{ __('messages.dashboard_course_2_3_time') }}
                                    </a>
                                </span>
                                <div class="text-center">
                                    <a class=" mt-3" href="{{ route('FreeContent') }}">
                                        {{-- (
                                        اضغط هنا للاطلاع عليه
                                        ) --}}
                                        {{ __('messages.dashboard_course1_link1') }}
                                    </a>
                                    <br>
                                    <div class="text-center">
                                        <a class=" mt-3" href="{{ route('freeContentPDF') }}">
                                            {{-- (
                                            PDF اضغط هنا للاطلاع عليه
                                            ) --}}
                                            {{ __('messages.dashboard_course1_link2') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>
    <!-- End Courses Area -->

    <!-- Start Achivement Area -->
    <section class="our-achievement section overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="counter"><span id="secondo1" class="countup" cup-end="99">99%</span>+</h3>
                        <h4 style="font-family:Marhey;">
                            {{-- نسبة النجاح --}}
                            {{ __('messages.dashboard_sta1') }}
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".4s">
                        <h3 class="counter"><span id="secondo2" class="countup" cup-end="17">17</span>+</h3>
                        <h4 style="font-family:Marhey;">
                            {{-- خبرة في التدريس --}}
                            {{ __('messages.dashboard_sta2') }}
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="counter"><span id="secondo1" class="countup" cup-end="1500">1500</span>+</h3>
                        <h4 style="font-family:Marhey;">
                            {{-- طالب سنويًا --}}
                            {{ __('messages.dashboard_sta3') }}
                        </h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="single-achievement wow fadeInUp" data-wow-delay=".4s">
                        <h3 class="counter"><span id="secondo2" class="countup" cup-end="20000">20000</span>+</h3>
                        <h4 style="font-family:Marhey;">
                            {{-- طالب سابقًا --}}
                            {{ __('messages.dashboard_sta4') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Achivement Area -->
@endsection
