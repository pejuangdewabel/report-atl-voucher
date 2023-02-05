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
    return redirect()->route('report');
});
Route::get('/report', 'Backend\ReportController@reportATL')->name('report');
Route::post('/report-filter', 'Backend\ReportController@filterReport')->name('report-filter');
Route::post('/export-excel', 'Backend\ReportController@exportExcel')->name('report-excel');
