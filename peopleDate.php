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

select {
    margin-bottom: 10px;
}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
    
    <div>
        <select id="year">
            <option value="2564">2564</option>
            <!-- Add more years as needed -->
        </select>
        <select id="month">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <button onclick="showGraph()">Show Graph</button>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });

        function showGraph() {
            var year = $("#year").val();
            var month = $("#month").val();

            $.post("data_PeopleDate.php", { year: year, month: month }, function (data) {
                console.log(data);
                var months = [];
                var numOfMembers = [];

                for (var i in data) {
                    // Extracting month name from Member_Since
                    var date = new Date(data[i].Year, data[i].Month - 1, 1);
                    var monthName = date.toLocaleString('default', { month: 'long' });

                    months.push(monthName);
                    numOfMembers.push(data[i].Num_Of_Members);
                }

                var chartdata = {
                    labels: months,
                    datasets: [
                        {
                            label: 'Number of Members',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: numOfMembers
                        }
                    ]
                };

                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
        }
    </script>

</body>
</html>
