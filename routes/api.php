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
		Route::get('jobs/showSubmit/{id}', 'JobController@showSubmit');
		Route::post('jobs/sendJob/{id}', 'JobController@sendJob');
		Route::resource('tools', 'ToolController');
		Route::resource('files','FileController');

		Route::post('files/uploadFiles','FileController@uploadFiles');
		Route::post('files/update/{id}','FileController@update');
		Route::get('files/donwload/{id}','FileController@donwload');
		Route::resource('roles', 'RolController');
});	