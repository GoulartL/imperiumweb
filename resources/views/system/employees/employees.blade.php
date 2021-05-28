@extends('system.master.layout')

@section('styles')
<link href="{{ asset('assets/datatables/datatables.css') }}" rel="stylesheet">
@endSection

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Funcionários</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Funcionários</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped w-100" id="tbEmployees">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="1">Nome</th>
                                <th data-priority="8">CPF</th>
                                <th data-priority="2">Cargo</th>
                                <th data-priority="2">Setor</th>
                                <th data-priority="6">Estado Civil</th>
                                <th data-priority="3">Sexo</th>
                                <th data-priority="8">RG</th>
                                <th data-priority="4">Telefone 1</th>
                                <th data-priority="5">Telefone 2</th>
                                <th data-priority="7">Data de admissão</th>
                                <th data-priority="7">Data de Afast.</th>
                                <th data-priority="7">Data de Demissão</th>
                                <th data-priority="9">Observações</th>
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
<script src="{{ asset('assets/views/employees/employees.js') }}"></script>
@endSection

@section('components')

<!-- Modal -->
<div class="modal fade" id="mdCrud" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="mdCrudTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdCrudTitle">Novo funcionário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdCrudBody">
                <form id="employeeForm" action="POST" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" id="mdInputID" autocomplete="off" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputName">Nome completo</label>
                            <input type="text" class="form-control nextEnter" id="mdInputName" autocomplete="off"
                                name="name">
                            <div id="fdbkname" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputPersonalId">RG</label>
                            <input type="text" class="form-control nextEnter" id="mdInputPersonalId" autocomplete="off"
                                name="personalid">
                            <div id="fdbkpersonalid" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputVat">CPF</label>
                            <input type="text" class="form-control nextEnter" id="mdInputVat" autocomplete="off"
                                name="vat">
                            <div id="fdbkvat" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputPosition" id="mdLblName">Cargo</label>
                            <input type="text" class="form-control nextEnter" id="mdInputPosition" autocomplete="off"
                                name="position">
                            <div id="fdbkposition" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputSector">Setor</label>
                            <input type="text" class="form-control nextEnter" id="mdInputSector" autocomplete="off"
                                name="sector">
                            <div id="fdbksector" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputCivilState">Estado civil</label>
                            <select class="custom-select nextEnter" id="mdInputCivilState" name="civilstate">
                                <option value="">Escolha uma opção</option>
                                <option value="1">Casado(a)</option>
                                <option value="2">Solteiro(a)</option>
                            </select>
                            <div id="fdbkcivilstate" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputSex">Sexo</label>
                            <select class="custom-select nextEnter" id="mdInputSex" name="sex">
                                <option value="">Escolha uma opção</option>
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>
                            </select>
                            <div id="fdbksex" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Contatos</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputTel1">Telefone 1</label>
                            <input type="text" class="form-control nextEnter" id="mdInputTel1" autocomplete="off"
                                name="tel1">
                            <div id="fdbktel1" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputTel2">Telefone 2</label>
                            <input type="text" class="form-control nextEnter" id="mdInputTel2" autocomplete="off"
                                name="tel2">
                            <div id="fdbktel2" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Datas</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputAdmissionDate">Data de Admissão</label>
                            <input type="text" class="form-control nextEnter" id="mdInputAdmissionDate" autocomplete="off"
                                name="admissiondate">
                            <div id="fdbkadmissiondate" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputRemovalDate">Data de Afastamento</label>
                            <input type="text" class="form-control nextEnter" id="mdInputRemovalDate" autocomplete="off"
                                name="removaldate">
                            <div id="fdbkremovaldate" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputResignationDate">Data de Demissão</label>
                            <input type="text" class="form-control nextEnter" id="mdInputResignationDate" autocomplete="off"
                                name="resignationdate">
                            <div id="fdbkresignationdate" class="label-invalidate text-danger"></div>
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
                                autocomplete="off" name="observations" rows="5"></textarea>
                            <div id="fdbkobservations" class="label-invalidate text-danger"></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="mdCrudSave" form="employeeForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

@endSection