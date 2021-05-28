$(document).ready(function() {
    var table = $('#tbOrders').DataTable({
        language: traducao,
        processing: true,
        serverSide: true,
        ajax: "/api/pedidos",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'code', name: 'code' },
            { data: 'customer', name: 'customer' },
            { data: 'entry_date', name: 'entry_date' },
            { data: 'incoming_invoice', name: 'incoming_invoice' },
            { data: 'ref', name: 'ref' },
            { data: 'model', name: 'model' },
            { data: 'collection', name: 'collection' },
            { data: 'qty', name: 'qty' },
            { data: 'price', name: 'price' },
            { data: 'total', name: 'total' },
            /*
            { data: 'cancellation_date', name: 'state' },
            { data: 'cancellation_reason', name: 'complement' },
            { data: 'delivery_date_sewing', name: 'zip_code' },
            { data: 'departure_date_sewing', name: 'contact_name' },
            { data: 'delivery_date_finishing', name: 'phone_number_1' },
            { data: 'expected_date_finishing', name: 'phone_number_2' },
            { data: 'departure_date_finishing', name: 'email_1' },
            { data: 'entry_date_expedition', name: 'email_2' },
            { data: 'outgoing_invoice', name: 'bank' },
            { data: 'departure_date_expedition', name: 'agency' },*/
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
            { className: "text-nowrap-pc", targets: "_all" },
            { orderable: false, targets: [21] },
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
            $(this).val('');
        });
    });

    $('#tbOrders tbody').on('click', '.edit', function() {
        var data = table.row($(this).parents('tr')).data();

        $('#mdCrudTitle').html('Editar Registro');
        $('#mdInputID').val(data['id']);
        $('#mdInputTaxVat').val(data['taxvat']);
        $('#mdInputType').val(data['type'] == '1' ? 'CNPJ' : 'CPF');
        $('#mdInputName').val(data['name']);
        $('#mdInputShortName').val(data['fantasy_name']);
        $('#mdInputIdRegister').val(data['state_register_id']);
        $('#mdInputAddress').val(data['address']);
        $('#mdInputNumber').val(data['number']);
        $('#mdInputDistrict').val(data['district']);
        $('#mdInputCity').val(data['city']);
        $('#mdInputState').val(data['state']);
        $('#mdInputComplement').val(data['complement']);
        $('#mdInputContactName').val(data['contact_name']);
        $('#mdInputZipcode').val(data['zip_code']);
        $('#mdInputTel1').val(data['phone_number_1']);
        $('#mdInputTel2').val(data['phone_number_2']);
        $('#mdInputEmail1').val(data['email_1']);
        $('#mdInputEmail2').val(data['email_2']);
        $('#mdInputBank').val(data['bank']);
        $('#mdInputAccountName').val(data['account_name']);
        $('#mdInputAccountNumber').val(data['account']);
        $('#mdInputAgency').val(data['agency']);
        $('#mdInputObservations').val(data['observation']);

        $('#mdCrud').modal('show');
    });

    $('#tbOrders tbody').on('click', '.remove', function() {
        var data = table.row($(this).parents('tr')).data();

        customConfirm('Confirmar ação?', 'Você está prestes a excluir o registro [' + data['name'] + ']', function() {
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

    $('#mdCrud').on('hidden.bs.modal', function(event) {
        clearAllInputsValues('orderForm');
    })

});