@extends('system.master.layout')

@section('styles')
<link href="{{ asset('assets/datatables/datatables.css') }}" rel="stylesheet">
@endSection

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Fluxo de caixa</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Fluxo de caixa</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row card-group">
        <div class="col-12 col-md-4">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card" style="height: 120px">
                        <div
                            class="card-body text-nowrap {{ $balance > 0 ? 'bg-success text-white' : ($balance == 0 ? 'bg-white' : 'bg-danger text-white') }}">
                            <h3 class="text-center">Saldo Financeiro</h3>
                            <h2 class="text-center mt-3">R$ {{ $balance }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                    <div class="card" style="height: 120px">
                        <div class="card-body text-nowrap bg-white">
                            <h5 class="text-center">Em atraso<br>a pagar</h5>
                            <h3 class="text-center mt-3">R$ {{ $dueReceipt }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="height: 120px">
                        <div class="card-body text-nowrap bg-white">
                            <h5 class="text-center">Em atraso<br>a receber</h5>
                            <h3 class="text-center mt-3">R$ {{ $duePayment }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Histórico do mês</h4>
                    <canvas id="chartHistoryMonth" height="155"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Histórico do dia</h4>
                    <canvas id="chartHistoryDay" height="155"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-0">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Para pagar hoje</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped w-100 table-sm table-borderless" id="tbPayments">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="0">Fornecedor</th>
                                <th data-priority="0">Desc.</th>
                                <th data-priority="0">Valor</th>
                                <th data-priority="0">Parcela</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">Para receber hoje</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped w-100 table-sm table-borderless" id="tbReceipts">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="0">Cliente</th>
                                <th data-priority="0">Desc.</th>
                                <th data-priority="0">Valor</th>
                                <th data-priority="0">Parcela</th>
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
<script src="{{ asset('assets/views/financial/cash-flow/cash-flow.js') }}"></script>
<script src="{{ asset('assets/chartjs/chart.js') }}"></script>
@endSection