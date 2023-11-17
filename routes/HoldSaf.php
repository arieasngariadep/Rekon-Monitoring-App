<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoldSaf\DashboardController;
use App\Http\Controllers\HoldSaf\HoldSafController;
use App\Http\Controllers\HoldSaf\ReleasedByController;

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

// ================ HoldPaymentMerchant Routing ================ //
Route::prefix('HoldSaf')->group(function(){
    // Route::get('/dashboard', [DashboardController::class, 'dashboardHoldPayment'])->name('dashboardHoldPayment')->middleware('checkauth');
    Route::get('/getListHoldSaf', [HoldSafController::class, 'getListHoldSaf'])->name('getListHoldSaf')->middleware('checkauth');
    Route::get('/formUploadHoldSaf',[HoldSafController::class, 'formUploadHoldSaf'])->name('formUploadHoldSaf')->middleware('checkauth');
    Route::get('/formUpdateBulkHoldSaf',[HoldSafController::class, 'formUpdateBulkHoldSaf'])->name('formUpdateBulkHoldSaf')->middleware('checkauth');
    Route::get('/formUpdateHoldSaf',[HoldSafController::class, 'formUpdateHoldSaf'])->name('formUpdateHoldSaf')->middleware('checkauth');
    Route::get('deleteHoldSafById', [HoldSafController::class, 'deleteHoldSafById'])->name('deleteHoldSafById')->middleware('checkauth');
    
    Route::post('getReportHoldSaf',[HoldSafController::class, 'getReportHoldSaf'])->name('getReportHoldSaf')->middleware('checkauth');
    Route::post('prosesUploadHoldSaf', [HoldSafController::class, 'prosesUploadHoldSaf'])->name('prosesUploadHoldSaf')->middleware('checkauth');
    Route::post('prosesUploadReleaseHoldSaf', [HoldSafController::class, 'prosesUploadReleaseHoldSaf'])->name('prosesUploadReleaseHoldSaf')->middleware('checkauth');
    Route::post('insertDataHoldSaf', [HoldSafController::class, 'insertDataHoldSaf'])->name('insertDataHoldSaf')->middleware('checkauth');
    Route::post('clearHoldSafTemp', [HoldSafController::class, 'clearHoldSafTemp'])->name('clearHoldSafTemp')->middleware('checkauth');
    Route::post('batalReleaseHoldSaf', [HoldSafController::class, 'batalReleaseHoldSaf'])->name('batalReleaseHoldSaf')->middleware('checkauth');
     
    Route::delete('/deleteHoldSaf', [HoldSafController::class, 'deleteHoldSaf'])->name('deleteHoldSaf')->middleware('checkauth');

    Route::prefix('releasedby')->group(function(){
        Route::get('/getListReleasedBy', [ReleasedByController::class, 'getListReleasedBy'])->name('getListReleasedBy')->middleware('checkatuh');


    });
});

