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

// Route::get('/', function () {
//     return view('welcome');
// })->name('wellcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'Main@welcome')->name('welcome');
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/warehouse', function(){ 
	return view('production.warehouse.warehouse');
});

Route::resource('/Order','OrderController');

// Route::middleware('auth')->group(function () {
// STATUS 
Route::middleware('role:production/warehouse')->group(function () {
	Route::get('/production/warehouse/home','HomeController@warehouse')->name('warehouse.home');
	Route::resource('/production/warehouse/materials','warehouseController');
	Route::resource('/production/warehouse/inventory','warehouseDetailController');
	Route::get('/inventory_get','warehouseDetailController@get')->name('inventory_get');
	Route::get('/production/warehouse/delivery','OrderController@delivery')->name('delivery');
	Route::get('/production/warehouse/delivery/info','OrderController@deliveryInfo')->name('deliveryInfo');
	Route::get('/production/warehouse/delivery/set','OrderController@delivered')->name('delivered');
});

Route::middleware('role:production/staff')->group(function () {
	Route::get('/production/staff/home','HomeController@production_staff')->name('production.staff.home');
	Route::get('/production/staff/report','warehouseDetailController@report')->name('production.staff.report');
	Route::get('/production/staff/order','OrderController@order_create')->name('production.staff.order');
	Route::get('/inventory_get','warehouseDetailController@get')->name('inventory_get');
});

Route::middleware('role:production/admin')->group(function () {
	Route::get('/production/admin/home','HomeController@production_admin')->name('production.admin.home');
});

Route::middleware('role:procurement/staff')->group(function () {
	Route::get('/procurement/staff/home','HomeController@procurement_staff')->name('procurement.staff.home');
	Route::get('/procurement/staff/order','OrderController@order_2_index')->name('procurement.staff.order');
	Route::get('/procurement/staff/order/edit','OrderController@order_edit')->name('order_edit');
	Route::get('/setsupplier','OrderController@set_supplier')->name('setsupplier');
	Route::get('/noteget','OrderController@note_2_get')->name('note_2_get');
	Route::get('/setprice','OrderController@set_price')->name('setprice');
	Route::get('/status_2_change','OrderController@status_2_change')->name('status_2_change');
	Route::get('/procurement/staff/order/error','OrderController@status_2_change_error')->name('status_2_change_error');
	Route::get('/procurement/staff/order/success','OrderController@status_2_change_success')->name('status_2_change_success');
	Route::resource('procurement/supplier','SupplierController');

});
Route::middleware('role:procurement/admin')->group(function () {
	Route::get('/procurement/admin/home','HomeController@procurement_admin')->name('procurement.admin.home');
	Route::get('/procurement/admin/order','OrderController@order_3_index')->name('procurement.admin.order');
	Route::get('/procurement/admin/order/detail','OrderController@order_3_detail')->name('procurement.admin.order.detail');
	Route::get('/procurement/admin/order/reject','OrderController@order_3_reject')->name('procurement.admin.order.reject');
	Route::get('/status_3_change','OrderController@status_3_change')->name('status_3_change');
});

Route::middleware('role:finance/staff')->group(function () {

	Route::get('/finance/staff/home','HomeController@finance_staff')->name('finance.staff.home');

	Route::get('/finance/account/addbudget','AccountController@newbudget')->name('account.newbudget');

	Route::get('/finance/account/budget','AccountController@account')->name('account.addtype');

	Route::get('/finance/account/addbalance','AccountController@amountadd')->name('account.addbalance');

	Route::resource('finance/account','AccountController');

});


Route::middleware('role:finance/admin')->group(function () {
	Route::get('/finance/admin/home','HomeController@finance_admin')->name('finance.admin.home');
});
