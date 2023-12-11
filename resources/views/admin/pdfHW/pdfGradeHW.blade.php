<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <meta charset="utf-8"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<meta charset="UTF-8">

<style>
    * {
        font-family: DejaVu Sans, sans-serif;
    }

    body {
        /* font-family: 'Arial', sans-serif; Replace with an Arabic font */
        /*direction: rtl*/
        /* Set the direction to Right-to-Left */
        /* direction: rtl !important; */
        /* text-align: right !important; */

        margin: 0;
        padding: 1cm 2cm;
        color: black;
        font-size: 10pt;
    }


    a {
        color: inherit;
        text-decoration: none;
    }


    hr {
        margin: 1cm 0;
        height: 0;
        border: 0;
        border-top: 1mm solid #60D0E4;
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

    td {
        border: 1px solid rgb(200, 200, 223);
        text-align: center;
    }

    th {
        border: 1px solid rgb(200, 200, 223);
        text-align: center;
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
        border: solid 1px bl;
    }
    }


    main table thead th {
        text-align: center;
        color: #1d2627;
        /* padding: 2mm 2cm 2mm 2cm; */
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


    main table.summary th {
        padding: 4mm 2cm 4mm 2cm;
        border-bottom: 0;
    }

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


    main table.summary1 th {
        padding: 4mm 2cm 4mm 2cm;
        border-bottom: 0;
    }


    main table.summary1 td {
        padding: 4mm 1cm 4mm 1cm;
        border-bottom: 0;
    }

    .xx {

        font-family: 'Arial', sans-serif;
        /* Replace with an Arabic font */
        direction: rtl;
        /* Set the direction to Right-to-Left */
    }
</style>

<body>
    <div class="headerSection">
        <!-- As a logo we take an SVG element and add the name in an standard H1 element behind it. -->
        <div class="logoAndName">
            {{-- <img src="personal.jpg-" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"k,b 
                style="border-radius: 50%;opacity: .8;width: 50px; "> --}}
                <h1 class="">{{ $Global_platFormName }}</h1>
                <h2 class="">{{ $Global_teacherName }}</h2>
                {{-- <h2 class="" style="text-align:right;">M</h1> --}}
        </div>

    </div>


    <hr />


    <div class="headerSection">
        <h1 style="margin-top: 5%; text-align: center;">{{ $id }} Sec ,
            {{ str_replace(['week', 'sec3'], ['Exam ', ''], $exam) }} Result</h1>
        <main>
            @if ($marks->count() > 0)
                <table cellspacing="100%" cellpadding="100%" style="border: 1px solid black;">
                    <tr style="border: 1px solid black;">
                        <th style="border: 3px solid black;"> Name </th>
                        <th style="border: 3px solid black;"> Mark </th>
                    </tr>
                    @foreach ($marks as $mark)
                        <tr style="border: 1px solid black;">
                            <td style="direction: rtl; border: 1px solid black;">{{ $mark->user_name }}</td>
                            <td style="direction: rtl; border: 1px solid black;">{{ $mark->$exam }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>No HW records found for the specified grade and exam.</p>
            @endif
            <p style="text-align: center;">
            <div style="margin-top: 1%;">
                Powered By: {{ $Global_programmerName }} - {{ $Global_programmerPhone }}
            </div>
            </p>
        </main>


    </div>
</body>

</html>
