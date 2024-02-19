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
    
    <!-- เพิ่มฟอร์มเลือกเดือน -->
    <form id="monthForm">
        <label for="month">Select month:</label>
        <select id="month" name="month">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <!-- เพิ่มตัวเลือกเดือนตามต้องการ -->
        </select>
        <button type="button" onclick="showGraph()">Show Graph</button>
    </form>

    <script>
        $(document).ready(function () {
            // ส่วนนี้ถูกเรียกเมื่อหน้าเว็บโหลดเสร็จ
            showGraph(); // เรียกฟังก์ชัน showGraph เพื่อแสดงกราฟโดยใช้ข้อมูลเดิม (เดือนเริ่มต้น)
        });

        function showGraph() {
            var selectedMonth = document.getElementById('month').value; // ดึงค่าเดือนที่เลือกจากฟอร์ม

            $.post("data_Pro.php", { month: selectedMonth }, function (data) {
                console.log(data);
                var names = [];
                var quantities = [];

                for (var i in data) {
                    names.push(data[i].ServiceProduct_Name);
                    quantities.push(data[i].TotalOrders);
                }

                var chartdata = {
                    labels: [แกลบ,รำข้าว,ข้าวท่อน,ข้าวปลาย],
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

                // Clear previous chart if any
                if(window.pieChart !== undefined){
                    window.pieChart.destroy();
                }

                var pieChart = new Chart(graphTarget, {
                    type: 'pie',
                    data: chartdata
                });

                // Store chart instance in global variable
                window.pieChart = pieChart;
            });
        }
    </script>
</body>
</html>
