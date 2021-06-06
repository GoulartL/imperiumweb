$(document).ready(function() {
    var table = $('#tbPayments').DataTable({
        language: traducao,
        processing: true,
        serverSide: true,
        ajax: "/api/pagamentos",
        columns: [
            { data: 'id', name: 'id', className: 'status' },
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'description', name: 'description' },
            { data: 'value', name: 'value', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            { data: 'due_date', name: 'due_date' },
            { data: 'portion', name: 'portion' },
            { data: 'emission', name: 'emission' },
            { data: 'payment_date', name: 'payment_date' },
            { data: 'payment_value', name: 'payment_value', render: $.fn.dataTable.render.number('.', ',', 2, 'R$') },
            { data: 'specie_name', name: 'specie_name' },
            { data: 'observation', name: 'observation' },
            {
                data: null,
                className: 'text-nowrap',
                render: function(data, type, row) {
                    return "<button class='btn btn-primary btn-sm mx-1 action'><i class='fas fa-dollar-sign action-table'></i></button>" +
                        "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" +
                        "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>";
                }
            },
        ],
        columnDefs: [
            { className: "text-nowrap-pc", targets: "_all" },
            { orderable: false, targets: [11] },
            { targets: [4, 6, 7], render: $.fn.dataTable.render.moment('DD/MM/YYYY') }
        ],
        createdRow: function(row, data, index) {
            if (data["payment_value"] >= data['value']) {
                $(row).find('td:eq(0)').addClass("tb-success");
            } else if (moment(data['due_date']).isBefore(moment())) {
                $(row).find('td:eq(0)').addClass("tb-error");
            } else if (data["payment_value"] < data['value'] && data["payment_value"]) {
                $(row).find('td:eq(0)').addClass("tb-warning");
            } else {
                $(row).find('td:eq(0)').addClass("tb-none");
            }
        },
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

    var tablePortions = $('#tbPortions').DataTable({
        language: traducao,
        dom: 't',
        paging: false,
        columnDefs: [
            { className: "text-nowrap-pc", targets: "_all" },
            { orderable: false, targets: [3] }
        ],
    });

    var formatCurrency = { minimumFractionDigits: 2 }

    //Top button of the table
    $("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddPayments'><i class='fas fa-plus mr-2'></i>Novo Pagamento</button>");

    //Novo pagamento
    $('#mdAddPayments').on('click', function() {
        $('#mdDivValue, #mdDivDueDate').hide();
        $('#mdPortionDiv, #mdDivSupplier').show();
        $('#mdCrudTitle').html('Novo Pagamento');
        tablePortions.clear().draw();
        $("form#paymentsForm :input").each(function() {
            $(this).val('').trigger('change');
        });
        $('#mdInputEmission').datepicker('update', moment().format("DD/MM/YYYY"));
    });

    //Editar um pagamento
    $('#tbPayments tbody').on('click', '.edit', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#mdCrudTitle').html('Editar Pagamento');
        $('#mdInputID').val(data['id']);
        $('#mdInputDueDate').datepicker('update', moment(data['due_date']).format("DD/MM/YYYY"));
        $('#mdInputEmission').datepicker('update', moment(data['emission']).format("DD/MM/YYYY"));
        $('#mdInputDescription').val(data['description']);
        $('#mdInputValue').val(data['value']);
        $('#mdInputPortions').val(data['portion']);
        $('#mdInputSuppliers').append(new Option(data['supplier_name'], data['supplier'], true, true)).trigger('change');
        $('#mdInputSpecies').append(new Option(data['specie_name'], data['species'], true, true)).trigger('change');
        $('#mdPortionDiv, #mdDivSupplier').hide();
        $('#mdDivValue, #mdDivDueDate').show();
        $('#mdCrud').modal('show');
    });

    $('#tbPayments tbody').on('click', '.action', function() {
        var data = table.row($(this).parents('tr')).data();
        $('#mdPaymentTitle').html('Lançar Pagamento');
        $('#mdPayID').html(data['id']);
        $('#mdPaymentID').val(data['id']);
        $('#mdInputID').val('');
        $('#mdPaySupplier').html(data['supplier'] + ' - ' + data['supplier_name']);
        $('#mdPayDescription').html(data['description']);
        $('#mdPayDueDate').html(moment(data['due_date']).format("DD/MM/YYYY"));
        $('#mdPayPortion').html(data['portion']);
        $('#mdPayValue').html(data['value']);
        $('#mdPayment').modal('show');
    });

    $('#tbPayments tbody').on('click', '.remove', function() {
        var data = table.row($(this).parents('tr')).data();
        customConfirm('Confirmar ação?', 'Você está prestes a excluir o pagamento [' + data['id'] + ']', function() {
            $.ajax({
                type: "DELETE",
                url: "/api/pagamentos/remover/" + data['id'],
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                table.ajax.reload();
            });
        });
    });

    $('#paymentsForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#mdInputID').val() == '') {
            $.ajax({
                type: "POST",
                url: "/api/pagamentos/guardar",
                data: JSON.stringify({
                    header: $(this).serializeArray(),
                    payments: tablePortions.rows().data().toArray()
                })
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('paymentsForm');
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
                url: "/api/pagamentos/editar/" + $('#mdInputID').val(),
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('paymentsForm');
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

    $('#paymentActionForm').on('submit', function(e) {
        e.preventDefault();
        if ($('#mdPaymentID').val() != '') {
            $.ajax({
                type: "PUT",
                url: "/api/pagamentos/editar/" + $('#mdPaymentID').val(),
                data: $(this).serializeArray(),
            }).done(function(responseJson) {
                response = JSON.parse(responseJson);
                toastAlert(response.status, response.message);
                clearAllInputsValidations('paymentActionForm');
                if (response.status == "success") {
                    table.ajax.reload();
                    $('#mdPayment').modal('hide');
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
        clearAllInputsValues('paymentsForm');
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

    $('.select-client-side').select2({
        dropdownPosition: 'below'
    });

    $('#mdAddPortions').on('click', function(e) {
        e.preventDefault();
        var portions = $('#mdInputPortions').val();
        var total = $('#mdInputTotal').val();
        var firstDueDate = $('#mdInputFirstDueDate').val();
        var duedate = moment(firstDueDate, "DD/MM/YYYY");
        var valueTemp = 0;

        if (portions && total && firstDueDate) {
            for (let index = 0; index < portions; index++) {
                duedate = index == 0 ? duedate : moment(duedate).add(1, 'months');
                tablePortions.row.add([
                    index + 1,
                    (total / portions).toLocaleString('pt-BR', formatCurrency),
                    duedate.format("DD/MM/YYYY"),
                    "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" +
                    "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>"
                ]).draw();
            }
            $('#mdInputTotal, #mdInputPortions, #mdInputFirstDueDate').val('');
        } else {
            toastAlert('warning', 'Preencha os campos "Total", "Parcelas" e "1° Vencimento" para poder incluir parcelas.');
        }
    });

    $('#tbPortions tbody').on('click', '.edit', function(e) {
        e.preventDefault();
        var data = tablePortions.row($(this).parents('tr')).data();
        tablePortions.row($(this).parents('tr')).data([
            data[0],
            "<input type='text' value='" + data[1] + "'/>",
            "<input class='input-date' type='text' value='" + moment(data[2], "DD/MM/YYYY").format("DD/MM/YYYY") + "'>",
            "<button class='btn btn-primary btn-sm mx-1 savePortionEdit'><i class='fas fa-check'></i></button>"
        ]);
    });

    $('#tbPortions tbody').on('click', '.savePortionEdit', function(e) {
        e.preventDefault();
        var data = tablePortions.row($(this).parents('tr')).data();
        var row = tablePortions.row($(this).parents('tr')).node()
        tablePortions.row($(this).parents('tr')).data([
            data[0],
            row.cells[1].children[0].value,
            row.cells[2].children[0].value,
            "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" +
            "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>"
        ]);
    });

    $('#tbPortions tbody').on('click', '.remove', function(e) {
        e.preventDefault();
        tablePortions.row($(this).parents('tr')).remove().draw();
        tablePortions
            .rows()
            .every(function(rowIdx, tableLoop, rowLoop) {
                tablePortions.cell(rowIdx, 0).data(++rowLoop);
            })
            .draw();
    });

    $('#tbPortions').on('focus', ".input-date", function() {
        $(this).datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true,
            todayHighlight: true
        });
    });

});