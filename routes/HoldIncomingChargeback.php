<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoldIncomingChargeback\DashboardController;
use App\Http\Controllers\HoldIncomingChargeback\IncomingChargebackController;
use App\Http\Controllers\HoldIncomingChargeback\JenisTransaksiController;
use App\Http\Controllers\HoldIncomingChargeback\InfoStatusController;
use App\Http\Controllers\HoldIncomingChargeback\InfoIncomingController;
use App\Http\Controllers\HoldIncomingChargeback\InfoAsistenController;
use App\Http\Controllers\HoldIncomingChargeback\InfoAnalisController;
use App\Http\Controllers\HoldIncomingChargeback\UploadAsistenController;

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

// ================ IncomingChargeback Routing ================ //
Route::prefix('HoldIncomingChargeback')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboardIncomingChargeback'])->name('dashboardIncomingChargeback')->middleware('checkauth');
    
    Route::get('/formUpload', [IncomingChargebackController::class, 'formUploadIncomingChargeback'])->name('formUploadIncomingChargeback')->middleware('checkauth');
    Route::get('/list', [IncomingChargebackController::class, 'getListIncomingChargeback'])->name('getListIncomingChargeback')->middleware('checkauth');
    Route::get('/formUpdate/{id}', [IncomingChargebackController::class, 'formUpdateIncomingChargeback'])->name('formUpdateIncomingChargeback')->middleware('checkauth');
    Route::get('/listUjiCoba', [IncomingChargebackController::class, 'getListAllData'])->name('getListAllData')->middleware('checkauth');
    
    Route::post('prosesUploadIncomingChargeback', [IncomingChargebackController::class, 'prosesUploadIncomingChargeback'])->name('prosesUploadIncomingChargeback')->middleware('checkauth');
    Route::post('prosesClearIncomingChargebackTemp', [IncomingChargebackController::class, 'prosesClearIncomingChargebackTemp'])->name('prosesClearIncomingChargebackTemp')->middleware('checkauth');
    Route::post('prosesInsertIncomingChargeback', [IncomingChargebackController::class, 'prosesInsertIncomingChargeback'])->name('prosesInsertIncomingChargeback')->middleware('checkauth');
    Route::post('prosesReportIncomingChargebackExport', [IncomingChargebackController::class, 'prosesReportIncomingChargebackExport'])->name('prosesReportIncomingChargebackExport')->middleware('checkauth');
    Route::post('prosesUpdateIncomingChargeback', [IncomingChargebackController::class, 'prosesUpdateIncomingChargeback'])->name('prosesUpdateIncomingChargeback')->middleware('checkauth');
    Route::delete('/prosesDelete', [IncomingChargebackController::class, 'deleteIncomingChargeback'])->name('deleteIncomingChargeback')->middleware('checkauth');
    Route::post('prosesApproval', [IncomingChargebackController::class, 'prosesApproval'])->name('prosesApproval')->middleware('checkauth');
    Route::post('prosesBatalkanApproval', [IncomingChargebackController::class, 'prosesBatalkanApproval'])->name('prosesBatalkanApproval')->middleware('checkauth');
    
    Route::prefix('Asisten')->group(function(){
        Route::get('/formUpload', [UploadAsistenController::class, 'formUploadAsisten'])->name('formUploadAsisten')->middleware('checkauth');
        Route::get('/list', [UploadAsistenController::class, 'getListJenisTransaksi'])->name('getListJenisTransaksi')->middleware('checkauth');

        Route::post('prosesUploadIncomingChargebackAsisten', [UploadAsistenController::class, 'prosesUploadIncomingChargebackAsisten'])->name('prosesUploadIncomingChargebackAsisten')->middleware('checkauth');
        Route::post('prosesApproval', [UploadAsistenController::class, 'prosesApprovalAsisten'])->name('prosesApprovalAsisten')->middleware('checkauth');
    });

    Route::prefix('JenisTransaksi')->group(function(){
        Route::get('/list', [JenisTransaksiController::class, 'getListJenisTransaksi'])->name('getListJenisTransaksi')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [JenisTransaksiController::class, 'formUpdateJenisTransaksi'])->name('formUpdateJenisTransaksi')->middleware('checkauth');

        Route::post('prosesUpdateJenisTransaksi', [JenisTransaksiController::class, 'prosesUpdateJenisTransaksi'])->name('prosesUpdateJenisTransaksi')->middleware('checkauth');
        Route::get('/deleteJenisTransaksiById/{id}', [JenisTransaksiController::class, 'deleteJenisTransaksiById'])->name('deleteJenisTransaksiById')->middleware('checkauth');
        Route::post('prosesAddJenisTransaksi', [JenisTransaksiController::class, 'prosesAddJenisTransaksi'])->name('prosesAddJenisTransaksi')->middleware('checkauth');
        Route::delete('/deleteJenisTransaksi', [JenisTransaksiController::class, 'deleteJenisTransaksi'])->name('deleteJenisTransaksi')->middleware('checkauth');
        Route::post('prosesUploadJenisTransaksi', [JenisTransaksiController::class, 'prosesUploadJenisTransaksi'])->name('prosesUploadJenisTransaksi')->middleware('checkauth');
    });

    Route::prefix('InfoStatus')->group(function(){
        Route::get('/list', [InfoStatusController::class, 'getListInfoStatus'])->name('getListInfoStatus')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [InfoStatusController::class, 'formUpdateInfoStatus'])->name('formUpdateInfoStatus')->middleware('checkauth');

        Route::post('prosesUpdateInfoStatus', [InfoStatusController::class, 'prosesUpdateInfoStatus'])->name('prosesUpdateInfoStatus')->middleware('checkauth');
        Route::get('/deleteInfoStatusById/{id}', [InfoStatusController::class, 'deleteInfoStatusById'])->name('deleteInfoStatusById')->middleware('checkauth');
        Route::post('prosesAddInfoStatus', [InfoStatusController::class, 'prosesAddInfoStatus'])->name('prosesAddInfoStatus')->middleware('checkauth');
        Route::delete('/deleteInfoStatus', [InfoStatusController::class, 'deleteInfoStatus'])->name('deleteInfoStatus')->middleware('checkauth');
        Route::post('prosesUploadInfoStatus', [InfoStatusController::class, 'prosesUploadInfoStatus'])->name('prosesUploadInfoStatus')->middleware('checkauth');
    });

    Route::prefix('InfoIncoming')->group(function(){
        Route::get('/list', [InfoIncomingController::class, 'getListInfoIncoming'])->name('getListInfoIncoming')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [InfoIncomingController::class, 'formUpdateInfoIncoming'])->name('formUpdateInfoIncoming')->middleware('checkauth');

        Route::post('prosesUpdateInfoIncoming', [InfoIncomingController::class, 'prosesUpdateInfoIncoming'])->name('prosesUpdateInfoIncoming')->middleware('checkauth');
        Route::get('/deleteInfoIncomingById/{id}', [InfoIncomingController::class, 'deleteInfoIncomingById'])->name('deleteInfoIncomingById')->middleware('checkauth');
        Route::post('prosesAddInfoIncoming', [InfoIncomingController::class, 'prosesAddInfoIncoming'])->name('prosesAddInfoIncoming')->middleware('checkauth');
        Route::delete('/deleteInfoIncoming', [InfoIncomingController::class, 'deleteInfoIncoming'])->name('deleteInfoIncoming')->middleware('checkauth');
        Route::post('prosesUploadInfoIncoming', [InfoIncomingController::class, 'prosesUploadInfoIncoming'])->name('prosesUploadInfoIncoming')->middleware('checkauth');
    });

    Route::prefix('InfoAsisten')->group(function(){
        Route::get('/list', [InfoAsistenController::class, 'getListInfoAsisten'])->name('getListInfoAsisten')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [InfoAsistenController::class, 'formUpdateInfoAsisten'])->name('formUpdateInfoAsisten')->middleware('checkauth');

        Route::post('prosesUpdateInfoAsisten', [InfoAsistenController::class, 'prosesUpdateInfoAsisten'])->name('prosesUpdateInfoAsisten')->middleware('checkauth');
        Route::get('/deleteInfoAsistenById/{id}', [InfoAsistenController::class, 'deleteInfoAsistenById'])->name('deleteInfoAsistenById')->middleware('checkauth');
        Route::post('prosesAddInfoAsisten', [InfoAsistenController::class, 'prosesAddInfoAsisten'])->name('prosesAddInfoAsisten')->middleware('checkauth');
        Route::delete('/deleteInfoAsisten', [InfoAsistenController::class, 'deleteInfoAsisten'])->name('deleteInfoAsisten')->middleware('checkauth');
        Route::post('prosesUploadInfoAsisten', [InfoAsistenController::class, 'prosesUploadInfoAsisten'])->name('prosesUploadInfoAsisten')->middleware('checkauth');
    });

    Route::prefix('InfoAnalis')->group(function(){
        Route::get('/list', [InfoAnalisController::class, 'getListInfoAnalis'])->name('getListInfoAnalis')->middleware('checkauth');
        Route::get('/formUpdate/{id}', [InfoAnalisController::class, 'formUpdateInfoAnalis'])->name('formUpdateInfoAnalis')->middleware('checkauth');

        Route::post('prosesUpdateInfoAnalis', [InfoAnalisController::class, 'prosesUpdateInfoAnalis'])->name('prosesUpdateInfoAnalis')->middleware('checkauth');
        Route::get('/deleteInfoAnalisById/{id}', [InfoAnalisController::class, 'deleteInfoAnalisById'])->name('deleteInfoAnalisById')->middleware('checkauth');
        Route::post('prosesAddInfoAnalis', [InfoAnalisController::class, 'prosesAddInfoAnalis'])->name('prosesAddInfoAnalis')->middleware('checkauth');
        Route::delete('/deleteInfoAnalis', [InfoAnalisController::class, 'deleteInfoAnalis'])->name('deleteInfoAnalis')->middleware('checkauth');
        Route::post('prosesUploadInfoAnalis', [InfoAnalisController::class, 'prosesUploadInfoAnalis'])->name('prosesUploadInfoAnalis')->middleware('checkauth');
    });
});
