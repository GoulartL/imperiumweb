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
            <h3 class="text-themecolor">Diário de produção</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Diário de produção</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped w-100" id="tbProductionDiary">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Data</th>
                                <th data-priority="3">N° Colaboradores</th>
                                <th data-priority="2">Pedido</th>
                                <th data-priority="3">Cliente</th>
                                <th data-priority="3">Ref.</th>
                                <th data-priority="3">Modelo</th>
                                <th data-priority="6">Coleção</th>
                                <th data-priority="4">Qtd.</th>
                                <th data-priority="4">Qtd. produzida</th>
                                <th data-priority="5">Valor Unit.</th>
                                <th data-priority="5">Total</th>
                                <th data-priority="6">Tempo (min/unid)</th>
                                <th data-priority="6">Tempo (total)</th>
                                <th data-priority="8">Observações</th>
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
<script src="{{ asset('assets/views/production/production-diary/production_diary.js') }}"></script>
@endSection

@section('components')

<!-- Modal -->
<div class="modal fade" id="mdCrud" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="mdCrudTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="mdCrudTitle">Novo apontamento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdCrud">
                <form id="productionDiaryForm" action="POST" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" id="mdInputID" autocomplete="off" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputDate">Data</label>
                            <input type="text" class="form-control nextEnter input-date" id="mdInputDate"
                                autocomplete="off" name="date">
                            <div id="fdbkdate" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputEmployees">N° Colaboradores</label>
                            <input type="number" class="form-control nextEnter" id="mdInputEmployees" autocomplete="off"
                                name="employees">
                            <div id="fdbkemployees" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputOrders">Pedido</label>
                            <select class="custom-select nextEnter select-server-side" data-values='pedidos'
                                id="mdInputOrders" name="order">
                            </select>
                            <div id="fdbkorder" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Detalhes do pedido</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInpuCustomer">Cliente</label>
                            <input type="text" class="form-control" id="mdInpuCustomer" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputRef">Referência</label>
                            <input type="text" class="form-control" id="mdInputRef" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputModel">Modelo</label>
                            <input type="text" class="form-control" id="mdInputModel" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputCollection">Coleção</label>
                            <input type="text" class="form-control" id="mdInputCollection" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputQtyOrder">Quantidade</label>
                            <input type="number" class="form-control" id="mdInputQtyOrder" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputPriceOrder">Valor Unitário</label>
                            <input type="number" class="form-control" id="mdInputPriceOrder" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputTotalOrder">Total</label>
                            <input type="number" class="form-control" id="mdInputTotalOrder" readonly>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Produção</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputQtyProduced">Qtd. Produzida</label>
                            <input type="number" class="form-control nextEnter" id="mdInputQtyProduced"
                                autocomplete="off" name="qty" step="0.01">
                            <div id="fdbkqty" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputTotalProduced">Total</label>
                            <input type="number" class="form-control nextEnter" id="mdInputTotalProduced" readonly
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
                <button type="submit" class="btn btn-primary" id="mdCrudSave" form="productionDiaryForm">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endSection