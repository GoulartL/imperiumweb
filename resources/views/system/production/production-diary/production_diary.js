$(document).ready(function() {
    var min_fixed = 0.45;
    var table = $('#tbProductionDiary').DataTable({
        language: traducao,
        processing: true,
        serverSide: true,
        ajax: "/api/diario_de_producao",
        columns: [
            { data: 'id', name: 'id', className: 'text-right' },
            { data: 'date', name: 'date' },
            { data: 'employees', name: 'employees', className: 'text-right' },
            { data: 'order', name: 'order' },
            { data: 'customer_name', name: 'customer_name' },
            { data: 'ref', name: 'ref' },
            { data: 'model', name: 'model' },
            { data: 'collection', name: 'collection' },
            { data: 'qty_order', name: 'qty_order', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: 'text-right' },
            { data: 'qty', name: 'qty', render: $.fn.dataTable.render.number('.', ',', 0, ''), className: 'text-right' },
            { data: 'price_order', name: 'price_order', render: $.fn.dataTable.render.number('.', ',', 2, 'R$'), className: 'text-right' },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number('.', ',', 2, 'R$'), className: 'text-right' },
            {
                data: null,
                className: 'text-right',
                render: function(data, type, row) {
                    return (data['price_order'] / min_fixed).toFixed(0);
                }
            },
            {
                data: null,
                className: 'text-right',
                render: function(data, type, row) {
                    return (data['qty'] * (data['price_order'] / min_fixed)).toFixed(0);
                }
            },
            { data: 'observation', name: 'observation' },
            {
                data: null,
                className: 'text-nowrap',
                render: function(data, type, row) {
                    return "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" +
                        "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>";
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: [15] },
            { targets: [1], render: $.fn.dataTable.render.moment('DD/MM/YYYY') },
            { className: "text-nowrap-pc", targets: "_all" }
        ],
        dom: "<'row'<'col-sm-12 col-md-6 toolbar text-center text-sm-left'><'col-sm-12 col-md-6 search-datatables'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        responsive: {
            details: {
                renderer: function(api, rowIdx, columns) {
                    var data = $.map(columns, function(col, i) {
                        return col.hidden ?
                            '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                            '<td class="font-weight-bold">' + col.title + ':' + '</td> ' +
                            '<td>' + col.data + '</td>' +
                            '</tr>' :
                            '';
                    }).join('');

                    return data ?
                        $('<table class="w-100 p-0 table-sm"/>').append(data) :
                        false;
                }
            }
        }
    });

    //Top button of the table
    $("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddRow'><i class='fas fa-plus mr-2'></i>Novo Apontamento</button>");

    $('#mdAddRow').on('click', function() {
        $("form#productionDiaryForm :input").each(function() {
            $(this).val('').trigger('change');
        });
    });

    $('#mdInputOrders').on('change', function(e) {
        $('#mdInputTotalProduced').val($('#mdInputQtyProduced').val() * $('#mdInputPriceOrder').val());
    });

    $('#mdInputQtyProduced').on('keyup', function(e) {
        $('#mdInputTotalProduced').val($('#mdInputQtyProduced').val() * $('#mdInputPriceOrder').val());
    });

    $('#mdInputOrders').on('change', function(e) {
        if ($(this).select2('data') != "") {
            $.ajax({
                type: "GET",
                url: "/api/pedidos/" + $(this).val(),
            }).done(function(response) {
                if (typeof response !== 'undefined') {
                    row = response.data[0];
                    $('#mdInpuCustomer').val(row.customer_name);
                    $('#mdInputRef').val(row.ref);
                    $('#mdInputModel').val(row.model);
                    $('#mdInputCollection').val(row.collection);
                    $('#mdInputQtyOrder').val(row.qty);
                    $('#mdInputPriceOrder').val(row.price);
                    $('#mdInputTotalOrder').val(row.total);
                }
            });
        }
    });

    $('#tbProductionDiary tbody').on('click', '.edit', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#mdCrudTitle').html('Editar apontamento');
        $('#mdInputID').val(data['id']);
        $('#mdInputDate').datepicker('update', moment(data['date']).format("DD/MM/YYYY"));
        $('#mdInputEmployees').val(data['employees']);
        $('#mdInputOrders').append(new Option(data['order'], data['id'], true, true)).trigger('change');
        $('#mdInpuCustomer').val(data['customer']);
        $('#mdInputRef').val(data['ref']);
        $('#mdInputModel').val(data['model']);
        $('#mdInputCollection').val(data['collection']);
        $('#mdInputQtyOrder').val(data['qty_order']);
        $('#mdInputPriceOrder').val((data['price_order']).toFixed(2));
        $('#mdInputTotalOrder').val((data['qty_order'] * data['price_order']).toFixed(2));
        $('#mdInputQtyProduced').val(data['qty']);
        $('#mdInputTotalProduced').val(data['total']);
        $('#mdInputObservations').val(data['observation']);
        $('#mdCrud').modal('show');
    });

    $('#tbProductionDiary tbody').on('click', '.remove', function() {
        var data = table.row($(this).parents('tr')).data();
        customConfirm('Confirmar ação?', 'Você está prestes a excluir o apontamento [' + data['id'] + ']', function() {
            $.ajax({
                type: "DELETE",
                url: "/api/diario_de_producao/remover/" + data['id'],
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                table.ajax.reload();
            });
        });
    });


    $('#productionDiaryForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#mdInputID').val() == '') {
            $.ajax({
                type: "POST",
                url: "/api/diario_de_producao/guardar",
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('productionDiaryForm');
                if (response.status == "success") {
                    table.ajax.reload();
                    $('#mdCrud').modal('hide');
                } else {
                    for (var prop in response.data) {
                        invalidateInput(prop, response.data[prop][0]);
                    }
                }
            });
        } else {
            $.ajax({
                type: "PUT",
                url: "/api/diario_de_producao/editar/" + $('#mdInputID').val(),
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('productionDiaryForm');
                if (response.status == "success") {
                    table.ajax.reload();
                    $('#mdCrud').modal('hide');
                } else {
                    for (var prop in response.data) {
                        invalidateInput(prop, response.data[prop][0]);
                    }
                }
            });
        }

        return false;

    });

    $('#mdCrud').on('hidden.bs.modal', function(event) {
        clearAllInputsValues('productionDiaryForm');
    })

    $('.select-server-side').each(function(e) {
        $(this).select2({
            ajax: {
                delay: 250,
                theme: "bootstrap",
                url: '/api/' + $(this).attr("data-values") + '/select',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                }
            }
        })
    });

});