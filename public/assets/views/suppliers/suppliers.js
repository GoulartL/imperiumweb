/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/system/suppliers/suppliers.js":
/*!*******************************************************!*\
  !*** ./resources/views/system/suppliers/suppliers.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var table = $('#tbSuppliers').DataTable({
    language: traducao,
    processing: true,
    serverSide: true,
    ajax: "/api/fornecedores",
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'type',
      name: 'type'
    }, {
      data: 'taxvat',
      name: 'taxvat'
    }, {
      data: 'state_register_id',
      name: 'state_register_id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'fantasy_name',
      name: 'fantasy_name'
    }, {
      data: 'address',
      name: 'address'
    }, {
      data: 'number',
      name: 'number'
    }, {
      data: 'district',
      name: 'district'
    }, {
      data: 'city',
      name: 'city'
    }, {
      data: 'state',
      name: 'state'
    }, {
      data: 'complement',
      name: 'complement'
    }, {
      data: 'zip_code',
      name: 'zip_code'
    }, {
      data: 'contact_name',
      name: 'contact_name'
    }, {
      data: 'phone_number_1',
      name: 'phone_number_1'
    }, {
      data: 'phone_number_2',
      name: 'phone_number_2'
    }, {
      data: 'email_1',
      name: 'email_1'
    }, {
      data: 'email_2',
      name: 'email_2'
    }, {
      data: 'bank',
      name: 'bank'
    }, {
      data: 'agency',
      name: 'agency'
    }, {
      data: 'account',
      name: 'account'
    }, {
      data: 'account_name',
      name: 'account_name'
    }, {
      data: 'observation',
      name: 'observation'
    }, {
      data: null,
      className: 'text-nowrap',
      render: function render(data, type, row) {
        return "<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button>" + "<button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>";
      }
    }],
    columnDefs: [{
      className: "text-nowrap-pc",
      targets: "_all"
    }, {
      orderable: false,
      targets: [23]
    }],
    dom: "<'row'<'col-sm-12 col-md-6 toolbar text-center text-sm-left'><'col-sm-12 col-md-6 search-datatables'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    responsive: {
      details: {
        renderer: function renderer(api, rowIdx, columns) {
          var data = $.map(columns, function (col, i) {
            return col.hidden ? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' + '<td class="font-weight-bold">' + col.title + ':' + '</td> ' + '<td>' + col.data + '</td>' + '</tr>' : '';
          }).join('');
          return data ? $('<table class="w-100 p-0 table-sm"/>').append(data) : false;
        }
      }
    }
  }); //Top button of the table

  $("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddSupplier'><i class='fas fa-plus mr-2'></i>Novo Cadastro</button>");
  $('#mdInputType').on('change', '', function (e) {
    if ($(this).val() == "CNPJ") {
      $('#mdLblTaxVat').html('CNPJ');
      $('#mdLblName').html('Razão Social');
      $('#mdLblShortName').html('Nome Fantasia');
      $('#mdLblIdRegister').html('IE');
    } else if ($(this).val() == "CPF") {
      $('#mdLblTaxVat').html('CPF');
      $('#mdLblName').html('Nome');
      $('#mdLblShortName').html('Apelido');
      $('#mdLblIdRegister').html('RG');
    }
  });
  $('#mdAddSupplier').on('click', function () {
    $("form#supplierForm :input").each(function () {
      $(this).val('');
    });
    $('#mdInputType').val('CNPJ');
    $('#mdLblTaxVat').html('CNPJ');
    $('#mdLblName').html('Razão Social');
    $('#mdLblShortName').html('Nome Fantasia');
    $('#mdLblIdRegister').html('IE');
  });
  $('#tbSuppliers tbody').on('click', '.edit', function () {
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
  $('#tbSuppliers tbody').on('click', '.remove', function () {
    var data = table.row($(this).parents('tr')).data();
    customConfirm('Confirmar ação?', 'Você está prestes a excluir o registro [' + data['name'] + ']', function () {
      $.ajax({
        type: "DELETE",
        url: "/api/fornecedores/remover/" + data['id']
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        table.ajax.reload();
      });
    });
  });
  $('#supplierForm').on('submit', function (e) {
    e.preventDefault();

    if ($('#mdInputID').val() == '') {
      $.ajax({
        type: "POST",
        url: "/api/fornecedores/guardar",
        data: $(this).serializeArray()
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        clearAllInputsValidations('supplierForm');

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
        url: "/api/fornecedores/editar/" + $('#mdInputID').val(),
        data: $(this).serializeArray()
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        clearAllInputsValidations('supplierForm');

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
  $('#mdCrud').on('hidden.bs.modal', function (event) {
    clearAllInputsValues('supplierForm');
  });
});

/***/ }),

/***/ 3:
/*!*************************************************************!*\
  !*** multi ./resources/views/system/suppliers/suppliers.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\users\Alisson\Documents\faculdade\tcc\imperiumweb\resources\views\system\suppliers\suppliers.js */"./resources/views/system/suppliers/suppliers.js");


/***/ })

/******/ });