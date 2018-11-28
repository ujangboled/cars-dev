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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/type', 'TypeCarsController@index')->name('type');
//route of cars
Route::resource('/cars', 'CarsController');
Route::get('/table/cars', 'CarsController@dataTable')->name('table.Cars');
//route of types
Route::resource('/type', 'TypeCarsController');
Route::get('/table/type', 'TypeCarsController@dataTable')->name('table.Type');
 //route of User
Route::resource('/user', 'UserController');

Route::group(['prefix' => 'api'], function() 
{
    Route::get('address', 'UserController@getUserAddress');
});
         