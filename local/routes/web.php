<?php

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
    return view('welcome');
})->name('welcome');

Route::get('import', function () {
    return view('importDemo');
});

Route::get('QL_LMH', 'DBController@QL_LMH');

Route::post('QL_LMH/hocky', 'DBController@initNode');

Route::post('QL_LMH/hocky/{hocky_id}', 'DBController@hockyExpand');

Route::post('QL_LMH/lmh/{lopmonhoc_id}', 'DBController@getLMH');

Route::get('QL_LMH/lmh/{lopmonhoc_id}', 'DBController@getLMH');

Route::post('QL_LMH/addPdf/{lopmonhoc_id}', 'DBController@addPdf');

Route::post('QL_LMH/importSV', 'DBController@importSV');

Route::post('QL_LMH/importSV_LMH/{lopmonhoc_id}', 'DBController@importSV_LMH');

Route::post('QL_LMH/importSV_HK/{hocky_id}', 'DBController@importSV_HK');

Route::group(['prefix' => 'pdt'], function () {
	Route::get('home', 'PDTController@index')->name('pdt.home');
    Route::get('QL_LMH', 'PDTController@QL_LMH');
});

Route::group(['prefix' => 'sinhvien'], function () {
	Route::get('home_sv', 'SinhvienController@index')->name('sv.home');
	Route::get('LMH','SinhvienController@LMH');
    Route::post('LMH/hocky','DBController@initNode');
    Route::post('LMH/hocky/{hocky_id}', 'DBController@hockyExpand');
    Route::post('LMH/lmh/{lopmonhoc_id}', 'DBController@getLMH');
});

Route::group(['prefix' => 'auth'], function () {
	Route::get('login', [
	  'as' => 'login',
	  'uses' => 'Auth\LoginController@getLogin'
	]);
	Route::post('login', [
	  'as' => '',
	  'uses' => 'Auth\LoginController@postLogin'
	]);
	Route::post('logout', [
	  'as' => 'logout',
	  'uses' => 'Auth\LoginController@logout'
	]);
	
	// Password Reset Routes...
	Route::post('password/email', [
	  'as' => 'password.email',
	  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
	]);
	Route::get('password/reset', [
	  'as' => 'password.request',
	  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
	]);
	Route::post('password/reset', [
	  'as' => '',
	  'uses' => 'Auth\ResetPasswordController@reset'
	]);
	Route::get('password/reset/{token}', [
	  'as' => 'password.reset',
	  'uses' => 'Auth\ResetPasswordController@showResetForm'
	]);
	
	// Registration Routes...
	Route::get('register', [
	  'as' => 'register',
	  'uses' => 'Auth\RegisterController@showRegistrationForm'
	]);
	Route::post('register', [
	  'as' => '',
	  'uses' => 'Auth\RegisterController@register'
	]);
});