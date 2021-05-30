@extends('system.master.layout')

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard Produção</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Dashboard Produção</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script src="{{ asset('assets/views/production/dashboard/dashboard.js') }}"></script>
@endSection
