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


Route::get('/','PagesController@index');

// Users
Route::get('/users','User\UsersManagerController@index')->name('users');
Route::get('/users/create','User\UsersManagerController@create')->name('users.create');

Route::get('/roles','User\RoleManagerController@create')->name('roles');
Route::get('/roles/create','User\RoleManagerController@create')->name('roles.create');

Route::get('/permissions/create','User\PermissionManagerController@create')->name('permission.create');

Route::post('/users/store','User\UsersManagerController@store')->name('users.store');

// Users Roles
Route::get('/users/roles','User\UsersManagerController@roles')->name('users.roles');
// Users Roles
Route::get('/users/permissions','User\UsersManagerController@permissions')->name('users.permissions');

Route::get('/bill','BillController@index')->name('bill');

Route::get('/print-page', function () {
    return view('print', ["title" => "Print"]);
});

Route::get('/printables', 'BillController@print_page');
Route::post('/bills', 'BillController@fetch_all_bills');
Route::post('/create/bill', 'BillController@create_bill');
Route::post('/get/bill/{id}', 'BillController@get_bill');
Route::post('/update/bill/{id}', 'BillController@update_bill');

Route::post('/print/bill/{ids}', 'BillController@print_bills');
Route::post('/records/save', 'BillController@records_save');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
