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
    if(Auth::guard('sinhvien')->check())
    	return redirect()->route('sv.home');
    else if(Auth::guard('pdt')->check())
    	return redirect()->route('sv.home');
    else return view('welcome');
})->name('home');


Route::post('QL_LMH/hocky/{hocky_id}', 'DBController@hockyExpand');

Route::post('QL_LMH/lmh/{lopmonhoc_id}', 'DBController@getLMH');

Route::get('QL_LMH/lmh/{lopmonhoc_id}', 'DBController@getLMH');



Route::post('QL_LMH/importSV', 'DBController@importSV');

Route::post('QL_LMH/importSV_LMH/{lopmonhoc_id}', 'DBController@importSV_LMH');

Route::post('QL_LMH/importSV_HK/{hocky_id}', 'DBController@importSV_HK');



Route::group(['prefix' => 'pdt'], function () {
	Route::get('home', 'PDTController@index')->name('pdt.home');
  	Route::get('QL_LMH', 'PDTController@QL_LMH')->name('pdt.QL_LMH');
  	Route::get('QLSV','PDTController@QLSV')->name('pdt.QLSV');
  	Route::post('QL_LMH/lmh/addPdf','PDTController@addPdf');
  	Route::post('QL_LMH/search/{hocky_id}/{search}', 'PDTController@search');
	Route::get('QL_LMH/search/{hocky_id}', 'PDTController@getAll');
	Route::post('QL_LMH/hocky', 'PDTController@initNode');
	Route::post('QL_LMH/addPdf/{lopmonhoc_id}', 'PDTController@addPdf');
	Route::get('pdf/lmh/{lopmonhoc_id}', 'PDTController@viewPdf');
});

Route::group(['prefix' => 'sinhvien'], function () {
	Route::get('LMH', 'SinhvienController@index')->name('sv.home');
  	Route::get('LMH/search','SinhvienController@getAll');
  	Route::post('LMH/search/{search}', 'SinhvienController@search');
  	Route::get('pdf/lmh/{lopmonhoc_id}', 'SinhvienController@viewPdf');
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