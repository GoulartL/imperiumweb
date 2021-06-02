$(document).ready(function() {

    $.ajax({
        type: "GET",
        url: "/api/dashboard/producao/historicomes",
    }).done(function(responseJson) {
        response = JSON.parse(responseJson);
        historicomes = response.data
    });

    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: historicomes.labels,
            datasets: historicomes.datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        },
    });
});