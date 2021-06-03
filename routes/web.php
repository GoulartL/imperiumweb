<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('system.home');
})->name('system.home');

Route::get('/login', function () {
    return view('system.login.login');
})->name('system.login');

Route::get('/clientes', function () {
    return view('system.customers.customers');
})->name('system.customers');

Route::get('/fornecedores', function () {
    return view('system.suppliers.suppliers');
})->name('system.suppliers');

Route::get('/funcionarios', function () {
    return view('system.employees.employees');
})->name('system.employees');

Route::get('/recebimentos', function () {
    return view('system.financial.receipts.receipts');
})->name('system.receipts');

Route::get('/pagamentos', function () {
    return view('system.financial.payments.payments');
})->name('system.payments');

Route::get('/fluxo-de-caixa', function () {
    return view('system.financial.cash-flow.cash-flow');
})->name('system.cashFlow');

Route::get('/pedidos', function () {
    return view('system.production.orders.orders');
})->name('system.orders');

Route::get('/producao/dashboard', 'ProductionDashboard\\ProductionDashboard@show')->name('system.production.dashboard');