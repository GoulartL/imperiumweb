@extends('system.master.layout')

@section('styles')
<link href="{{ asset('assets/datatables/datatables.css') }}" rel="stylesheet">
<link href="{{ asset('assets/select2/css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('assets/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
@endSection

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Pedidos</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Pedidos</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped w-100" id="tbOrders">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="0">Número</th>
                                <th data-priority="1">Cliente</th>
                                <th data-priority="1">Status</th>
                                <th data-priority="1">Dt. Entrada</th>
                                <th data-priority="1">NF Entrada</th>
                                <th data-priority="2">Ref.</th>
                                <th data-priority="2">Modelo</th>
                                <th data-priority="2">Coleção</th>
                                <th data-priority="1">Qtd.</th>
                                <th data-priority="1">Valor Unit.</th>
                                <th data-priority="1">Total</th>
                                <th data-priority="1">Tempo (min/unid)</th>
                                <th data-priority="1">Tempo (total)</th>
                                <th data-priority="3">Observações</th>
                                <th data-priority="0">Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('assets/datatables/datatables.js') }}"></script>
<script src="{{ asset('assets/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/select2/js/select2.js') }}"></script>
<script src="{{ asset('assets/views/production/orders/orders.js') }}"></script>
@endSection

@section('components')

<!-- Modal -->
<div class="modal fade" id="mdCrud" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="mdCrudTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="mdCrudTitle">Novo pedido</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdCrudBody">
                <form id="orderForm" action="POST" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" id="mdInputID" autocomplete="off" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputCode">Número</label>
                            <input type="text" class="form-control nextEnter" id="mdInputCode" autocomplete="off"
                                name="code">
                            <div id="fdbkcode" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputEntryDate">Data de entrada</label>
                            <input type="text" class="form-control nextEnter input-date" id="mdInputEntryDate"
                                autocomplete="off" name="entry_date">
                            <div id="fdbkentry_date" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputIncomingInvoice">NF Entrada</label>
                            <input type="text" class="form-control nextEnter" id="mdInputIncomingInvoice"
                                autocomplete="off" name="incoming_invoice">
                            <div id="fdbkincoming_invoice" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputCustomers">Cliente</label>
                            <select class="custom-select nextEnter select-server-side" data-values='clientes'
                                id="mdInputCustomers" name="customer">
                            </select>
                            <div id="fdbkcustomer" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Detalhes do produto</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputRef">Referência</label>
                            <input type="text" class="form-control nextEnter" id="mdInputRef" autocomplete="off"
                                name="ref">
                            <div id="fdbkref" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputModel">Modelo</label>
                            <input type="text" class="form-control nextEnter" id="mdInputModel" autocomplete="off"
                                name="model">
                            <div id="fdbkmodel" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputCollection">Coleção</label>
                            <input type="text" class="form-control nextEnter" id="mdInputCollection" autocomplete="off"
                                name="collection">
                            <div id="fdbkcollection" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Valores</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputQty">Quantidade</label>
                            <input type="number" class="form-control nextEnter" id="mdInputQty" autocomplete="off"
                                name="qty" step="0.01">
                            <div id="fdbkqty" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputPrice">Valor Unitário</label>
                            <input type="number" class="form-control nextEnter" id="mdInputPrice" autocomplete="off"
                                name="price" step="0.01">
                            <div id="fdbkprice" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputTotal">Total</label>
                            <input type="number" class="form-control nextEnter" id="mdInputTotal" readonly
                                autocomplete="off" step="0.01">
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Extras</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputObservations">Observações</label>
                            <textarea type="text" class="form-control nextEnter" id="mdInputObservations"
                                autocomplete="off" name="observation" rows="5"></textarea>
                            <div id="fdbkobservation" class="label-invalidate text-danger"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="mdCrudSave" form="orderForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdSectors" data-backdrop="static" data-keyboard="false" aria-labelledby="mdSectorsTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title text-center" id="mdSectorsTitle"></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdSectorsBody">
                <form id="sectorsActionForm" action="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="table-responsive rounded">
                                <table class="table table-sm table-bordered rounded table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="px-2">ID</td>
                                            <td class="px-2 text-right" id="mdOrderID"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Número</td>
                                            <td class="px-2 text-right" id="mdOrderCode"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Cliente</td>
                                            <td class="px-2 text-right" id="mdOrderCustomer"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Data de entrada</td>
                                            <td class="px-2 text-right" id="mdOrderEntryDate"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Ref</td>
                                            <td class="px-2 text-right" id="mdOrderRef"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Modelo</td>
                                            <td class="px-2 text-right" id="mdOrderModel"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Coleção</td>
                                            <td class="px-2 text-right" id="mdOrderCollection"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Qtd</td>
                                            <td class="px-2 text-right" id="mdOrderQty"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" id="mdOrderInputID" autocomplete="off" hidden
                                name='formorder'>
                            <input type="text" class="form-control" id="mdOrderSector" autocomplete="off" hidden
                                name='sector'>
                            <div class="card">
                                <div class="card-header bg-secondary" id="divCancel">
                                    <h5 class="mb-0 ml-0">Cancelamento</h5>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="mdOrderInputCancellationDate">Data Cancelamento</label>
                                <input type="text" class="form-control nextEnter input-date"
                                    id="mdOrderInputCancellationDate" autocomplete="off" name="cancellation_date">
                                <div id="fdbkcancellation_date" class=" label-invalidate text-danger"></div>
                            </div>
                            <div class="form-group col-12">
                                <label for="mdRecInputReceiptValue">Motivo Cancelamento</label>
                                <textarea class="form-control nextEnter" id="mdOrderInputCancellationReason"
                                    autocomplete="off" name="cancellation_reason"></textarea>
                                <div id="fdbkcancellation_reason" class="label-invalidate text-danger"></div>
                            </div>
                        </div>

                        {{-- WIZARD --}}
                        <div class="container">
                            <div class="row text-center mb-3">
                                <p class="col-12">Clique abaixo em uma das opçãos para defininir o status do pedido</p>
                            </div>
                            <div class="stepwizard">
                                <div class="stepwizard-row setup-panel">
                                    <div class="stepwizard-step col-xs-3">
                                        <a id='sector1' href="#step-1" type="button" class="btn btn-circle btn-primary">1</a>
                                        <p><small>PCP</small></p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a id='sector2' href="#step-2" type="button" class="btn btn-secondary btn-circle"
                                            disabled="disabled">2</a>
                                        <p><small>Costura</small></p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a id='sector3' href="#step-3" type="button" class="btn btn-secondary btn-circle"
                                            disabled="disabled">3</a>
                                        <p><small>Acabamento</small></p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a id='sector4' href="#step-4" type="button" class="btn btn-secondary btn-circle"
                                            disabled="disabled">4</a>
                                        <p><small>Expedição</small></p>
                                    </div>
                                    <div class="stepwizard-step col-xs-3">
                                        <a id='sector5' href="#step-5" type="button" class="btn btn-secondary btn-circle"
                                            disabled="disabled">5</a>
                                        <p><small>Fim</small></p>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content" id="step-1">


                            </div>

                            <div class="panel panel-primary setup-content" id="step-2">

                                <div class="panel-body">
                                    <div class="form-group col-12">
                                        <label for="mdOrderInputDeliveryDateSewing">Data de entrada</label>
                                        <input type="text" class="form-control nextEnter input-date"
                                            id="mdOrderInputDeliveryDateSewing" autocomplete="off"
                                            name="delivery_date_sewing">
                                        <div id="fdbkdelivery_date_sewing" class=" label-invalidate text-danger"></div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="mdOrderInputExpectedDateSewing">Data prevista</label>
                                        <input type="text" class="form-control nextEnter input-date"
                                            id="mdOrderInputExpectedDateSewing" autocomplete="off"
                                            name="expected_date_sewing">
                                        <div id="fdbkexpected_date_sewing class=" label-invalidate text-danger"></div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="mdOrderInputDepartureDateSewing">Data de saída</label>
                                        <input type="text" class="form-control nextEnter input-date"
                                            id="mdOrderInputDepartureDateSewing" autocomplete="off"
                                            name="departure_date_sewing">
                                        <div id="fdbkdeparture_date_sewing" class=" label-invalidate text-danger"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content" id="step-3">
                                <div class="form-group col-12">
                                    <label for="mdOrderInputDeliveryDateFinishing">Data de entrada</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputDeliveryDateFinishing" autocomplete="off"
                                        name="delivery_date_finishing">
                                    <div id="fdbkdelivery_date_finishing" class=" label-invalidate text-danger"></div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="mdOrderInputExpectedDateFinishing">Data prevista</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputExpectedDateFinishing" autocomplete="off"
                                        name="expected_date_finishing">
                                    <div id="fdbkexpected_date_finishing" class=" label-invalidate text-danger"></div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="mdOrderInputDepartureDateFinishing">Data de saída</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputDepartureDateFinishing" autocomplete="off"
                                        name="departure_date_finishing">
                                    <div id="fdbkdeparture_date_finishing" class=" label-invalidate text-danger"></div>
                                </div>
                            </div>

                            <div class="panel panel-primary setup-content" id="step-4">
                                <div class="form-group col-12">
                                    <label for="mdOrderInputEntryDateExpedition">Data de entrada</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputEntryDateExpedition" autocomplete="off"
                                        name="entry_date_expedition">
                                    <div id="fdbkentry_date_expedition" class=" label-invalidate text-danger"></div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="mdOrderInputExpectedDateExpedition">Data prevista</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputCancellationDate" autocomplete="off"
                                        name="expected_date_expedition">
                                    <div id="mdOrderInputExpectedDateExpedition" class=" label-invalidate text-danger">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="mdOrderInputDepartureDateExpedition">Data de saída</label>
                                    <input type="text" class="form-control nextEnter input-date"
                                        id="mdOrderInputDepartureDateExpedition" autocomplete="off"
                                        name="departure_date_expedition">
                                    <div id="fdbkdeparture_date_expedition" class=" label-invalidate text-danger"></div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="mdOrderInputOutgoingInvoice">NF de saída</label>
                                    <input type="text" class="form-control nextEnter" id="mdOrderInputOutgoingInvoice"
                                        autocomplete="off" name="outgoing_invoice">
                                    <div id="fdbkoutgoing_invoice" class="label-invalidate text-danger"></div>
                                </div>

                            </div>

                            <div class="panel panel-primary setup-content" id="step-5">

                            </div>
                        </div>
                        {{-- WIZARD --}}


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="mdOrderSave" form="sectorsActionForm">Salvar</button>
            </div>
        </div>
    </div>
</div>


@endSection