@extends('system.master.layout')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Olá {{$username}}</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Página em branco</li>
                </ol>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 card-group">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Status dos pedidos</h4>
                    <table class="table table-sm table-borderless table-striped w-100 table-responsive-sm text-nowrap">
                        <thead>
                            <tr class="font-weight-bold">
                                <th>Setor</th>
                                <th class="text-right">Pedidos</th>
                                <th class="text-right">Peças</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Percentual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productionMonth['sectors'] as $item)
                            <tr>
                                <td class="">{{ $item['name'] }}</td>
                                <td class="text-right">{{ $item['orders'] }}</td>
                                <td class="text-right">{{ $item['qty'] }}</td>
                                <td class="text-right">R$ {{ number_format($item['total'],2,',','.') }}</td>
                                <td class="text-right">{{ number_format($item['total_all']*100,1,',','.') }}%</td>
                            </tr>
                            @endforeach
                            <tr class="font-weight-light">
                                <td class="">Total</td>
                                <td class="text-right">
                                    {{ array_sum(array_column($productionMonth['sectors'], 'orders')) }}</td>
                                <td class="text-right">{{ array_sum(array_column($productionMonth['sectors'], 'qty')) }}
                                </td>
                                <td class="text-right">R$
                                    {{ number_format(array_sum(array_column($productionMonth['sectors'], 'total')),2,',','.') }}
                                </td>
                                <td class="text-right"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Histórico do dia</h4>
                    <canvas id="chartHistoryDay" height="155" style="max-height: 265px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card" style="height: 120px">
                <div
                    class="card-body text-nowrap {{ $indicatorsFinance['balance'] > 0 ? 'bg-success text-white' : ($indicatorsFinance['balance'] == 0 ? 'bg-white' : 'bg-danger text-white') }}">
                    <h3 class="text-center">Saldo Financeiro</h3>
                    <h2 class="text-center mt-3">{{ $indicatorsFinance['balance'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card" style="height: 120px">
                <div class="card-body text-nowrap bg-white">
                    <h5 class="text-center">Em atraso<br>a pagar</h5>
                    <h3 class="text-center mt-3">R$ {{ $indicatorsFinance['dueReceipt'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card" style="height: 120px">
                <div class="card-body text-nowrap bg-white">
                    <h5 class="text-center">Em atraso<br>a receber</h5>
                    <h3 class="text-center mt-3">R$ {{ $indicatorsFinance['duePayment'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card" style="height: 120px">
                <div class="card-body bg-white text-nowrap">
                    <h5 class="text-center">Pedidos finalizados<br>hoje</h5>
                    <h2 class="text-center mt-3">{{ $productionMonth['indicators']->finished_today }}</h2>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card" style="height: 120px">
                <div class="card-body bg-white text-nowrap">
                    <h5 class="text-center">pedidos abertos<br>hoje</h5>
                    <h2 class="text-center mt-3">{{ $productionMonth['indicators']->opened_today }}</h2>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/views/home/home.js') }}"></script>
<script src="{{ asset('assets/chartjs/chart.js') }}"></script>
@endSection