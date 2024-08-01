<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorInvoice;

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
// });

Route::get('/', "AppController@index")->name('dashboard');
Route::get('/add-party', "PartyController@addParty")->name('add-party');
Route::get('/manage-parties', "PartyController@index")->name('manage-parties');
Route::post('/create-party', "PartyController@createParty")->name('create-party');
Route::get('/edit-party/{id}', "PartyController@editParty")->name('edit-party');
Route::put('/update-party/{id}', "PartyController@updateParty")->name('update-party');
Route::delete('delete-party/{party}', "PartyController@deleteParty")->name('delete-party');


Route::get('/add-gst-bill', "GstBillController@addGstBill")->name('add-gst-bill');
Route::get('/manage-gst-bills', "GstBillController@index")->name('manage-gst-bills');
Route::get('/print-gst-bill/{id}', "GstBillController@print")->name('print-gst-bill');
Route::post('/create-gst-bill', "GstBillController@createGstBill")->name('create-gst-bill');
// Soft Delete route
Route::get('/delete/{table}/{id}', "AppController@delete")->name('delete');


Route::resource('vendor-invoice', 'VendorInvoice');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
