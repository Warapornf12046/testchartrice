<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
    BODY {
        width: 550PX;
    }

    #chart-container {
        width: 100%;
        height: auto;
    }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
</head>
<body>
<div id="chart-container">
    <canvas id="graphCanvas"></canvas>
</div>

<script>
    $(document).ready(function () {
        showGraph();
    });

    function showGraph() {
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

            var graphTarget = $("#graphCanvas");

            var barGraph = new Chart(graphTarget, {
                type: 'pie',
                data: chartdata
            });
        });
    }
</script>
</body>
</html>
