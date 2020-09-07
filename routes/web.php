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

//views
Route::get('/', function () {
    // echo phpinfo();
    return view('index');
})->name('index');

Route::get('/main', function () {
    return view('main');
})->middleware('auth')->name('main.agenda');

Route::get('/usuario-cadastro', function () {
    return view('inserir-usuario');
})->name('inserir.usuario');

Route::get('/inserir-registro', function () {
    return view('inserir-registro');
})->middleware('auth')->name('inserir.registro');

Route::get('/cliente-registro/{id}', function () {
    return view('registro-cliente');
})->middleware('auth')->name('cliente.registro');


//Services
Route::get('/usuario/logout', 'UserController@logout')->name('logout');

Route::post('/usuario/login', 'UserController@login')->name('ajax.login');

Route::post('/usuario/cadastrar', 'UserController@store')->name('ajax.cadastro.usuario');

Route::get('/cliente/exibir/{id}', 'ClienteController@show');

Route::get('/cliente/pesquisa/{pesquisa?}', 'ClienteController@index')->name('ajax.pesquisa.cliente');

Route::post('/cliente/cadastrar', 'ClienteController@store')->name('ajax.cadastro.cliente');
