<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        margin: 0;
        padding: 1cm 2cm;
        color: black;
        font-size: 10pt;
    }

    header {
        height: 8cm;
        padding: 0 2cm;
        position: running(header);
        background-color: #B8E6F1;
    }

    header .headerSection {
        display: flex;
        justify-content: space-between;
    }

    td,
    th {
        border: 1px solid rgb(200, 200, 223);
        text-align: center;
        align-items: center;
    }

    header .headerSection:first-child {
        padding-top: .5cm;
    }

    header .headerSection:last-child {
        padding-bottom: .5cm;
    }

    header .headerSection div:last-child {
        width: 35%;
    }

    header .logoAndName {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    header .logoAndName svg {
        width: 1.5cm;
        height: 1.5cm;
        margin-right: .5cm;
    }

    header .headerSection .estimateDetails {
        padding-top: 1cm;
    }

    header .headerSection .issuedTo {
        display: flex;
        justify-content: space-between;
    }

    header .headerSection .issuedTo h3 {
        margin: 0 .75cm 0 0;
        color: #60D0E4;
    }

    header .headerSection div p {
        margin-top: 2px;
    }

    header h1,
    header h2,
    header h3,
    header p {
        margin: 0;
    }

    header h2,
    header h3 {
        text-transform: uppercase;
    }

    header hr {
        margin: 1cm 0 .5cm 0;
    }

    main table {
        width: 100%;
        border-collapse: collapse;
        border: solid 1px black;
    }

    main table thead th {
        text-align: center;
        color: #1d2627;
    }

    main table tbody td {
        padding: 4mm 1cm 4mm 1cm;
        text-align: center;
    }

    main table.summary {
        margin-top: .5cm;
    }

    main table.summary tr.total {
        font-weight: bold;
        background-color: #ebe7f7;
    }

    main table.summary th,
    main table.summary td {
        padding: 4mm 1cm 4mm 1cm;
        border-bottom: 0;
    }

    main table.summary1 {
        margin-top: .5cm;
        margin-bottom: 0.5cm;
        width: 100%;
    }

    main table.summary1 tr {
        font-weight: bold;
        background-color: #e3e9e4;
    }

    main table.summary1 th,
    main table.summary1 td {
        padding: 4mm 1cm 4mm 1cm;
        border-bottom: 0;
    }

    .xx {
        font-family: 'Arial', sans-serif;
        direction: rtl;
    }
</style>

<body>
    <div class="headerSection">
        <table width="100%" style="border: none;">
            <tr>
                <td>
                    <div class="logoAndName">
                        <div class="">
                            <h1 class="" style="">{{ $Global_platFormName }}</h1>
                            <h2 class="">{{ $Global_teacherName }}</h2>
                        </div>
                    </div>
                </td>
                <td align="right">
                    <div class="">
                        <img src="{{ public_path('welcome/images/pdfLogo.jpg') }}" alt="" width="80" height="80">
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <hr />
    <div class="headerSection">
        <div class="h1">Student ID: <b>{{ $marks->user_id }}</b></div>
        <div class="h1 mt-3 x" style="margin-top: 2%;">Student Name: <b
                style="direction: rtl;">{{ $marks->user_name }}</b></div>
        <div class="h1 mt-3" style="margin-top: 2%;">Student Grade: <b>{{ $marks->user_grade }}</b></div>
        <div class="h1 mt-3" style="margin-top: 2%;">Student Code: <b>{{ $marks->user_id }}</b></div>
        <h1 class="" style="margin-top: 5%; text-align: center;">Exams Result
            {{-- (Total Percentage : {{ $totalper }}) --}}
        </h1>
        <main>
            @if ($marks)
                <table>
                    <tr>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Time</th>
                        <th>Percentage</th>
                        <th>GPA</th>
                        <th>----></th>
                        <th>Total Percentage</th>
                        <th>GPA</th>

                    </tr>
                    @for ($i = 1; $i <= 45; $i++)
                        @php
                            $markValue = $marks->{'week' . $i . 'sec4'};
                            $markTime = $marks->{'week' . $i . 'sec4Time'};
                        @endphp
                        @if ($markValue !== '#')
                            <tr>
                                <td>
                                    <h2>Exam <b>{{ $i }}</b></h2>
                                </td>
                                <td>
                                    <h2>{{ $markValue }}</h2>
                                </td>
                                <td>
                                    <h5> {{ $markTime }}</h5>
                                </td>
                                <td>
                                    @if (isset($data["week{$i}sec4"]))
                                        <h2>
                                            {{ $data["week{$i}sec4"] }}
                                        </h2>
                                    @else
                                        <h2>غائب</h2>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($data["week{$i}sec4"]))
                                        @if ($data["week{$i}sec4"] >= 90)
                                            <h2>ممتاز</h2>
                                        @elseif ($data["week{$i}sec4"] >= 70)
                                            <h2>جيد جدا</h2>
                                        @elseif ($data["week{$i}sec4"] >= 50)
                                            <h2>جيد</h2>
                                        @else
                                            <h2>ساقط</h2>
                                        @endif
                                    @else
                                        <h2>غائب</h2>
                                    @endif
                                </td>
                                <td>----></td>
                                <td>
                                    @if (isset($columnTotals["week{$i}sec4"]))
                                        <h2>
                                            {{ $columnTotals["week{$i}sec4"] }}
                                        </h2>
                                    @else
                                        <h2>غائب</h2>
                                    @endif
                                </td>
                                <td>
                                    @if (isset($columnTotals["week{$i}sec4"]))
                                        @if ($columnTotals["week{$i}sec4"] >= 90)
                                            <h2>ممتاز</h2>
                                        @elseif ($columnTotals["week{$i}sec4"] >= 70)
                                            <h2>جيد جدا</h2>
                                        @elseif ($columnTotals["week{$i}sec4"] >= 50)
                                            <h2>جيد</h2>
                                        @else
                                            <h2>ضعيف</h2>
                                        @endif
                                    @else
                                        <h2>غائب</h2>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endfor
                </table>
            @else
                <p>Student marks not found.</p>
            @endif
            <p style="text-align: center;">
            <div style="margin-top: 1%;">Powered By: {{ $Global_programmerName }} - {{ $Global_programmerPhone }}
            </div>
            </p>
        </main>
        {{-- 
        <!-- Add a container for the Chart.js chart -->
<div style="text-align: center;">
    <canvas id="myChart"></canvas>
</div>

<!-- Include Chart.js library and define the chart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    // Define your chart data and options here
    // Example:
    var data = {
        labels: ['Label 1', 'Label 2', 'Label 3'],
        datasets: [{
            label: 'Dataset Label',
            data: [20, 50, 200],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    var config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    };

    new Chart(ctx, config);
</script> --}}
    </div>

</body>



</html>
