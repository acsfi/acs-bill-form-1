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
    return view('welcome', ["title" => "Hello"]);
});
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
