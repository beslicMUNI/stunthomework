<?php

use Illuminate\Support\Facades\Route;

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
});

Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::get('/admin', 'AdminController@index')->name('admin')->middleware('can:admin');

Route::get('/add-employee', 'AdminController@addEmployee')->middleware('can:add-employee');
Route::post('/store-employee', 'AdminController@store')->middleware('can:store-employee');

Route::get('/vacations', 'VacationController@index')->name('vacations')->middleware('can:vacations');
Route::post('/store-vacation', 'VacationController@store')->middleware('can:store-vacation');

Route::get('/vacation/confirm/{id}', 'VacationController@confirm')->name('confrim-vacation')->middleware('can:confirm-vacation');


