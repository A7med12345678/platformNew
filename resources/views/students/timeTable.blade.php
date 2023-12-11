    @extends('layouts.students.studentApp')
    @section('title', 'Time Table - Student')
    @section('styles')
        <link href="{{ asset('admin-css/timeTable.css') }}" rel="stylesheet">
    @endsection

    @section('content')

        <div class="container mt-5 p-5">

            <div class="h2 mb-5">Time Table</div>
            <div class="container">
                <div class="table-responsive">
                    <div class="">
                        <table class="table m-4 p-4" dir="rtl">
                            <!--<thead>-->
                            <!--    <th scope="col">Time</th>-->
                            <!--    <th scope="col">Monday</th>-->
                            <!--    <th scope="col">Tuesday</th>-->
                            <!--    <th scope="col">Wednesday</th>-->
                            <!--    <th scope="col">Thursday</th>-->
                            <!--    <th scope="col">Friday</th>-->
                            <!--    <th scope="col">Saturday</th>-->
                            <!--    <th scope="col">Sunday</th>-->
                            <!--</thead>-->
                            <thead>
                                <th scope="col">الوقت</th>
                                <th scope="col">الاثنين</th>
                                <th scope="col">الثلاثاء</th>
                                <th scope="col">الأربعاء</th>
                                <th scope="col">الخميس</th>
                                <th scope="col">الجمعة</th>
                                <th scope="col">السبت</th>
                                <th scope="col">الأحد</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">12:00pm</th>
                                    <td><span id="12mon"></span></td>
                                    <td><span id="12tue"></span></td>
                                    <td><span id="12wed"></span></td>
                                    <td><span id="12thu"></span></td>
                                    <td><span id="12fri"></span></td>
                                    <td><span id="12sat"></span></td>
                                    <td><span id="12sun"></span></td>
                                </tr>
                                <tr class="bg-green">
                                    <th scope="row">1:00pm</th>
                                    <td><span id="01mon"></span></td>
                                    <td><span id="01tue"></span></td>
                                    <td><span id="01wed"></span></td>
                                    <td><span id="01thu"></span></td>
                                    <td><span id="01fri"></span></td>
                                    <td><span id="01sat"></span></td>
                                    <td><span id="01sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">2:00pm</th>
                                    <td><span id="02mon"></span></td>
                                    <td><span id="02tue"></span></td>
                                    <td><span id="02wed"></span></td>
                                    <td><span id="02thu"></span></td>
                                    <td><span id="02fri"></span></td>
                                    <td><span id="02sat"></span></td>
                                    <td><span id="02sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">3:00pm</th>
                                    <td><span id="03mon"></span></td>
                                    <td><span id="03tue"></span></td>
                                    <td><span id="03wed"></span></td>
                                    <td><span id="03thu"></span></td>
                                    <td><span id="03fri"></span></td>
                                    <td><span id="03sat"></span></td>
                                    <td><span id="03sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">4:00pm</th>
                                    <td><span id="04mon"></span></td>
                                    <td><span id="04tue"></span></td>
                                    <td><span id="04wed"></span></td>
                                    <td><span id="04thu"></span></td>
                                    <td><span id="04fri"></span></td>
                                    <td><span id="04sat"></span></td>
                                    <td><span id="04sun"></span></td>
                                </tr>
                                <tr class="bg-green">
                                    <th scope="row">5:00pm</th>
                                    <td><span id="05mon"></span></td>
                                    <td><span id="05tue"></span></td>
                                    <td><span id="05wed"></span></td>
                                    <td><span id="05thu"></span></td>
                                    <td><span id="05fri"></span></td>
                                    <td><span id="05sat"></span></td>
                                    <td><span id="05sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">6:00pm</th>
                                    <td><span id="06mon"></span></td>
                                    <td><span id="06tue"></span></td>
                                    <td><span id="06wed"></span></td>
                                    <td><span id="06thu"></span></td>
                                    <td><span id="06fri"></span></td>
                                    <td><span id="06sat"></span></td>
                                    <td><span id="06sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">7:00pm</th>
                                    <td><span id="07mon"></span></td>
                                    <td><span id="07tue"></span></td>
                                    <td><span id="07wed"></span></td>
                                    <td><span id="07thu"></span></td>
                                    <td><span id="07fri"></span></td>
                                    <td><span id="07sat"></span></td>
                                    <td><span id="07sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">8:00pm</th>
                                    <td><span id="08mon"></span></td>
                                    <td><span id="08tue"></span></td>
                                    <td><span id="08wed"></span></td>
                                    <td><span id="08thu"></span></td>
                                    <td><span id="08fri"></span></td>
                                    <td><span id="08sat"></span></td>
                                    <td><span id="08sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">9:00pm</th>
                                    <td><span id="09mon"></span></td>
                                    <td><span id="09tue"></span></td>
                                    <td><span id="09wed"></span></td>
                                    <td><span id="09thu"></span></td>
                                    <td><span id="09fri"></span></td>
                                    <td><span id="09sat"></span></td>
                                    <td><span id="09sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">10:00pm</th>
                                    <td><span id="10mon"></span></td>
                                    <td><span id="10tue"></span></td>
                                    <td><span id="10wed"></span></td>
                                    <td><span id="10thu"></span></td>
                                    <td><span id="10fri"></span></td>
                                    <td><span id="10sat"></span></td>
                                    <td><span id="10sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">11:00pm</th>
                                    <td><span id="11mon"></span></td>
                                    <td><span id="11tue"></span></td>
                                    <td><span id="11wed"></span></td>
                                    <td><span id="11thu"></span></td>
                                    <td><span id="11fri"></span></td>
                                    <td><span id="11sat"></span></td>
                                    <td><span id="11sun"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">12:00am</th>
                                    <td><span id="00mon"></span></td>
                                    <td><span id="00tue"></span></td>
                                    <td><span id="00wed"></span></td>
                                    <td><span id="00thu"></span></td>
                                    <td><span id="00fri"></span></td>
                                    <td><span id="00sat"></span></td>
                                    <td><span id="00sun"></span></td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>

    @section('js')
        <script>
            const totalValues = @json($total);
            const typeValues = @json($type);
        </script>
        <script src="{{ asset('admin-js/timeTable.js') }}"></script>
    @endsection

@endsection
