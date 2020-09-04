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
})->middleware('auth')->name('inserir.usuario');

Route::get('/inserir-registro', function () {
    return view('inserir-registro');
})->middleware('auth')->name('inserir.registro');


//Services
Route::post('/usuario/login', array('as' => 'ajax.login', 'uses'  => 'UserController@login'));

Route::get('/usuario/logout', array('uses'  => 'UserController@logout'))->name('logout');

Route::post('/usuario/cadastrar', array('uses'  => 'UserController@store'))->name('ajax.cadastro.usuario');
