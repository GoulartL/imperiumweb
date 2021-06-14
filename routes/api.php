<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('clientes', 'Customer\\CustomerController@index')->name('customers.index');
Route::get('clientes/select', 'Customer\\CustomerController@selectComponent')->name('customers.select2');
Route::get('clientes/{customer}', 'Customer\\CustomerController@show')->name('customers.show');
Route::post('clientes/guardar', 'Customer\\CustomerController@store')->name('customers.store');
Route::put('clientes/editar/{customer}', 'Customer\\CustomerController@update')->name('customers.update');
Route::delete('clientes/remover/{customer}', 'Customer\\CustomerController@destroy')->name('customers.destroy');

Route::get('funcionarios', 'Employee\\EmployeeController@index')->name('employees.index');
Route::get('funcionarios/{employee}', 'Employee\\EmployeeController@show')->name('employees.show');
Route::post('funcionarios/guardar', 'Employee\\EmployeeController@store')->name('employees.store');
Route::put('funcionarios/editar/{employee}', 'Employee\\EmployeeController@update')->name('employees.update');
Route::delete('funcionarios/remover/{employee}', 'Employee\\EmployeeController@destroy')->name('employees.destroy');

Route::get('fornecedores', 'Supplier\\SupplierController@index')->name('suppliers.index');
Route::get('fornecedores/select', 'Supplier\\SupplierController@selectComponent')->name('suppliers.select2');
Route::get('fornecedores/{supplier}', 'Supplier\\SupplierController@show')->name('suppliers.show');
Route::post('fornecedores/guardar', 'Supplier\\SupplierController@store')->name('suppliers.store');
Route::put('fornecedores/editar/{supplier}', 'Supplier\\SupplierController@update')->name('suppliers.update');
Route::delete('fornecedores/remover/{supplier}', 'Supplier\\SupplierController@destroy')->name('suppliers.destroy');

Route::get('recebimentos', 'Receivement\\ReceivementController@index')->name('receipts.index');
Route::get('recebimentos/{receivement}', 'Receivement\\ReceivementController@show')->name('receipts.show');
Route::post('recebimentos/guardar', 'Receivement\\ReceivementController@store')->name('receipts.store');
Route::put('recebimentos/editar/{receivement}', 'Receivement\\ReceivementController@update')->name('receipts.update');
Route::delete('recebimentos/remover/{receivement}', 'Receivement\\ReceivementController@destroy')->name('receipts.destroy');

Route::get('pagamentos', 'Payment\\PaymentController@index')->name('payments.index');
Route::get('pagamentos/{payment}', 'Payment\\PaymentController@show')->name('payments.show');
Route::post('pagamentos/guardar', 'Payment\\PaymentController@store')->name('payments.store');
Route::put('pagamentos/editar/{payment}', 'Payment\\PaymentController@update')->name('payments.update');
Route::delete('pagamentos/remover/{payment}', 'Payment\\PaymentController@destroy')->name('payments.destroy');

Route::get('pedidos', 'Order\\OrderController@index')->name('orders.index');
Route::get('pedidos/select', 'Order\\OrderController@selectComponent')->name('orders.select2');
Route::get('pedidos/{order}', 'Order\\OrderController@show')->name('orders.show');
Route::post('pedidos/guardar', 'Order\\OrderController@store')->name('orders.store');
Route::put('pedidos/editar/{order}', 'Order\\OrderController@update')->name('orders.update');
Route::delete('pedidos/remover/{order}', 'Order\\OrderController@destroy')->name('orders.destroy');

Route::get('diario_de_producao', 'ProductionDiary\\ProductionDiaryController@index')->name('production_diary.index');
Route::get('diario_de_producao/{production_diary}', 'ProductionDiary\\ProductionDiaryController@show')->name('production_diary.show');
Route::post('diario_de_producao/guardar', 'ProductionDiary\\ProductionDiaryController@store')->name('production_diary.store');
Route::put('diario_de_producao/editar/{production_diary}', 'ProductionDiary\\ProductionDiaryController@update')->name('production_diary.update');
Route::delete('diario_de_producao/remover/{production_diary}', 'ProductionDiary\\ProductionDiaryController@destroy')->name('production_diary.destroy');

Route::get('especies/select', 'SpecieController@selectComponent')->name('species.select2');

Route::get('dashboard/producao/historicomes', 'Dashboard\\ProductionController@HistoryMonth')->name('dashboard.production.history_month');
Route::get('dashboard/financeiro/historicomes', 'Dashboard\\CashFlowController@HistoryMonth')->name('dashboard.financial.cash_flow.history_month');
Route::get('dashboard/financeiro/historicodia', 'Dashboard\\CashFlowController@HistoryDay')->name('dashboard.financial.cash_flow.history_day');
Route::get('dashboard/financeiro/pagarnodia', 'Dashboard\\CashFlowController@PayOnTheDay')->name('dashboard.financial.cash_flow.pay_day');
Route::get('dashboard/financeiro/recebernodia', 'Dashboard\\CashFlowController@ReceiveOnTheDay')->name('dashboard.financial.cash_flow.receive_day');
