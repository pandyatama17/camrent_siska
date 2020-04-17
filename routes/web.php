<?php
use Illuminate\Support\Facades\Log;

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
Route::get('/reloadcart', 'ClientController@reloadCart');
Route::get('/store', 'ClientController@showItems');
Route::get('/product/{id}', 'ClientController@showItem');
Route::put('/add-to-cart', 'ClientController@addToCart');
Route::delete('/remove-from-cart/{id}', 'ClientController@removeFromCart');
Route::get('/checkout', 'ClientController@checkout');
Route::post('/rent', 'ClientController@rent');
Route::get('/invoice/{code}', 'ClientController@invoice');
Route::get('/flush', function()
{
  session()->forget('cart');
  // return Redirect::to('/cart');
  return Redirect::back()->with('message', 'Cart Cleared!');
});
Route::get('/sescheck', function()
{
  dd(Auth::user());
});
Route::get('/check', function()
{
  dd(session('cart'));
  // if (null == session('cart'))
  // {
  //   return "kosong";
  // }
  // else
  // {
  //   return 'ada';
  // }
});

Auth::routes();
Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('login');
});
