@extends('system.master.layout')

@section('styles')
<link href="{{ asset('assets/datatables/datatables.css') }}" rel="stylesheet">
@endSection

@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Clientes</h3>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Início</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped w-100" id="tbCustomers">
                        <thead>
                            <tr>
                                <th data-priority="0">#</th>
                                <th data-priority="4">Tipo</th>
                                <th data-priority="8">CPF/CNPJ</th>
                                <th data-priority="9">IE/RG</th>
                                <th data-priority="0">Nome</th>
                                <th data-priority="7">Apelido/Nome Fantasia</th>
                                <th data-priority="9">End.</th>
                                <th data-priority="9">N°</th>
                                <th data-priority="3">Bairro</th>
                                <th data-priority="2">Cidade</th>
                                <th data-priority="1">Estado</th>
                                <th data-priority="9">Complemento</th>
                                <th data-priority="9">CEP</th>
                                <th data-priority="5">Contato</th>
                                <th data-priority="5">Telefone 1</th>
                                <th data-priority="5">Telefone 2</th>
                                <th data-priority="6">E-mail 1</th>
                                <th data-priority="6">E-mail 2</th>
                                <th data-priority="9">Banco</th>
                                <th data-priority="9">AG</th>
                                <th data-priority="9">CC</th>
                                <th data-priority="9">Favorecido</th>
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
<script src="{{ asset('assets/views/customers/customers.js') }}"></script>
@endSection

@section('components')

<!-- Modal -->
<div class="modal fade" id="mdCrud" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="mdCrudTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdCrudTitle">Novo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mdCrudBody">
                <form id="customerForm" action="POST" autocomplete="off">
                    @csrf
                    <input type="text" class="form-control" id="mdInputID" autocomplete="off" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mdInputType">Tipo</label>
                            <select class="custom-select nextEnter" id="mdInputType" name="type">
                                <option value="CNPJ">CNPJ</option>
                                <option value="CPF">CPF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputName" id="mdLblName">Razão Social</label>
                            <input type="text" class="form-control nextEnter" id="mdInputName" autocomplete="off"
                                name="name">
                            <div id="fdbkname" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputTaxVat" id="mdLblTaxVat">CNPJ</label>
                            <input type="text" class="form-control nextEnter" id="mdInputTaxVat" autocomplete="off"
                                name="taxvat">
                            <div id="fdbktaxvat" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputShortName" id="mdLblShortName">Nome Fantasia</label>
                            <input type="text" class="form-control nextEnter" id="mdInputShortName" autocomplete="off"
                                name="shortname">
                            <div id="fdbkshortname" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputIdRegister" id="mdLblIdRegister">IE</label>
                            <input type="text" class="form-control nextEnter" id="mdInputIdRegister" autocomplete="off"
                                name="idregister">
                            <div id="fdbkidregister" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Endereço</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="mdInputAddress">Rua</label>
                            <input type="text" class="form-control nextEnter" id="mdInputAddress" autocomplete="off"
                                name="address">
                            <div id="fdbkaddress" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="mdInputNumber">Número</label>
                            <input type="number" class="form-control nextEnter" id="mdInputNumber" autocomplete="off"
                                name="number">
                            <div id="fdbknumber" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputDistrict">Bairro</label>
                            <input type="text" class="form-control nextEnter" id="mdInputDistrict" autocomplete="off"
                                name="district">
                            <div id="fdbkdistrict" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputCity">Cidade</label>
                            <input type="text" class="form-control nextEnter" id="mdInputCity" autocomplete="off"
                                name="city">
                            <div id="fdbkcity" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputState">Estado</label>
                            <select class="custom-select nextEnter" id="mdInputState" name="state">
                                <option value="">Selecione um estado</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                            <div id="fdbkstate" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="mdInputComplement">Complemento</label>
                            <input type="text" class="form-control nextEnter" id="mdInputComplement" autocomplete="off"
                                name="complement">
                            <div id="fdbkcomplement" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mdInputZipcode">CEP</label>
                            <input type="number" class="form-control nextEnter" id="mdInputZipcode" autocomplete="off"
                                name="zipcode">
                            <div id="fdbkzipcode" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Contatos</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="mdInputContactName">Nome para contato</label>
                            <input type="text" class="form-control nextEnter" id="mdInputContactName" autocomplete="off"
                                name="contactname">
                            <div id="fdbkcontactname" class="label-invalidate text-danger"></div>
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
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputEmail1">E-mail 1</label>
                            <input type="text" class="form-control nextEnter" id="mdInputEmail1" autocomplete="off"
                                name="email1">
                            <div id="fdbkemail1" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputEmail2">Email 2</label>
                            <input type="text" class="form-control nextEnter" id="mdInputEmail2" autocomplete="off"
                                name="email2">
                            <div id="fdbkemail2" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <h5 class="mb-0 ml-0 py-2">Financeiro</h5>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="mdInputBank">Banco</label>
                            <input type="text" class="form-control nextEnter" id="mdInputBank" autocomplete="off"
                                name="bank">
                            <div id="fdbkbank" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="mdInputAccountName">Nome da conta</label>
                            <input type="text" class="form-control nextEnter" id="mdInputAccountName" autocomplete="off"
                                name="accountname">
                            <div id="fdbkaccountname" class="label-invalidate text-danger"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mdInputAccountNumber">Número da conta</label>
                            <input type="text" class="form-control nextEnter" id="mdInputAccountNumber"
                                autocomplete="off" name="accountnumber">
                            <div id="fdbkaccountnumber" class="label-invalidate text-danger"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mdInputAgency">Agência</label>
                            <input type="text" class="form-control nextEnter" id="mdInputAgency" autocomplete="off"
                                name="agency">
                            <div id="fdbkagency" class="label-invalidate text-danger"></div>
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
                <button type="submit" class="btn btn-primary" id="mdCrudSave" form="customerForm">Salvar</button>
            </div>
        </div>
    </div>
</div>

@endSection