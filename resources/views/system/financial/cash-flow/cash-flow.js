$(document).ready(function() {

    var historicomes = historicodia = [];

    $.ajax({
        type: "GET",
        url: "/api/dashboard/financeiro/historicomes",
    }).done(function(responseJson) {
        historicomes = responseJson
        var ctx = document.getElementById('chartHistoryMonth');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: historicomes.label,
                datasets: [{
                    label: 'Valores',
                    data: historicomes.data,
                    borderColor: '#000000',
                    backgroundColor: '#5e4cd3'
                }]
            }
        });
    });


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
            }
        });
    });


    var tablePayments = $('#tbPayments').DataTable({
        language: traducao,
        paging: false,
        ajax: "/api/dashboard/financeiro/pagarnodia",
        dom: "t",
        columns: [
            { data: 'id', name: 'id', className: 'status' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'description', name: 'description' },
            { data: 'value', name: 'value', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            { data: 'portion', name: 'portion' }
        ],
        columnDefs: [
            { className: "text-nowrap-pc", targets: "_all" },
        ]
    });

    var tableReceipts = $('#tbReceipts').DataTable({
        language: traducao,
        paging: false,
        ajax: "/api/dashboard/financeiro/recebernodia",
        dom: "t",
        columns: [
            { data: 'id', name: 'id', className: 'status' },
            { data: 'customer_name', name: 'supplier_name' },
            { data: 'description', name: 'description' },
            { data: 'value', name: 'value', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            { data: 'portion', name: 'portion' }
        ],
        columnDefs: [
            { className: "text-nowrap-pc", targets: "_all" },
        ]
    });


});