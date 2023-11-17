<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoldPaymentMerchant\DashboardController;
use App\Http\Controllers\HoldPaymentMerchant\BniController;
use App\Http\Controllers\HoldPaymentMerchant\NonBniController;
use App\Http\Controllers\HoldPaymentMerchant\RekeningController;
use App\Http\Controllers\HoldPaymentMerchant\WilayahController;

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
Route::prefix('HoldPaymentMerchant')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboardHoldPayment'])->name('dashboardHoldPayment')->middleware('checkauth');

    Route::prefix('Bni')->group(function(){
        Route::get('/formUploadTolakan', [BniController::class, 'formUploadTolakanBni'])->name('formUploadTolakanBni')->middleware('checkauth');
        Route::get('/list', [BniController::class, 'getListTolakanBni'])->name('getListTolakanBni')->middleware('checkauth');
        Route::get('listResult/{userId}', [BniController::class,'getListResultTolakanBni'])->name('getListResultTolakanBni')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [BniController::class, 'formUpdateTolakanBni'])->name('formUpdateTolakanBni')->middleware('checkauth');
        Route::get('/formUpdateBulkTolakan', [BniController::class, 'formUpdateBulkBniTolakan'])->name('formUpdateBulkTolakan')->middleware('checkauth');

        Route::post('prosesUpdateBulkTolakan',[BniController::class,'prosesUpdateBulkTolakan'])->name('prosesUpdateBulkTolakan')->middleware('checkauth');
        Route::post('prosesUploadSearchBulk',[BniController::class,'prosesUploadSearchBulkTolakan'])->name('prosesUploadSearchBulkTolakan')->middleware('checkauth');
        Route::post('prosesUploadTolakanBni', [BniController::class, 'prosesUploadTolakanBni'])->name('prosesUploadTolakanBni')->middleware('checkauth');
        Route::delete('/prosesDelete', [BniController::class, 'deleteTolakanBni'])->name('deleteTolakanBni')->middleware('checkauth');
        Route::get('/prosesDeleteTolakanBni/{id}', [BniController::class, 'deleteTolakanBniById'])->name('deleteTolakanBniById')->middleware('checkauth');
        Route::post('prosesReportBniTolakanExport', [BniController::class, 'prosesReportBniTolakanExport'])->name('prosesReportBniTolakanExport')->middleware('checkauth');
        Route::post('prosesReportSearchBulkBniTolakanExport', [BniController::class, 'prosesReportSearchBulkBniTolakanExport'])->name('prosesReportSearchBulkBniTolakanExport')->middleware('checkauth');
        Route::post('prosesUploadRelaseBni', [BniController::class, 'prosesUploadRelaseBni'])->name('prosesUploadRelaseBni')->middleware('checkauth');
        Route::post('prosesUpdateTolakanBni', [BniController::class, 'prosesUpdateTolakanBni'])->name('prosesUpdateTolakanBni')->middleware('checkauth');
        Route::post('prosesInsertTolakanBni', [BniController::class, 'prosesInsertTolakanBni'])->name('prosesInsertTolakanBni')->middleware('checkauth');
        Route::post('prosesClearBniTemp', [BniController::class, 'prosesClearBniTemp'])->name('prosesClearBniTemp')->middleware('checkauth');
        Route::post('prosesBatalkanReleaseBni', [BniController::class, 'prosesBatalkanReleaseBni'])->name('prosesBatalkanReleaseBni')->middleware('checkauth');
    });

    Route::prefix('NonBni')->group(function(){
        Route::get('/formUploadTolakan', [NonBniController::class, 'formUploadTolakanNonBni'])->name('formUploadTolakanNonBni')->middleware('checkauth');
        Route::get('/list', [NonBniController::class, 'getListTolakanNonBni'])->name('getListTolakanNonBni')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [NonBniController::class, 'formUpdateTolakanNonBni'])->name('formUpdateTolakanNonBni')->middleware('checkauth');

        Route::post('prosesUploadTolakanNonBni', [NonBniController::class, 'prosesUploadTolakanNonBni'])->name('prosesUploadTolakanNonBni')->middleware('checkauth');
        Route::delete('/prosesDelete', [NonBniController::class, 'deleteTolakanNonBni'])->name('deleteTolakanNonBni')->middleware('checkauth');
        Route::post('prosesReportNonBniTolakanExport', [NonBniController::class, 'prosesReportNonBniTolakanExport'])->name('prosesReportNonBniTolakanExport')->middleware('checkauth');
        Route::get('/prosesDeleteTolakanNonBni/{id}', [NonBniController::class, 'deleteTolakanNonBniById'])->name('deleteTolakanNonBniById')->middleware('checkauth');
        Route::post('prosesUploadReleaseNonBni', [NonBniController::class, 'prosesUploadReleaseNonBni'])->name('prosesUploadReleaseNonBni')->middleware('checkauth');
        Route::post('prosesUpdateTolakanNonBni', [NonBniController::class, 'prosesUpdateTolakanNonBni'])->name('prosesUpdateTolakanNonBni')->middleware('checkauth');
        Route::post('prosesInsertTolakanNonBni', [NonBniController::class, 'prosesInsertTolakanNonBni'])->name('prosesInsertTolakanNonBni')->middleware('checkauth');
        Route::post('prosesClearNonBniTemp', [NonBniController::class, 'prosesClearNonBniTemp'])->name('prosesClearNonBniTemp')->middleware('checkauth');
        Route::post('prosesBatalkanReleaseNonBni', [NonBniController::class, 'prosesBatalkanReleaseNonBni'])->name('prosesBatalkanReleaseNonBni')->middleware('checkauth');
    });

    Route::prefix('Rekening')->group(function(){
        Route::get('/list', [RekeningController::class, 'getListRekening'])->name('getListRekening')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [RekeningController::class, 'formUpdateRekening'])->name('formUpdateRekening')->middleware('checkauth');

        Route::post('prosesUpdateRekening', [RekeningController::class, 'prosesUpdateRekening'])->name('prosesUpdateRekening')->middleware('checkauth');
        Route::get('/deleteRekeningById/{id}', [RekeningController::class, 'deleteRekeningById'])->name('deleteRekeningById')->middleware('checkauth');
        Route::post('prosesAddRekening', [RekeningController::class, 'prosesAddRekening'])->name('prosesAddRekening')->middleware('checkauth');
        Route::delete('/deleteRekening', [RekeningController::class, 'deleteRekening'])->name('deleteRekening')->middleware('checkauth');
        Route::post('prosesUploadRekening', [RekeningController::class, 'prosesUploadRekening'])->name('prosesUploadRekening')->middleware('checkauth');
    });

    Route::prefix('Wilayah')->group(function(){
        Route::get('/list', [WilayahController::class, 'getListWilayah'])->name('getListWilayah')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [WilayahController::class, 'formUpdateWilayah'])->name('formUpdateWilayah')->middleware('checkauth');

        Route::post('prosesUpdateWilayah', [WilayahController::class, 'prosesUpdateWilayah'])->name('prosesUpdateWilayah')->middleware('checkauth');
        Route::get('/deleteWilayahById/{id}', [WilayahController::class, 'deleteWilayahById'])->name('deleteWilayahById')->middleware('checkauth');
        Route::post('prosesAddWilayah', [WilayahController::class, 'prosesAddWilayah'])->name('prosesAddWilayah')->middleware('checkauth');
        Route::delete('/deleteWilayah', [WilayahController::class, 'deleteWilayah'])->name('deleteWilayah')->middleware('checkauth');
        Route::post('prosesUploadWilayah', [WilayahController::class, 'prosesUploadWilayah'])->name('prosesUploadWilayah')->middleware('checkauth');
    });
});
