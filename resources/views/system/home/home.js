$(document).ready(function() {

    var historicodia = [];

    $.ajax({
        type: "GET",
        url: "/api/dashboard/financeiro/historicodia",
    }).done(function(responseJson) {
        historicodia = responseJson
        var ctx = document.getElementById('chartHistoryDay');
        var myChart2 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: historicodia.label,
                datasets: [{
                    label: 'Valores',
                    data: historicodia.data,
                    borderColor: '#000000',
                    backgroundColor: '#5e4cd3'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
            }
        });
    });



});