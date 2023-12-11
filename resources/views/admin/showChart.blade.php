@extends('layouts.adminApp')
@section('title', 'Show Chart : ' . $Global_platFormName)

@section('content')
    <meta charset="UTF-8">
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto m-5">
                <div class="h2">Chart
                    {{ $type }} :
                    {{--  for : {{ $id }} --}}
                </div>
                <canvas id="myChart" height="100px"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.xyz/npm/chart.js"></script>


    <script>
        var labels = {{ Js::from($examTotals) }};
        var users = {{ Js::from($data) }};

        // Function to update the chart label
        function updateChartLabel(newLabel) {
            document.getElementById('chartLabel').textContent = newLabel;
        }

        const data = {
            labels: labels,
            datasets: [{
                label: 'marks', // Initial label, you can set it to anything
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: users,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        // Example of changing the label dynamically
        // You can call this function with the desired label, e.g., 'Exam' or 'Home Work'
        updateChartLabel('{{ $type === 'exam' ? 'Exam' : 'Home Work' }}');
    </script>

@endsection
