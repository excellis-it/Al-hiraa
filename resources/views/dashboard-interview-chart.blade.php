<canvas id="myChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
        const chartData = <?php echo $chartDataJSON; ?>;
        new Chart(document.getElementById('myChart'), {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            }
        });
</script>
