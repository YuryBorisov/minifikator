@extends('layout')
@section('title', 'Статистика')
@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            $.ajax({
                url: '/statistics',
                type: 'post',
                data: {url: window.location.pathname.substr("statistics".length + 2)},
                success: function (data) {
                    var data = google.visualization.arrayToDataTable($.parseJSON(data));
                    var options = {
                        is3D: false,
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            });
        }
    </script>
@endsection
@section('content')
    <div id="piechart_3d" style="width: 720px; height: 500px; float: left;"></div>
@endsection