<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HoldPaymentMerchant\RekeningController;
use App\Http\Controllers\HoldPaymentMerchant\WilayahController;
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

// ================ Authentication Routing ================ //
Route::get('login', [AuthenticationController::class, 'loginPage'])->name('loginPage');

Route::post('/loginProcess', [AuthenticationController::class, 'loginProcess'])->name('loginProcess');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('checkauth');
Route::post('/prosesChangePassword', [AuthenticationController::class, 'prosesChangePassword'])->name('prosesChangePassword');

// ================ Dashboard Routing ================ //
Route::get('dashboardApp', [DashboardController::class, 'dashboardApp'])->name('dashboardApp')->middleware('checkauth');

// ================ User Routing ================ //
Route::prefix('users')->group(function(){
    Route::get('/list', [UsersController::class, 'getListUsers'])->name('getListUsers')->middleware('checkauth');
    Route::get('/formAdd', [UsersController::class, 'formAddUser'])->name('formAddUser')->middleware('checkauth');
    Route::get('/formUpdate/{id}', [UsersController::class, 'formUpdateUser'])->name('formUpdateUser')->middleware('checkauth');

    Route::post('prosesAddUser', [UsersController::class, 'prosesAddUser'])->name('prosesAddUser');
    Route::post('prosesUpdateUser', [UsersController::class, 'prosesUpdateUser'])->name('prosesUpdateUser');
    Route::get('prosesDeleteUser/{id}', [UsersController::class, 'prosesDeleteUser'])->name('prosesDeleteUser');
    Route::post('checkEmailExists', [UsersController::class, 'checkEmailExists'])->name('checkEmailExists');
});



// Route::prefix('MasterRekonMerch')->group(function(){

//     Route::prefix('wilayah')->group(function(){
//         Route::get('/list', [WilayahController::class, 'getListWilayah'])->name('getListWilayah')->middleware('checkauth');
//         Route::get('/formUpdate/{id}', [WilayahController::class, 'formUpdateWilayah'])->name('formUpdateWilayah')->middleware('checkauth');
    
//         Route::post('prosesUpdateWilayah', [WilayahController::class, 'prosesUpdateWilayah'])->name('prosesUpdateWilayah')->middleware('checkauth');
//         Route::get('/deleteWilayahById/{id}', [WilayahController::class, 'deleteWilayahById'])->name('deleteWilayahById')->middleware('checkauth');
//         Route::post('prosesAddWilayah', [WilayahController::class, 'prosesAddWilayah'])->name('prosesAddWilayah')->middleware('checkauth');
//         Route::delete('/deleteWilayah', [WilayahController::class, 'deleteWilayah'])->name('deleteWilayah')->middleware('checkauth');
//         Route::post('prosesUploadWilayah', [WilayahController::class, 'prosesUploadWilayah'])->name('prosesUploadWilayah')->middleware('checkauth');
//     });

//     Route::prefix('rekening')->group(function(){
//         Route::get('/list', [RekeningController::class, 'getListRekening'])->name('getListRekening')->middleware('checkauth');
//             Route::get('/formUpdate/{id}', [RekeningController::class, 'formUpdateRekening'])->name('formUpdateRekening')->middleware('checkauth');
    
//             Route::post('prosesUpdateRekening', [RekeningController::class, 'prosesUpdateRekening'])->name('prosesUpdateRekening')->middleware('checkauth');
//             Route::get('/deleteRekeningById/{id}', [RekeningController::class, 'deleteRekeningById'])->name('deleteRekeningById')->middleware('checkauth');
//             Route::post('prosesAddRekening', [RekeningController::class, 'prosesAddRekening'])->name('prosesAddRekening')->middleware('checkauth');
//             Route::delete('/deleteRekening', [RekeningController::class, 'deleteRekening'])->name('deleteRekening')->middleware('checkauth');
//             Route::post('prosesUploadRekening', [RekeningController::class, 'prosesUploadRekening'])->name('prosesUploadRekening')->middleware('checkauth');
//     });

//     Route::prefix('releasedby')->group(function(){
        
//     });
// });
    
    

