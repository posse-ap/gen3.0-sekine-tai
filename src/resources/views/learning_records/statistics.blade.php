<!-- resources/views/learning_records/statistics.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Learning Statistics</h1>

    <div>
        <h2>Today's Total Learning Time: {{ $todayTotal }} hours</h2>
        <h2>Monthly Total Learning Time: {{ $monthTotal }} hours</h2>
    </div>

    <div style="display: flex; justify-content: space-around; margin-top: 20px;">
        <div style="width: 50%;">
            <h2>Monthly Learning Time Chart</h2>
            <canvas id="monthlyChart"></canvas>
        </div>
        <div style="width: 50%;">
            <h2>Content Distribution Chart</h2>
            <canvas id="contentChart"></canvas>
            <h2>Language Distribution Chart</h2>
            <canvas id="languageChart"></canvas>
        </div>
    </div>

    <script>
        // Monthly Learning Time Chart
        var monthlyData = @json($monthlyChartData);
        var monthlyLabels = Object.keys(monthlyData);
        var monthlyValues = Object.values(monthlyData);

        var monthlyChartCtx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(monthlyChartCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Learning Time',
                    data: monthlyValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Content Distribution Chart
        var contentData = @json($contentChartData);
        var contentLabels = contentData.map(item => item.label);
        var contentValues = contentData.map(item => item.value);
        var contentColors = contentData.map(item => item.color);

        var contentChartCtx = document.getElementById('contentChart').getContext('2d');
        var contentChart = new Chart(contentChartCtx, {
            type: 'doughnut',
            data: {
                labels: contentLabels,
                datasets: [{
                    data: contentValues,
                    backgroundColor: contentColors
                }]
            }
        });

        // Language Distribution Chart
        var languageData = @json($languageChartData);
        var languageLabels = languageData.map(item => item.label);
        var languageValues = languageData.map(item => item.value);
        var languageColors = languageData.map(item => item.color);

        var languageChartCtx = document.getElementById('languageChart').getContext('2d');
        var languageChart = new Chart(languageChartCtx, {
            type: 'doughnut',
            data: {
                labels: languageLabels,
                datasets: [{
                    data: languageValues,
                    backgroundColor: languageColors
                }]
            }
        });
    </script>
</body>
</html>
