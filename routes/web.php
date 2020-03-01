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

// Route::get('/', function () {
//     return view('clients.main');
// });
Route::get('/', 'ClientController@main');
Route::get('quickview/{id}',[
    'as'=>'quickView',
    'uses'=> 'ClientController@quickView'
]);
Route::get('/store', 'ClientController@showItems');
Route::get('/product/{id}', 'ClientController@showItem');
