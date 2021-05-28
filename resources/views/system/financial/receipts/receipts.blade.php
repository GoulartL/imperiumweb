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
            <h3 class="text-themecolor">Contas a receber</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Contas a receber</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped w-100" id="tbReceipts">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="5">Cliente</th>
                                <th data-priority="1">Desc.</th>
                                <th data-priority="3">Valor</th>
                                <th data-priority="2">Vencto.</th>
                                <th data-priority="4">parcela</th>
                                <th data-priority="6">Emissão</th>
                                <th data-priority="6">Dt. Receb.</th>
                                <th data-priority="6">Val. Receb.</th>
                                <th data-priority="7">Espécie</th>
                                <th data-priority="9">Observações</th>
                                <th data-priority="0">Ações</th>
                                <th></th>
                                <th></th>
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
<script src="{{ asset('assets/views/financial/receipts/receipts.js') }}"></script>
@endSection

@section('components')

<!-- Modal -->
<div class="modal fade" id="mdCrud" data-backdrop="static" data-keyboard="false" aria-labelledby="mdCrudTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="mdCrudTitle"></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdCrudBody">
                <form id="receiptsForm" action="POST" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" id="mdInputID" autocomplete="off" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputEmission">Data de Emissão</label>
                            <input type="text" class="form-control nextEnter input-date" id="mdInputEmission"
                                autocomplete="off" name="emission">
                            <div id="fdbkemission" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6" id="mdDivDueDate">
                            <label for="mdInputDueDate">Data de Vencimento</label>
                            <input type="text" class="form-control nextEnter input-date" id="mdInputDueDate"
                                autocomplete="off" name="due_date">
                            <div id="fdbkdue_date" class="label-invalidate text-danger"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputDescription">Descrição</label>
                            <input type="text" class="form-control nextEnter" id="mdInputDescription" autocomplete="off"
                                name="description">
                            <div id="fdbkdescription" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row" id="mdDivCustomer">
                        <div class="form-group col-md-12">
                            <label for="mdInputCustomers">Cliente</label>
                            <select class="custom-select nextEnter select-server-side" data-values='clientes'
                                id="mdInputCustomers" name="client">
                            </select>
                            <div id="fdbkclient" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputSpecies">Forma de pagamento</label>
                            <select class="custom-select nextEnter select-server-side" data-values='especies'
                                id="mdInputSpecies" name="species">
                            </select>
                            <div id="fdbkspecies" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row align-self-baseline" id="mdDivValue">
                        <div class="form-group col-md-12">
                            <label for="mdInputValue">Valor</label>
                            <input type="number" class="form-control nextEnter" id="mdInputValue" autocomplete="off"
                                name="value" step="0.01" min="0">
                            <div id="fdbkvalue" class="label-invalidate text-danger"></div>
                        </div>
                    </div>

                    <div id="mdPortionDiv">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h5 class="mb-0 ml-0 py-2">Parcelas</h5>
                            </div>
                        </div>
                        <div class="form-row align-self-baseline">
                            <div class="form-group col-md-4">
                                <label for="mdInputTotal">Total</label>
                                <input type="number" class="form-control nextEnter" id="mdInputTotal" autocomplete="off"
                                    name="total" step="0.01" min="0">
                                <div id="fdbktotal" class="label-invalidate text-danger"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="mdInputPortions">Parcelas</label>
                                <input type="number" class="form-control nextEnter" id="mdInputPortions"
                                    autocomplete="off" name="portion" step="1" min="0">
                                <div id="fdbkportion" class="label-invalidate text-danger"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mdInputFirstDueDate">1° Vencimento</label>
                                <input type="text" class="form-control nextEnter input-date" id="mdInputFirstDueDate"
                                    autocomplete="off" name="firstduedate">
                                <div id="fdbkfirstduedate" class="label-invalidate text-danger"></div>
                            </div>
                            <div class="form-group col-md-3 align-self-end">
                                <button class="btn btn-primary text-nowrap py-2 w-100" id="mdAddPortions">Incluir
                                    Parcelas</button>
                            </div>
                        </div>
                        <div class="form-group col-md-12 m-0 p-0">
                            <table class="table table-sm table-bordered table-striped w-100" id="tbPortions">
                                <thead>
                                    <tr>
                                        <th data-priority="0">Parcela</th>
                                        <th data-priority="0">Valor</th>
                                        <th data-priority="0">Vencimento</th>
                                        <th data-priority="0">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="mdCrudSave" form="receiptsForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdReceipt" data-backdrop="static" data-keyboard="false" aria-labelledby="mdReceiptTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title text-center" id="mdReceiptTitle"></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdReceiptBody">
                <form id="receiptActionForm" action="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="table-responsive rounded">
                                <table class="table table-sm table-bordered rounded table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="px-2">ID</td>
                                            <td class="px-2 text-right" id="mdRecID"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Cliente</td>
                                            <td class="px-2 text-right" id="mdRecCustomer"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Descrição</td>
                                            <td class="px-2 text-right" id="mdRecDescription"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Vencimento</td>
                                            <td class="px-2 text-right" id="mdRecDueDate"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Parcela</td>
                                            <td class="px-2 text-right" id="mdRecPortion"></td>
                                        </tr>
                                        <tr>
                                            <td class="px-2">Valor</td>
                                            <td class="px-2 text-right" id="mdRecValue"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" class="form-control" id="mdReceiptID" autocomplete="off" hidden name='receive'>
                            <div class="form-group col-12">
                                <label for="mdRecInputReceiptDate">Data Recebimento</label>
                                <input type="text" class="form-control nextEnter input-date" id="mdRecInputReceiptDate"
                                    autocomplete="off" name="receipt_date">
                                <div id="fdbkreceipt_date" class="label-invalidate text-danger"></div>
                            </div>
                            <div class="form-group col-12">
                                <label for="mdRecInputReceiptValue">Valor Recebimento</label>
                                <input type="number" class="form-control nextEnter" id="mdRecInputReceiptValue"
                                    autocomplete="off" name="receipt_value" step="0.01">
                                <div id="fdbkreceipt_value" class="label-invalidate text-danger"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="mdReceiptSave"
                    form="receiptActionForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

@endSection