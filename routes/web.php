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
})->name('system.home')->middleware('auth');

Route::get('/login', 'User\\UserController@login')->name('system.login');
Route::post('/login', 'User\\UserController@auth')->name('system.auth');

Route::get('/clientes', function () {
    return view('system.customers.customers');
})->name('system.customers')->middleware('auth');

Route::get('/fornecedores', function () {
    return view('system.suppliers.suppliers');
})->name('system.suppliers')->middleware('auth');

Route::get('/funcionarios', function () {
    return view('system.employees.employees');
})->name('system.employees')->middleware('auth');

Route::get('/recebimentos', function () {
    return view('system.financial.receipts.receipts');
})->name('system.receipts')->middleware('auth');

Route::get('/pagamentos', function () {
    return view('system.financial.payments.payments');
})->name('system.payments')->middleware('auth');

Route::get('/fluxo-de-caixa', function () {
    return view('system.financial.cash-flow.cash-flow');
})->name('system.cashFlow')->middleware('auth');

Route::get('/pedidos', function () {
    return view('system.production.orders.orders');
})->name('system.orders')->middleware('auth');

Route::get('/diario_de_producao', function () {
    return view('system.production.production-diary.production_diary');
})->name('system.production_diary')->middleware('auth');

Route::get('/producao/dashboard', 'Dashboard\\ProductionController@show')->name('system.dashboard.production')->middleware('auth');