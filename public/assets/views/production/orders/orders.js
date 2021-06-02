!function(e){var t={};function a(r){if(t[r])return t[r].exports;var n=t[r]={i:r,l:!1,exports:{}};return e[r].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=t,a.d=function(e,t,r){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(a.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)a.d(r,n,function(t){return e[t]}.bind(null,n));return r},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=153)}({153:function(e,t,a){e.exports=a(154)},154:function(e,t){$(document).ready((function(){var e=$("#tbOrders").DataTable({language:traducao,processing:!0,serverSide:!0,ajax:"/api/pedidos",columns:[{data:"id",name:"id"},{data:"code",name:"code"},{data:"customer_name",name:"customer_name"},{data:null,render:function(e,t,a){return null!=e.cancellation_date||null!=e.cancellation_reason?(status="danger",setor="Cancelado"):1==e.sector?(status="light",setor="PCP"):2==e.sector?(status="dark",setor="Costura"):3==e.sector?(status="info",setor="Acabamento"):4==e.sector?(status="primary",setor="Expedição"):(status="success",setor="Finalizado"),"<span class='badge badge-"+status+"'>"+setor+"</span>"}},{data:"entry_date",name:"entry_date"},{data:"incoming_invoice",name:"incoming_invoice"},{data:"ref",name:"ref"},{data:"model",name:"model"},{data:"collection",name:"collection"},{data:"qty",name:"qty",render:$.fn.dataTable.render.number(".",",",0,"")},{data:"price",name:"price",render:$.fn.dataTable.render.number(".",",",2,"R$")},{data:"total",name:"total",render:$.fn.dataTable.render.number(".",",",2,"R$")},{data:null,render:function(e,t,a){return(e.price/.45).toFixed(0)}},{data:null,render:function(e,t,a){return(e.qty*(e.price/.45)).toFixed(0)}},{data:"observation",name:"observation"},{data:null,className:"text-nowrap",render:function(e,t,a){return"<button class='btn btn-primary btn-sm mx-1 action'><i class='fas fa-tasks action-table'></i></button><button class='btn btn-primary btn-sm mx-1 edit'><i class='fas fa-edit action-table'></i></button><button class='btn btn-primary btn-sm mx-1 remove'><i class='fas fa-trash action-table'></i></button>"}}],columnDefs:[{orderable:!1,targets:[13]},{targets:[4],render:$.fn.dataTable.render.moment("DD/MM/YYYY")},{className:"text-nowrap-pc",targets:"_all"}],dom:"<'row'<'col-sm-12 col-md-6 toolbar text-center text-sm-left'><'col-sm-12 col-md-6 search-datatables'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",responsive:{details:{renderer:function(e,t,a){var r=$.map(a,(function(e,t){return e.hidden?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td class="font-weight-bold">'+e.title+":</td> <td>"+e.data+"</td></tr>":""})).join("");return!!r&&$('<table class="w-100 p-0 table-sm"/>').append(r)}}}});$("div.toolbar").html("<button class='btn waves-effect waves-light btn-primary mb-2' data-toggle='modal' data-target='#mdCrud' id='mdAddOrder'><i class='fas fa-plus mr-2'></i>Novo Pedido</button>"),$("#mdAddOrder").on("click",(function(){$("form#orderForm :input").each((function(){$(this).val("").trigger("change")}))})),$("#mdInputQty, #mdInputPrice").on("change",(function(e){$("#mdInputTotal").val($("#mdInputQty").val()*$("#mdInputPrice").val())})),$("#tbOrders tbody").on("click",".edit",(function(){var t=e.row($(this).parents("tr")).data();$("#mdCrudTitle").html("Editar pedido"),$("#mdInputID").val(t.id),$("#mdInputCode").val(t.code),$("#mdInputEntryDate").datepicker("update",moment(t.entry_date).format("DD/MM/YYYY")),$("#mdInputCustomers").append(new Option(t.customer_name,t.customer,!0,!0)).trigger("change"),$("#mdInputIncomingInvoice").val(t.incoming_invoice),$("#mdInputRef").val(t.ref),$("#mdInputModel").val(t.model),$("#mdInputCollection").val(t.collection),$("#mdInputQty").val(t.qty),$("#mdInputPrice").val(t.price.toFixed(2)),$("#mdInputTotal").val((t.qty*t.price).toFixed(2)),$("#mdInputObservations").val(t.observation),$("#mdCrud").modal("show")})),$("#tbOrders tbody").on("click",".remove",(function(){var t=e.row($(this).parents("tr")).data();customConfirm("Confirmar ação?","Você está prestes a excluir o pedido ["+t.code+"]",(function(){$.ajax({type:"DELETE",url:"/api/pedidos/remover/"+t.id}).done((function(t){response=JSON.parse(t),toastAlert(response.status,response.message),e.ajax.reload()}))}))})),$("#tbOrders tbody").on("click",".action",(function(){var t=e.row($(this).parents("tr")).data();$("#mdSectorsTitle").html("Andamento"),$("#mdInputID").val(""),$("#mdOrderID").html(t.id),$("#mdOrderInputID").val(t.id),$("#mdOrderSector").val(t.sector),$("#mdOrderCode").html(t.code),$("#mdOrderCustomer").html(t.customer+" - "+t.customer_name),$("#mdOrderEntryDate").html(moment(t.entry_date).format("DD/MM/YYYY")),$("#mdOrderRef").html(t.ref),$("#mdOrderModel").html(t.model),$("#mdOrderCollection").html(t.collection),$("#mdOrderQty").html(t.qty),null!=t.delivery_date_sewing&&$("#mdOrderInputDeliveryDateSewing").datepicker("update",moment(t.delivery_date_sewing).format("DD/MM/YYYY")),null!=t.expected_date_sewing&&$("#mdOrderInputExpectedDateSewing").datepicker("update",moment(t.expected_date_sewing).format("DD/MM/YYYY")),null!=t.departure_date_sewing&&$("#mdOrderInputDepartureDateSewing").datepicker("update",moment(t.departure_date_sewing).format("DD/MM/YYYY")),null!=t.delivery_date_finishing&&$("#mdOrderInputDeliveryDateFinishing").datepicker("update",moment(t.delivery_date_finishing).format("DD/MM/YYYY")),null!=t.expected_date_finishing&&$("#mdOrderInputExpectedDateFinishing").datepicker("update",moment(t.expected_date_finishing).format("DD/MM/YYYY")),null!=t.departure_date_finishing&&$("#mdOrderInputDepartureDateFinishing").datepicker("update",moment(t.departure_date_finishing).format("DD/MM/YYYY")),null!=t.entry_date_expedition&&$("#mdOrderInputEntryDateExpedition").datepicker("update",moment(t.entry_date_expedition).format("DD/MM/YYYY")),null!=t.expected_date_expedition&&$("#mdOrderInputExpectedDateExpedition").datepicker("update",moment(t.expected_date_expedition).format("DD/MM/YYYY")),null!=t.departure_date_expedition&&$("#mdOrderInputDepartureDateExpedition").datepicker("update",moment(t.departure_date_expedition).format("DD/MM/YYYY")),$("#mdOrderInputOutgoingInvoice").val(t.outgoing_invoice),$("div.setup-panel div a").addClass("btn-secondary text-dark"),$("#sector"+t.sector).removeClass("btn-secondary text-dark").addClass("btn-primary text-white"),$(".setup-content").hide(),$($("#sector"+t.sector).attr("href")).show(),null!=t.cancellation_date||null!=t.cancellation_reason?($("#mdOrderInputCancellationDate").datepicker("update",moment(t.cancellation_date).format("DD/MM/YYYY")),$("#mdOrderInputCancellationReason").val(t.cancellation_reason),$("#divCancel").addClass("bg-danger text-white"),$("#divCancel").html("CANCELADO"),console.log("entrei")):(console.log(t.cancellation_date),$("#divCancel").removeClass("bg-danger text-white"),$("#divCancel").html("Cancelamento")),$("#mdSectors").modal("show")})),$("#orderForm").on("submit",(function(t){return t.preventDefault(),""==$("#mdInputID").val()?$.ajax({type:"POST",url:"/api/pedidos/guardar",data:$(this).serializeArray()}).done((function(t){if(response=JSON.parse(t),toastAlert(response.status,response.message),clearAllInputsValidations("orderForm"),"success"==response.status)e.ajax.reload(),$("#mdCrud").modal("hide");else for(var a in response.data)invalidateInput(a,response.data[a][0])})):$.ajax({type:"PUT",url:"/api/pedidos/editar/"+$("#mdInputID").val(),data:$(this).serializeArray()}).done((function(t){if(response=JSON.parse(t),toastAlert(response.status,response.message),clearAllInputsValidations("orderForm"),"success"==response.status)e.ajax.reload(),$("#mdCrud").modal("hide");else for(var a in response.data)invalidateInput(a,response.data[a][0])})),!1})),$("#sectorsActionForm").on("submit",(function(t){return t.preventDefault(),""!=$("#mdOrderInputID").val()&&$.ajax({type:"PUT",url:"/api/pedidos/editar/"+$("#mdOrderInputID").val(),data:$(this).serializeArray()}).done((function(t){if(response=JSON.parse(t),toastAlert(response.status,response.message),clearAllInputsValidations("sectorsActionForm"),"success"==response.status)e.ajax.reload(),$("#mdSectors").modal("hide");else for(var a in response.data)invalidateInput(a,response.data[a][0])})),!1})),$("#mdCrud").on("hidden.bs.modal",(function(e){clearAllInputsValues("orderForm")}));var t=$("div.setup-panel div a"),a=$(".setup-content");$(".nextBtn");a.hide(),t.click((function(e){e.preventDefault();var r=$($(this).attr("href")),n=$(this);n.hasClass("disabled")||(t.addClass("btn-secondary text-dark"),n.removeClass("btn-secondary text-dark").addClass("btn-primary text-white"),$("#mdOrderSector").val(n.text()),a.hide(),r.show())})),$(".select-server-side").each((function(e){$(this).select2({ajax:{delay:250,theme:"bootstrap",url:"/api/"+$(this).attr("data-values")+"/select",dataType:"json",data:function(e){return{search:e.term,page:e.page||1}}}})})),$("div.setup-panel div a.btn-success").trigger("click")}))}});