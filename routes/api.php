<?php

use Illuminate\Http\Request;

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
Route::get('estado', 'CondorController@index');
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'ApiAuthController@authenticate');

Route::group(['middleware' => ['jwt.auth']], function () {

Route::resource('herramienta', 'HerramientaController');
Route::resource('proyecto', 'ProyectoController');
Route::resource('estadoherramienta', 'EstadoHerramientaController');
Route::resource('terea', 'TereaController');
Route::resource('usuario', 'UsuarioController');
Route::resource('archivo', 'ArchivoController');
Route::resource('rol', 'RolController');

});	