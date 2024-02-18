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
    <!-- เปลี่ยนที่อยู่ของไฟล์ jQuery เป็นที่อยู่ที่ถูกต้อง -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- เปลี่ยนที่อยู่ของไฟล์ Chart.js เป็นที่อยู่ที่ถูกต้อง -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            $.post("data_Pro.php", function (data) {
                console.log(data);
                var names = [];
                var quantities = [];

                for (var i in data) {
                    names.push(data[i].ServiceProduct_Name);
                    quantities.push(data[i].TotalOrders); // แก้จาก TotalPurchases เป็น TotalOrders
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

                var graphTarget = $("#graphCanvas");

                var pieChart = new Chart(graphTarget, {
                    type: 'line',
                    data: chartdata
                });
            });
        }
    </script>
</body>
</html>
