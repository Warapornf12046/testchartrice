<!DOCTYPE html>
<html>
<head>
    <title>Creating Dynamic Data Graph using PHP and Chart.js</title>
    <style type="text/css">
        BODY {
            width: 100%;
        }

        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .chart-container {
            width: 48%;
            height: auto;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="chart-container" id="chartContainerPro">
            <canvas id="graphCanvasPro"></canvas>
        </div>

        <div class="chart-container" id="chartContainerSer">
            <canvas id="graphCanvasSer"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            showGraphPro();
            showGraphSer();
        });

        function showGraphPro() {
            $.post("data_Pro.php", function (data) {
                console.log(data);
                var names = [];
                var quantities = [];

                for (var i in data) {
                    names.push(data[i].ServiceProduct_Name);
                    quantities.push(data[i].TotalPurchases);
                }

                var chartdata = {
                    labels: names,
                    datasets: [{
                        data: quantities,
                        backgroundColor: [
                            '#FF6384',
                            '#36A2EB',
                            '#FFCE56',
                            '#4BC0C0',
                            '#9966FF'
                        ]
                    }]
                };

                var graphTarget = $("#graphCanvasPro");

                var pieChart = new Chart(graphTarget, {
                    type: 'pie',
                    data: chartdata
                });
            });
        }

        function showGraphSer() {
            $.post("data_Ser.php", function (data) {
                console.log(data);
                var name = [];
                var marks = [];

                for (var i in data) {
                    name.push(data[i].ServiceProduct_Name);
                    marks.push(data[i].TotalService);
                }

                var chartdata = {
                    labels: name,
                    datasets: [
                        {
                            label: 'Service Counts',
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: marks
                        }
                    ]
                };

                var graphTarget = $("#graphCanvasSer");

                var pieChart = new Chart(graphTarget, {
                    type: 'pie',
                    data: chartdata
                });
            });
        }
    </script>
</body>
</html>
