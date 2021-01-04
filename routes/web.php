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
Route::group(['middleware'=>'auth'], function()
{
  Route::get('/', 'ClientController@main');
  Route::get('quickview/{id}',[
      'as'=>'quickView',
      'uses'=> 'ClientController@quickView'
  ]);
  Route::get('/redirect', 'ClientController@redirect');
  Route::get('/reloadcart', 'ClientController@reloadCart');
  Route::get('/store', 'ClientController@showItems');
  Route::get('/product/{id}', 'ClientController@showItem');
  Route::put('/add-to-cart', 'ClientController@addToCart');
  Route::delete('/remove-from-cart/{id}', 'ClientController@removeFromCart');
  Route::get('/checkout', 'ClientController@checkout');
  Route::post('/rent', 'ClientController@rent');
  Route::get('/invoice/{code}', 'ClientController@invoice')->name('invoice');
  Route::get('/terms_and_conditions', 'ClientController@tnc')->name('tnc');

  Route::get('/tenant', 'TenantController@index')->name('tenant_index');
  Route::get('/tenant/item/add', 'TenantController@addItem')->name('tenant_add_item');
  Route::post('/tenant/item/add/submit', 'TenantController@submitItem')->name('tenant_submit_item');
  Route::get('/tenant/commission/request', 'TenantController@commissionRequest')->name('tenant_request_commission');
  Route::get('/tenant/commission/request/submit', 'TenantController@submitCommissionRequest')->name('tenant_submit_commission_request');
  Route::get('/tenant/commission/details&id={id}', 'TenantController@commissionDetails')->name('tenant_commission_details');
  Route::get('/tenant/commissions&tenant={id}', 'TenantController@showCommissions')->name('tenant_show_commissions');

  Route::get('/admin','AdminController@showOrders');
  Route::get('/admin/orders','AdminController@showOrders')->name('show_orders');
  Route::get('/admin/orders/unaccepted','AdminController@showUnacceptedOrders')->name('show_unnacepted_orders');
  Route::get('/admin/orders/accepted','AdminController@showAcceptedOrders')->name('show_accepted_orders');
  Route::get('/admin/orders/finished','AdminController@showFinishedOrders')->name('show_finished_orders');

  Route::get('/admin/order/start/{id}', 'AdminController@startOrder')->name('start_order');
  Route::get('/admin/order/get/{id}', 'AdminController@getOrder')->name('get_order');
  Route::post('/admin/order/finish', 'AdminController@finishOrder')->name('finish_order');

  Route::get('/admin/items', 'AdminController@showItems')->name('show_items');
  Route::get('/admin/items/unaccepted', 'AdminController@showUnnaceptedItems')->name('show_unaccepted_items');
  Route::get('/admin/items/retract', 'AdminController@showUnretractedItems')->name('show_retract_requests');
  Route::post('/admin/item/add', 'AdminController@addItem')->name('add_item');
  Route::get('/admin/items/accept&id={id}', 'AdminController@acceptLeaseRequest')->name('accept_request');

  Route::get('/admin/commissions', 'AdminController@showCommissions')->name('show_commissions');
  Route::get('/admin/commissions&accepted=0', 'AdminController@commissionRequest')->name('show_unnacepted_commissions');
  Route::get('/admin/commissions/accepted&id={id}', 'AdminController@acceptCommission')->name('accept_commission');

  Route::get('/admin/clients', 'AdminController@showClients')->name('show_clients');
  Route::get('/admin/client/history/{id}', 'AdminController@getClientRents')->name('get_client_history');
});

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
