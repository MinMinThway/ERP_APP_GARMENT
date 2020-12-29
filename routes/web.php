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

Route::get('/warehouse', function(){ 
	return view('production.warehouse.warehouse');
});


// Route::middleware('auth')->group(function () {
Route::middleware('role:production/warehouse')->group(function () {
	
});
Route::middleware('role:production/staff')->group(function () {
	
});
Route::middleware('role:production/admin')->group(function () {
	
});
Route::middleware('role:procurement/staff')->group(function () {
	
});
Route::middleware('role:procurement/admin')->group(function () {
	
});
Route::middleware('role:finance/staff')->group(function () {

});
Route::middleware('role:finance/admin')->group(function () {
	// Route::get('/home', 'HomeController@index')->name('home');
});
