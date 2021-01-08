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
Route::get('/documentation','Main@docs')->name('docs');
Route::resource('/Order','OrderController');
Route::get('/noti','OrderController@noti')->name('noti');
// Route::middleware('auth')->group(function () {
// STATUS 
Route::middleware('role:production/warehouse')->group(function () {
	Route::get('/production/warehouse/home','HomeController@warehouse')->name('warehouse.home');
	Route::resource('/production/warehouse/materials','warehouseController');
	Route::resource('/production/warehouse/inventory','warehouseDetailController');
	Route::get('/inventory_get1','warehouseDetailController@get1')->name('inventory_get1');
	Route::get('/production/warehouse/delivery','OrderController@delivery')->name('delivery');
	Route::get('/production/warehouse/delivery/info','OrderController@deliveryInfo')->name('deliveryInfo');
	Route::get('/production/warehouse/delivery/set','OrderController@delivered')->name('delivered');
	Route::get('/production/warehouse/history','OrderController@history')->name('history');
	Route::get('/production/warehouse/history/info','OrderController@deliveredInfo')->name('deliveredInfo');
	Route::get('/earning1','warehouseDetailController@earning1')->name('earning1');
});

Route::middleware('role:production/staff')->group(function () {
	Route::get('/production/staff/home','HomeController@production_staff')->name('production.staff.home');
	Route::get('/production/staff/report','warehouseDetailController@report')->name('production.staff.report');
	Route::get('/note0get','OrderController@note_0_get')->name('note_0_get');
	Route::get('/production/staff/order','OrderController@order_create')->name('production.staff.order');
	Route::get('/inventory_get','warehouseDetailController@get')->name('inventory_get');
	Route::get('/production/staff/history','OrderController@staff_0_history')->name('staff_0_history');
	Route::get('/production/staff/history/info','OrderController@order_0_info')->name('order_0_info');
	Route::get('/production/staff/analysis','warehouseDetailController@analysis')->name('analysis');
	Route::get('/earning2','warehouseDetailController@earning2')->name('earning2');
});

Route::middleware('role:production/admin')->group(function () {
Route::get('/production/admin/home','HomeController@production_admin')->name('production.admin.home');
Route::get('/production/admin/report','warehouseDetailController@report2')->name('production.admin.report');
Route::get('/production/admin/analysis','warehouseDetailController@analysis2')->name('analysis2');
Route::get('/production/admin/order','OrderController@order_1_index')->name('production.admin.order');
Route::get('/production/admin/order/detail','OrderController@order_1_detail')->name('production.admin.order.detail');
Route::get('/production/admin/history','OrderController@admin_1_history')->name('admin_1_history');
Route::get('/production/admin/history/info','OrderController@order_1_info')->name('order_1_info');
Route::get('/status_1_change','OrderController@status_1_change')->name('status_1_change');
Route::get('/production/admin/order/reject','OrderController@order_1_reject')->name('production.admin.order.reject');
Route::get('/earning3','warehouseDetailController@earning3')->name('earning3');
});

Route::middleware('role:procurement/staff')->group(function () {
	Route::get('/procurement/staff/home','HomeController@procurement_staff')->name('procurement.staff.home');
	Route::get('/procurement/staff/order','OrderController@order_2_index')->name('procurement.staff.order');
	Route::get('/procurement/staff/order/edit','OrderController@order_edit')->name('order_edit');
	Route::get('/setsupplier','OrderController@set_supplier')->name('setsupplier');
	Route::get('/note_2_get','OrderController@note_2_get')->name('note_2_get');
	Route::get('/setprice','OrderController@set_price')->name('setprice');
	Route::get('/status_2_change','OrderController@status_2_change')->name('status_2_change');
	Route::get('/procurement/staff/order/error','OrderController@status_2_change_error')->name('status_2_change_error');
	Route::get('/procurement/staff/order/success','OrderController@status_2_change_success')->name('status_2_change_success');
	Route::resource('procurement/supplier','SupplierController');
	Route::get('/procurement/staff/history','OrderController@staff_2_history')->name('staff_2_history');
	Route::get('/procurement/staff/history/info','OrderController@order_2_info')->name('order_2_info');
	Route::get('/shipping','OrderController@order_2_shipping')->name('shipping');
Route::get('/earning4','warehouseDetailController@earning4')->name('earning4');
});
Route::middleware('role:procurement/admin')->group(function () {
	Route::get('/procurement/admin/home','HomeController@procurement_admin')->name('procurement.admin.home');
	Route::get('/procurement/admin/order','OrderController@order_3_index')->name('procurement.admin.order');
	Route::get('/procurement/admin/order/detail','OrderController@order_3_detail')->name('procurement.admin.order.detail');
	Route::get('/procurement/admin/order/reject','OrderController@order_3_reject')->name('procurement.admin.order.reject');
	Route::get('/status_3_change','OrderController@status_3_change')->name('status_3_change');
	Route::get('/procurement/admin/history','OrderController@admin_3_history')->name('admin_3_history');
	Route::get('/procurement/admin/history/info','OrderController@order_3_info')->name('order_3_info');
Route::get('/earning5','warehouseDetailController@earning5')->name('earning5');
});

