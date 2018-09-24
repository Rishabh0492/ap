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
    return view('auth.login');
});
Route::get('localization/{locale}','LocalizationController@index');

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function()
{	
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//user
Route::get('/admin/users','UserController@index');
Route::get('/admin/user-profile','UserController@showUserProfile');
Route::post('/getRegisterdUser','UserController@show');
Route::get('/admin/{id}/editprofile','UserController@edit');
Route::get('/admin/user/delete/{id}','UserController@destroy');
//customer
Route::get('/admin/customer','CustomerController@index');
Route::get('/admin/customer/create','CustomerController@create');
Route::post('/getCustomerData','CustomerController@show');
Route::get('admin/customer/delete/{id}','CustomerController@destroy');
Route::get('admin/edit/{id}/customer','CustomerController@edit');

//dynamic email
Route::get('/admin/dynamic-emails/view','DynamicController@viewTemplateData');
Route::get('/admin/dynamic-emails','DynamicController@index');
Route::post('/getDynamicEmailData','DynamicController@show');
Route::get('/admin/dynamic-emails/create','DynamicController@create');
Route::get('/admin/dynamic-emails/{id}/edit','DynamicController@edit');
Route::get('admin/template/delete/{id}','DynamicController@destroy');

//label
Route::get('/admin/labels','LabelController@index');
Route::get('/admin/labels/create','LabelController@create');
Route::post('/getLabelData','LabelController@show');
Route::get('admin/edit/{id}/labels','LabelController@edit');
Route::get('admin/labels/delete/{id}','LabelController@destroy');

});
Route::post('/admin/update/profile', 'UserController@update');
Route::post('/customer/store','CustomerController@store');
Route::post('/store/email','DynamicController@store');
Route::post('/email/update','DynamicController@update');
Route::get('/admin/labels/store','LabelController@store');
Route::post('update/customer','CustomerController@update');
Route::post('/update/labels','LabelController@update');

