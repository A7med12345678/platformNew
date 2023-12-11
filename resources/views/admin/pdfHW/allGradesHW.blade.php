<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HW Results</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    body,
    td,
    th {
        font-family: 'dejavusans', sans-serif;
        direction: rtl;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .headerSection {
        /* Your header section styles here */
    }

    .title {
        margin-top: 5%;
        text-align: center;
    }

    .powered-by {
        text-align: center;
        margin-top: 1%;
    }
</style>

<body>
    Powered By: {{ $Global_programmerName }} - {{ $Global_programmerPhone }}

    <div class="headerSection">
        <h1 class="title">Home Work Results for Grade {{ $marks->first()->user_grade }}</h1>
        <main>
            @if ($marks->count() > 0)
                <table>
                    <tr>
                        <th class="p-3">Student Name</th>
                        <th class="p-2">Code </th>
                        @for ($i = 1; $i <= 10; $i++)
                            <th>HW {{ $i }} </th>
                        @endfor
                    </tr>
                    @foreach ($marks as $mark)
                        <tr>
                            <td style="direction: rtl;" class="p-3">{{ $mark->user_name }}</td>
                            <td>{{ $mark->user_id }}</td>
                            @for ($i = 1; $i <= 10; $i++)
                                <td>{{ $mark->{'week' . $i . 'sec3h'} }}</td>
                            @endfor
                        </tr>
                    @endforeach


                    <tr style="margin-top:50px;">
                        <th>Student Name</th>
                        <th>Code</th>
                        @for ($i = 11; $i <= 20; $i++)
                            <th>HW {{ $i }} </th>
                        @endfor
                    </tr>
                    @foreach ($marks as $mark)
                        <tr>
                            <td style="direction: rtl;">{{ $mark->user_name }}</td>
                            <td>{{ $mark->user_id }}</td>
                            @for ($i = 11; $i <= 20; $i++)
                                <td>{{ $mark->{'week' . $i . 'sec3h'} }}</td>
                            @endfor
                        </tr>
                    @endforeach

                    <tr style="margin-top:50px;">
                        <th>Student Name</th>
                        <th>Code</th>
                        @for ($i = 21; $i <= 30; $i++)
                            <th>HW {{ $i }} </th>
                        @endfor
                    </tr>
                    @foreach ($marks as $mark)
                        <tr>
                            <td style="direction: rtl;">{{ $mark->user_name }}</td>
                            <td>{{ $mark->user_id }}</td>
                            @for ($i = 21; $i <= 30; $i++)
                                <td>{{ $mark->{'week' . $i . 'sec3h'} }}</td>
                            @endfor
                        </tr>
                    @endforeach

                    <tr style="margin-top:50px;">
                        <th>Student Name</th>
                        <th>Code</th>
                        @for ($i = 31; $i <= 40; $i++)
                            <th>HW {{ $i }} </th>
                        @endfor
                    </tr>
                    @foreach ($marks as $mark)
                        <tr>
                            <td style="direction: rtl;">{{ $mark->user_name }}</td>
                            <td>{{ $mark->user_id }}</td>
                            @for ($i = 31; $i <= 40; $i++)
                                <td>{{ $mark->{'week' . $i . 'sec3h'} }}</td>
                            @endfor
                        </tr>
                    @endforeach


                    <tr style="margin-top:50px;">
                        <th>Student Name</th>
                        <th>Code</th>
                        @for ($i = 41; $i <= 45; $i++)
                            <th>HW {{ $i }} </th>
                        @endfor
                    </tr>
                    @foreach ($marks as $mark)
                        <tr>
                            <td style="direction: rtl;">{{ $mark->user_name }}</td>
                            <td>{{ $mark->user_id }}</td>
                            @for ($i = 41; $i <= 45; $i++)
                                <td>{{ $mark->{'week' . $i . 'sec3h'} }}</td>
                            @endfor
                        </tr>
                    @endforeach





                </table>
            @else
                <p>No HW records found for the specified grades and .</p>
            @endif
            <p class="powered-by">
                Powered By: {{ $Global_programmerName }} - {{ $Global_programmerPhone }}
            </p>
        </main>
    </div>
</body>

</html>