Route::middleware('role:finance/staff')->group(function () {

	Route::get('/finance/staff/home','HomeController@finance_staff')->name('finance.staff.home');
	Route::get('/finance/staff/account/addbudget/newbudget','AccountController@newbudget')->name('account.newbudget');
	Route::get('/finance/staff/account/addbudget','AccountDetailController@account')->name('account.addtype');
	Route::get('/finance/staff/account/checkbal','AccountDetailController@checkbal')->name('account.checkbal');
	// Route::get('/finance/staff/account/checkbal','AccountDetailController@checkaccount')->name('account.checkbal');
	Route::get('/finance/staff/account/error','OrderController@error')->name('account.error');
	Route::get('/finance/staff/account/budget/addbalance','AccountDetailController@amountadd')->name('account.addbalance');
	Route::get('/finance/staff/orders','OrderController@order_4_index')->name('finance.staff.order');
	Route::get('/finance/staff/orders/detail','OrderController@order_4_edit')->name('finance.staff.order.detail');
	Route::get('/finance/staff/orders/update','OrderController@order_4_update')->name('finance.staff.order.update');
	Route::get('/finance/staff/orders/reject','OrderController@order_4_reject')->name('finance.staff.order.reject');
	Route::get('/finance/staff/balancesheet','AccountController@balancesheet')->name('finance.staff.balancesheet');
	Route::get('/finance/staff/searchbalancesheet','AccountController@balancesheetsearch')->name('finance.staff.searchbalancesheet');
	Route::get('/finance/staff/dailyreport','AccountController@dailyreport')->name('finance.staff.dailyreport');
	Route::get('/finance/staff/monthlyreport','AccountController@monthlyreport')->name('finance.staff.monthlyreport');
	Route::get('/finance/staff/yearlyreport','AccountController@yearlyreport')->name('finance.staff.yearlyreport');
	Route::get('/finance/staff/searchreport','AccountController@searchreport')->name('finance.staff.searchreport');
	Route::get('/finance/staff/monthlysearchreport','AccountController@monthlysearchreport')->name('finance.staff.monthlysearchreport');
	Route::get('/finance/staff/yearlysearchreport','AccountController@yearlysearchreport')->name('finance.staff.yearlysearchreport');
	Route::get('/finance/staff/account/budget','AccountController@account')->name('account.check');
	Route::resource('finance/staff/account','AccountController');
	Route::get('/finance/staff/history','OrderController@staff_4_history')->name('staff_4_history');
	Route::get('/finance/staff/history/info','OrderController@order_4_info')->name('order_4_info');
	Route::get('/acearning','AccountDetailController@acearning')->name('acearning');
});




Route::middleware('role:finance/admin')->group(function () {
	Route::get('/finance/admin/home','HomeController@finance_admin')->name('finance.admin.home');
	Route::get('/finance/admin/account','AccountController@adminindex')->name('account.adminindex');
	Route::get('/finance/admin/dailyreport','AccountController@admindailyreport')->name('finance.admin.dailyreport');
	Route::get('/finance/admin/monthlyreport','AccountController@adminmonthlyreport')->name('finance.admin.monthlyreport');
	Route::get('/finance/admin/yearlyreport','AccountController@adminyearlyreport')->name('finance.admin.yearlyreport');
	Route::get('/finance/admin/searchreport','AccountController@adminsearchreport')->name('finance.admin.searchreport');
	Route::get('/finance/admin/monthlysearchreport','AccountController@adminmonthlysearchreport')->name('finance.admin.monthlysearchreport');
	Route::get('/finance/admin/yearlysearchreport','AccountController@adminyearlysearchreport')->name('finance.admin.yearlysearchreport');
	Route::get('/finance/admin/history','OrderController@admin_5_history')->name('admin_5_history');
	Route::get('/finance/admin/history/info','OrderController@order_5_info')->name('order_5_info');
	Route::get('/finance/admin/orders','OrderController@order_5_index')->name('finance.admin.order');
	Route::get('/finance/admin/orders/detail/a','OrderController@order_5_edit')->name('order.order_5_edit');
	Route::get('/finance/admin/orders/detail','OrderController@status_5_change')->name('finance.admin.order.change');
	// Route::get('/finance/admin/orders/update','OrderController@order_5_update')->name('finance.admin.order.update');
	Route::get('/finance/admin/orders/reject','OrderController@order_5_reject')->name('finance.admin.order.reject');
	Route::get('/acearning2','AccountDetailController@acearning2')->name('acearning2');
	Route::get('/noteget','OrderController@note_5_get')->name('note_5_get');

});
