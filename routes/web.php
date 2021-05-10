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
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/add-employee', 'AdminController@addEmployee');
Route::post('/store-employee', 'AdminController@store');

Route::get('/vacations', 'VacationController@index')->name('vacations');
Route::post('/store-vacation', 'VacationController@store');


