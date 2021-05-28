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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/views/system/employees/employees.js":
/*!*******************************************************!*\
  !*** ./resources/views/system/employees/employees.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var table = $('#tbEmployees').DataTable({
    language: traducao,
    processing: true,
    serverSide: true,
    ajax: "/api/funcionarios",
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'vat',
      name: 'vat'
    }, {
      data: 'position',
      name: 'position'
    }, {
      data: 'sector',
      name: 'sector'
    }, {
      data: 'civil_state',
      name: 'civil_state'
    }, {
      data: 'sex',
      name: 'sex'
    }, {
      data: 'personal_id',
      name: 'personal_id'
    }, {
      data: 'phone_number_1',
      name: 'phone_number_1'
    }, {
      data: 'phone_number_2',
      name: 'phone_number_2'
    }, {
      data: 'admission_date',
      name: 'admission_date'
    }, {
      data: 'removal_date',
      name: 'removal_date'
    }, {
      data: 'resignation_date',
      name: 'resignation_date'
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
      targets: [14]
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

  $("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddEmployee'><i class='fas fa-plus mr-2'></i>Novo Cadastro</button>");
  $('#mdAddEmployee').on('click', function () {
    $("form#employeeForm :input").each(function () {
      $(this).val('');
    });
    $('#mdCrudTitle').html('Novo Registro');
  });
  $('#tbEmployees tbody').on('click', '.edit', function () {
    var data = table.row($(this).parents('tr')).data();
    $('#mdCrudTitle').html('Editar Registro');
    $('#mdInputID').val(data['id']);
    $('#mdInputName').val(data['name']);
    $('#mdInputVat').val(data['vat']);
    $('#mdInputPosition').val(data['position']);
    $('#mdInputSector').val(data['sector']);
    $('#mdInputCivilState').val(data['civil_state']);
    $('#mdInputSex').val(data['sex']);
    $('#mdInputPersonalId').val(data['personal_id']);
    $('#mdInputTel1').val(data['phone_number_1']);
    $('#mdInputTel2').val(data['phone_number_2']);
    $('#mdInputAdmissionDate').val(data['admission_date']);
    $('#mdInputRemovalDate').val(data['removal_date']);
    $('#mdInputResignationDate').val(data['resignation_date']);
    $('#mdInputObservations').val(data['observation']);
    $('#mdCrud').modal('show');
  });
  $('#tbEmployees tbody').on('click', '.remove', function () {
    var data = table.row($(this).parents('tr')).data();
    customConfirm('Confirmar ação?', 'Você está prestes a excluir o registro [' + data['name'] + ']', function () {
      $.ajax({
        type: "DELETE",
        url: "/api/funcionarios/remover/" + data['id']
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        table.ajax.reload();
      });
    });
  });
  $('#employeeForm').on('submit', function (e) {
    e.preventDefault();

    if ($('#mdInputID').val() == '') {
      $.ajax({
        type: "POST",
        url: "/api/funcionarios/guardar",
        data: $(this).serializeArray()
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        clearAllInputsValidations('employeeForm');

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
        url: "/api/funcionarios/editar/" + $('#mdInputID').val(),
        data: $(this).serializeArray()
      }).done(function (responseJson) {
        response = JSON.parse(responseJson);
        toastAlert(response.status, response.message);
        clearAllInputsValidations('employeeForm');

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
    clearAllInputsValues('employeeForm');
  });
});

/***/ }),

/***/ 2:
/*!*************************************************************!*\
  !*** multi ./resources/views/system/employees/employees.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\users\Alisson\Documents\faculdade\tcc\imperiumweb\resources\views\system\employees\employees.js */"./resources/views/system/employees/employees.js");


/***/ })

/******/ });