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
Route::get('status', 'CondorController@index');
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});
	
	Route::post('login', 'ApiAuthController@authenticate');
	Route::resource('users', 'UserController');
	
	Route::group(['middleware' => ['jwt.auth']], function () {
		Route::resource('jobs', 'JobController');
		Route::resource('tools', 'ToolController');
		Route::resource('files', 'FilesController');
		Route::resource('roles', 'RolesController');
});	