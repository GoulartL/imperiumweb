!function(e){var t={};function a(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,r){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(r,o,function(t){return e[t]}.bind(null,o));return r},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=155)}({155:function(e,t,a){e.exports=a(156)},156:function(e,t){$(document).ready((function(){var e=$("#tbProductionDiary").DataTable({language:traducao,processing:!0,serverSide:!0,ajax:"/api/diario_de_producao",columns:[{data:"id",name:"id",className:"text-right"},{data:"date",name:"date"},{data:"employees",name:"employees",className:"text-right"},{data:"order",name:"order"},{data:"customer_name",name:"customer_name"},{data:"ref",name:"ref"},{data:"model",name:"model"},{data:"collection",name:"collection"},{data:"qty_order",name:"qty_order",render:$.fn.dataTable.render.number(".",",",0,""),className:"text-right"},{data:"qty",name:"qty",render:$.fn.dataTable.render.number(".",",",0,""),className:"text-right"},{data:"price_order",name:"price_order",render:$.fn.dataTable.render.number(".",",",2,"R$"),className:"text-right"},{data:"total",name:"total",render:$.fn.dataTable.render.number(".",",",2,"R$"),className:"text-right"},{data:null,className:"text-right",render:function(e,t,a){return(e.price_order/.45).toFixed(0)}},{data:null,className:"text-right",render:function(e,t,a){return(e.qty*(e.price_order/.45)).toFixed(0)}},{data:"observation",name:"observation"},{data:null,className:"text-nowrap",render:function(e,t,a){return"<button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button><button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>"}}],columnDefs:[{orderable:!1,targets:[15]},{targets:[1],render:$.fn.dataTable.render.moment("DD/MM/YYYY")},{className:"text-nowrap-pc",targets:"_all"}],dom:"<'row'<'col-sm-12 col-md-6 toolbar text-center text-sm-left'><'col-sm-12 col-md-6 search-datatables'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",responsive:{details:{renderer:function(e,t,a){var r=$.map(a,(function(e,t){return e.hidden?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td class="font-weight-bold">'+e.title+":</td> <td>"+e.data+"</td></tr>":""})).join("");return!!r&&$('<table class="w-100 p-0 table-sm"/>').append(r)}}}});$("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddRow'><i class='fas fa-plus mr-2'></i>Novo Apontamento</button>"),$("#mdAddRow").on("click",(function(){$("form#productionDiaryForm :input").each((function(){$(this).val("").trigger("change")}))})),$("#mdInputOrders").on("change",(function(e){$("#mdInputTotalProduced").val($("#mdInputQtyProduced").val()*$("#mdInputPriceOrder").val())})),$("#mdInputQtyProduced").on("keyup",(function(e){$("#mdInputTotalProduced").val($("#mdInputQtyProduced").val()*$("#mdInputPriceOrder").val())})),$("#mdInputOrders").on("change",(function(e){""!=$(this).select2("data")&&$.ajax({type:"GET",url:"/api/pedidos/"+$(this).val()}).done((function(e){void 0!==e&&(row=e.data[0],$("#mdInpuCustomer").val(row.customer_name),$("#mdInputRef").val(row.ref),$("#mdInputModel").val(row.model),$("#mdInputCollection").val(row.collection),$("#mdInputQtyOrder").val(row.qty),$("#mdInputPriceOrder").val(row.price),$("#mdInputTotalOrder").val(row.total))}))})),$("#tbProductionDiary tbody").on("click",".edit",(function(){var t=e.row($(this).parents("tr")).data();$("#mdCrudTitle").html("Editar apontamento"),$("#mdInputID").val(t.id),$("#mdInputDate").datepicker("update",moment(t.date).format("DD/MM/YYYY")),$("#mdInputEmployees").val(t.employees),$("#mdInputOrders").append(new Option(t.order,t.id,!0,!0)).trigger("change"),$("#mdInpuCustomer").val(t.customer),$("#mdInputRef").val(t.ref),$("#mdInputModel").val(t.model),$("#mdInputCollection").val(t.collection),$("#mdInputQtyOrder").val(t.qty_order),$("#mdInputPriceOrder").val(t.price_order.toFixed(2)),$("#mdInputTotalOrder").val((t.qty_order*t.price_order).toFixed(2)),$("#mdInputQtyProduced").val(t.qty),$("#mdInputTotalProduced").val(t.total),$("#mdInputObservations").val(t.observation),$("#mdCrud").modal("show")})),$("#tbProductionDiary tbody").on("click",".remove",(function(){var t=e.row($(this).parents("tr")).data();customConfirm("Confirmar ação?","Você está prestes a excluir o apontamento ["+t.id+"]",(function(){$.ajax({type:"DELETE",url:"/api/diario_de_producao/remover/"+t.id}).done((function(t){response=JSON.parse(t),toastAlert(response.status,response.message),e.ajax.reload()}))}))})),$("#productionDiaryForm").on("submit",(function(t){return t.preventDefault(),""==$("#mdInputID").val()?$.ajax({type:"POST",url:"/api/diario_de_producao/guardar",data:$(this).serializeArray()}).done((function(t){if(response=JSON.parse(t),toastAlert(response.status,response.message),clearAllInputsValidations("productionDiaryForm"),"success"==response.status)e.ajax.reload(),$("#mdCrud").modal("hide");else for(var a in response.data)invalidateInput(a,response.data[a][0])})):$.ajax({type:"PUT",url:"/api/diario_de_producao/editar/"+$("#mdInputID").val(),data:$(this).serializeArray()}).done((function(t){if(response=JSON.parse(t),toastAlert(response.status,response.message),clearAllInputsValidations("productionDiaryForm"),"success"==response.status)e.ajax.reload(),$("#mdCrud").modal("hide");else for(var a in response.data)invalidateInput(a,response.data[a][0])})),!1})),$("#mdCrud").on("hidden.bs.modal",(function(e){clearAllInputsValues("productionDiaryForm")})),$(".select-server-side").each((function(e){$(this).select2({ajax:{delay:250,theme:"bootstrap",url:"/api/"+$(this).attr("data-values")+"/select",dataType:"json",data:function(e){return{search:e.term,page:e.page||1}}}})}))}))}});