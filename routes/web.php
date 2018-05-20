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
Route::get('/',function(){
	dd("comming soon");
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	Route::get('/','FrontController@login');
	Route::get('login','FrontController@login');
	Route::post('authenticate','FrontController@authenticate');
	Route::get('employee','Employee@addView');
	Route::group(['middleware' => 'AdminAuth'],function(){
		Route::get('dashboard','AdminController@dashboard');

	});
	Route::get('/logout', function () { 
		\Auth::logout();
		return redirect('admin/login'); 
	});
});


Route::get('/home', 'HomeController@index')->name('home');
