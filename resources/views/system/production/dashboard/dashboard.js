$(document).ready(function() {

    $.ajax({
        type: "GET",
        url: "/api/dashboard/producao/historicomes",
    }).done(function(responseJson) {
        response = JSON.parse(responseJson);
        historicomes = response.data
    });

    var ctx = document.getElementById('chartProduction');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: historicomes.labels,
            datasets: [{
                label: 'Produzido',
                data: historicomes.data,
                borderWidth: 2,
                borderColor: 'rgb(75, 192, 192)',
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
});