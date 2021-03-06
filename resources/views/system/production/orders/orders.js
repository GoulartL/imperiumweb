$(document).ready(function() {
    var min_fixed = 0.45;
    var table = $('#tbOrders').DataTable({
        language: traducao,
        processing: true,
        serverSide: true,
        ajax: "/api/pedidos",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'customer_name', name: 'customer_name' },
            {
                data: null,
                render: function(data, type, row) {
                    if (data['cancellation_date'] != null || data['cancellation_reason'] != null) {
                        status = 'danger';
                        setor = 'Cancelado'
                    } else if (data['sector'] == 1) {
                        status = 'light';
                        setor = 'PCP';
                    } else if (data['sector'] == 2) {
                        status = 'dark';
                        setor = 'Costura';
                    } else if (data['sector'] == 3) {
                        status = 'info';
                        setor = 'Acabamento';
                    } else if (data['sector'] == 4) {
                        status = 'primary';
                        setor = 'Expedição'
                    } else {
                        status = 'success';
                        setor = 'Finalizado'
                    }
                    return "<span class='badge badge-" + status + "'>" + setor + "</span>";
                }
            },
            { data: 'entry_date', name: 'entry_date' },
            { data: 'incoming_invoice', name: 'incoming_invoice' },
            { data: 'ref', name: 'ref' },
            { data: 'model', name: 'model' },
            { data: 'collection', name: 'collection' },
            { data: 'qty', name: 'qty', render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { data: 'price', name: 'price', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            {
                data: null,
                render: function(data, type, row) {
                    return (data['price'] / min_fixed).toFixed(0);
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return (data['qty'] * (data['price'] / min_fixed)).toFixed(0);
                }
            },
            { data: 'observation', name: 'observation' },
            {
                data: null,
                className: 'text-nowrap',
                render: function(data, type, row) {
                    return "<button class='btn btn-primary btn-sm mx-1 action'><i class='fas fa-tasks action-table'></i></button>" +
                        "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" +
                        "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>";
                }
            }
        ],
        columnDefs: [
            { orderable: false, targets: [13] },
            { targets: [4], render: $.fn.dataTable.render.moment('DD/MM/YYYY') },
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
    $("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddOrder'><i class='fas fa-plus mr-2'></i>Novo Pedido</button>");

    $('#mdAddOrder').on('click', function() {
        $("form#orderForm :input").each(function() {
            $(this).val('').trigger('change');
        });
    });

    $('#mdInputQty, #mdInputPrice').on('change', function(e) {
        $('#mdInputTotal').val($('#mdInputQty').val() * $('#mdInputPrice').val());
    });

    $('#tbOrders tbody').on('click', '.edit', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#mdCrudTitle').html('Editar pedido');
        $('#mdInputID').val(data['id']);
        $('#mdInputCode').val(data['code']);
        $('#mdInputEntryDate').datepicker('update', moment(data['entry_date']).format("DD/MM/YYYY"));
        $('#mdInputCustomers').append(new Option(data['customer_name'], data['customer'], true, true)).trigger('change');
        $('#mdInputIncomingInvoice').val(data['incoming_invoice']);
        $('#mdInputRef').val(data['ref']);
        $('#mdInputModel').val(data['model']);
        $('#mdInputCollection').val(data['collection']);
        $('#mdInputQty').val(data['qty']);
        $('#mdInputPrice').val((data['price']).toFixed(2));
        $('#mdInputTotal').val((data['qty'] * data['price']).toFixed(2));
        $('#mdInputObservations').val(data['observation']);
        $('#mdCrud').modal('show');
    });

    $('#tbOrders tbody').on('click', '.remove', function() {
        var data = table.row($(this).parents('tr')).data();
        customConfirm('Confirmar ação?', 'Se você excluir este pedido, todos os registros no diário de produção deste pedido também serão deletados!', function() {
            $.ajax({
                type: "DELETE",
                url: "/api/pedidos/remover/" + data['id'],
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                table.ajax.reload();
            });
        });
    });

    $('#tbOrders tbody').on('click', '.action', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#mdSectorsTitle').html('Andamento');
        $('#mdInputID').val('');
        $('#mdOrderID').html(data['id']);
        $('#mdOrderInputID').val(data['id']);
        $('#mdOrderSector').val(data['sector']);
        $('#mdOrderCode').html(data['code']);
        $('#mdOrderCustomer').html(data['customer'] + ' - ' + data['customer_name']);
        $('#mdOrderEntryDate').html(moment(data['entry_date']).format("DD/MM/YYYY"));
        $('#mdOrderRef').html(data['ref']);
        $('#mdOrderModel').html(data['model']);
        $('#mdOrderCollection').html(data['collection']);
        $('#mdOrderQty').html(data['qty']);

        if (data['delivery_date_sewing'] != null)
            $('#mdOrderInputDeliveryDateSewing').datepicker('update', moment(data['delivery_date_sewing']).format("DD/MM/YYYY"));
        if (data['expected_date_sewing'] != null)
            $('#mdOrderInputExpectedDateSewing').datepicker('update', moment(data['expected_date_sewing']).format("DD/MM/YYYY"));
        if (data['departure_date_sewing'] != null)
            $('#mdOrderInputDepartureDateSewing').datepicker('update', moment(data['departure_date_sewing']).format("DD/MM/YYYY"));
        if (data['delivery_date_finishing'] != null)
            $('#mdOrderInputDeliveryDateFinishing').datepicker('update', moment(data['delivery_date_finishing']).format("DD/MM/YYYY"));
        if (data['expected_date_finishing'] != null)
            $('#mdOrderInputExpectedDateFinishing').datepicker('update', moment(data['expected_date_finishing']).format("DD/MM/YYYY"));
        if (data['departure_date_finishing'] != null)
            $('#mdOrderInputDepartureDateFinishing').datepicker('update', moment(data['departure_date_finishing']).format("DD/MM/YYYY"));
        if (data['entry_date_expedition'] != null)
            $('#mdOrderInputEntryDateExpedition').datepicker('update', moment(data['entry_date_expedition']).format("DD/MM/YYYY"));
        if (data['expected_date_expedition'] != null)
            $('#mdOrderInputExpectedDateExpedition').datepicker('update', moment(data['expected_date_expedition']).format("DD/MM/YYYY"));
        if (data['departure_date_expedition'] != null)
            $('#mdOrderInputDepartureDateExpedition').datepicker('update', moment(data['departure_date_expedition']).format("DD/MM/YYYY"));
        $('#mdOrderInputOutgoingInvoice').val(data['outgoing_invoice']);

        $('div.setup-panel div a').addClass('btn-secondary text-dark');
        $('#sector' + data['sector']).removeClass('btn-secondary text-dark').addClass('btn-primary text-white');
        $('.setup-content').hide();
        $($('#sector' + data['sector']).attr('href')).show();

        if (data['cancellation_date'] != null || data['cancellation_reason'] != null) {
            $('#mdOrderInputCancellationDate').datepicker('update', moment(data['cancellation_date']).format("DD/MM/YYYY"));
            $('#mdOrderInputCancellationReason').val(data['cancellation_reason']);
            $('#divCancel').addClass('bg-danger text-white');
            $('#divCancel').html('CANCELADO');
            console.log('entrei')
        } else {
            console.log(data['cancellation_date'])
            $('#divCancel').removeClass('bg-danger text-white');
            $('#divCancel').html('Cancelamento');
        }
        $('#mdSectors').modal('show');
    });

    $('#orderForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#mdInputID').val() == '') {
            $.ajax({
                type: "POST",
                url: "/api/pedidos/guardar",
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('orderForm');
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
                url: "/api/pedidos/editar/" + $('#mdInputID').val(),
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('orderForm');
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

    $('#sectorsActionForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#mdOrderInputID').val() != '') {
            $.ajax({
                type: "PUT",
                url: "/api/pedidos/editar/" + $('#mdOrderInputID').val(),
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('sectorsActionForm');
                if (response.status == "success") {
                    table.ajax.reload();
                    $('#mdSectors').modal('hide');
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
        clearAllInputsValues('orderForm');
    })

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function(e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.addClass('btn-secondary text-dark');
            $item.removeClass('btn-secondary text-dark').addClass('btn-primary text-white');
            $('#mdOrderSector').val($item.text());
            allWells.hide();
            $target.show();
        }
    });

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

    $('div.setup-panel div a.btn-success').trigger('click');
});