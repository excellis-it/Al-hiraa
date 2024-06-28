
<canvas id="myChart2"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Payment Done', 'Payment Due'],
            datasets: [{
                label: 'Rs. ',
                data: [{{ $total_installments }}, {{ $payment_due }}],
                backgroundColor: [
                    '#2db976',
                    '#ffc061',
                ],
                borderColor: [
                    '#2db976',
                    '#ffc061',
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var dataset = tooltipItem.dataset;
                            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.dataIndex];
                            var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                            return currentValue + ' Rs. (' + percentage + '%)';
                        }
                    }
                },
                legend: {
                    position: 'right',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            layout: {
                padding: {
                    top: 0, // Adjust the top padding as needed
                    bottom: 0,
                    left: 0,
                    right: 0
                }
            }
        }
    });
</script>


