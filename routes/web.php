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


// Route::middleware('auth')->group(function () {
Route::middleware('role:production/warehouse')->group(function () {
	Route::get('/production/warehouse/home','HomeController@warehouse')->name('warehouse.home');
	Route::resource('/production/warehouse/materials','warehouseController');
	Route::resource('/production/warehouse/inventory','warehouseDetailController');
	Route::get('','warehouseDetailController@get')->name('inventory.get');
});
Route::middleware('role:production/staff')->group(function () {
	Route::get('/production/staff/home','HomeController@production_staff')->name('production.staff.home');
});
Route::middleware('role:production/admin')->group(function () {
	Route::get('/production/admin/home','HomeController@production_admin')->name('production.admin.home');
});
Route::middleware('role:procurement/staff')->group(function () {
	Route::get('/procurement/staff/home','HomeController@procurement_staff')->name('procurement.staff.home');
	Route::resource('procurement/supplier','SupplierController');
});
Route::middleware('role:procurement/admin')->group(function () {
	Route::get('/procurement/admin/home','HomeController@procurement_admin')->name('procurement.admin.home');
});
Route::middleware('role:finance/staff')->group(function () {
	// Route::get('/finance/staff/index','HomeController@finance_staff')->name('finance.staff.index');
	// Route::get('/finance/account/newbudget','AccountController@newbudget')->name('finance.account.newbudget');
	// Route::resource('finance/account','AccountController');
});
Route::middleware('role:finance/admin')->group(function () {
	Route::get('/finance/admin/home','HomeController@finance_admin')->name('finance.admin.home');
});
