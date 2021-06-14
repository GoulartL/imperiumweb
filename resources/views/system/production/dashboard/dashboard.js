$(document).ready(function() {

    var historicomes = [];

    $.ajax({
        type: "GET",
        url: "/api/dashboard/producao/historicomes",
    }).done(function(responseJson) {
        historicomes = responseJson
        var ctx = document.getElementById('chartProduction');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: historicomes.label,
                datasets: [{
                    label: 'Produzido',
                    data: historicomes.data,
                    borderColor: '#5e4cd3',
                    backgroundColor: '#5e4cd3'
                }]
            },
        });
    });


});