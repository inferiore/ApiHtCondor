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
Route::get('/', 'CondorController@index');
		
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

	
	Route::post('login', 'ApiAuthController@authenticate');
	Route::resource('users', 'UserController');
		
	Route::group(['middleware' => ['jwt.auth']], function () {

		Route::resource('jobs', 'JobController');
		Route::post('jobs/changeAlgorithm/{id?}', 'JobController@changeAlgorithm');
		Route::get('jobs/downloadAlgorithm/{id}', 'JobController@downloadAlgorithm');
		Route::get('jobs/showSubmit/{id}/{iteration}/', 'JobController@showSubmit');
		Route::post('jobs/sendJob/{id}/{iteration}/', 'JobController@sendJob');
		Route::resource('tools', 'ToolController');
		Route::resource('files','FileController');

		Route::post('files/uploadFiles','FileController@uploadFiles');
		Route::get('files/delete','FileController@destroy');
		Route::resource('roles', 'RolController');
		Route::get('jobs/syncro/{id}/{iteration}','JobController@syncro');
		Route::get('jobs/showFile/{id}/{iteration}/{basename}', 'JobController@showFile');
		
		
});	
	Route::get('files/download/{id}/{iteration}/{basename}','FileController@donwload');
		