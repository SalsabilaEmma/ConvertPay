<?php

use App\Helpers\GetterSetter;
use App\Http\Controllers\logs\ChipLogController;
use App\Http\Controllers\logs\TransaksiLogController;
use App\Http\Controllers\master\BankController;
use App\Http\Controllers\master\ChipsController;
use App\Http\Controllers\master\ConfigController;
use App\Http\Controllers\master\NotificationController;
use App\Http\Controllers\master\PromoController;
use App\Http\Controllers\master\ProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('get_faktur', function (Request $request) {
    $kode = $request->input('kode');
    $len = $request->input('len');
    $response = GetterSetter::getLastKode($kode, $len);
    return response()->json($response);
});
Route::post('set_faktur', function (Request $request) {
    $kode = $request->input('kode');
    $response = GetterSetter::setLastKode($kode);
    return response()->json($response);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// ************************************* AUTH *********************************************

// ************************************* MASTER *********************************************
// ------------------------------------------------------------------------------------------< ROUTE CHIPS >
Route::post('chips/get', [ChipsController::class, 'data']);
Route::post('chips/store', [ChipsController::class, 'store']);
Route::post('chips/update', [ChipsController::class, 'update']);
Route::post('chips/delete', [ChipsController::class, 'delete']);
// ------------------------------------------------------------------------------------------< ROUTE BANK >
Route::post('bank/get', [BankController::class, 'data']);
Route::post('bank/store', [BankController::class, 'store']);
Route::post('bank/update', [BankController::class, 'update']);
Route::post('bank/delete', [BankController::class, 'delete']);
// ------------------------------------------------------------------------------------------< ROUTE CONFIG >
Route::post('config/get_alldbconfig', [ConfigController::class, 'getAllDBConfig']);
Route::post('config/get_dbconfig', [ConfigController::class, 'getDBConfig']);
Route::post('config/set_dbconfig', [ConfigController::class, 'setDBConfig']);
// ------------------------------------------------------------------------------------------< ROUTE NOTIFICATION >
Route::post('notif/get', [NotificationController::class, 'data']);
Route::post('notif/store', [NotificationController::class, 'store']);
Route::post('notif/update', [NotificationController::class, 'update']);
Route::post('notif/delete', [NotificationController::class, 'delete']);
// ------------------------------------------------------------------------------------------< ROUTE PROMO >
Route::post('promo/get', [PromoController::class, 'data']);
Route::post('promo/store', [PromoController::class, 'store']);
Route::post('promo/update', [PromoController::class, 'update']);
Route::post('promo/delete', [PromoController::class, 'delete']);
// ------------------------------------------------------------------------------------------< ROUTE PROVIDER >
Route::post('provider/get', [ProviderController::class, 'data']);
Route::post('provider/store', [ProviderController::class, 'store']);
Route::post('provider/update', [ProviderController::class, 'update']);
Route::post('provider/delete', [ProviderController::class, 'delete']);


// ************************************* LOGS *********************************************
// ------------------------------------------------------------------------------------------< ROUTE TRANSAKSI LOG >
Route::post('transaksi_log/get', [TransaksiLogController::class, 'data']);
Route::post('transaksi_log/store', [TransaksiLogController::class, 'store']);
Route::post('transaksi_log/update', [TransaksiLogController::class, 'update']);
Route::post('transaksi_log/delete', [TransaksiLogController::class, 'delete']);
// ------------------------------------------------------------------------------------------< ROUTE CHIP LOG >
Route::post('chip_log/get', [ChipLogController::class, 'data']);
Route::post('chip_log/store', [ChipLogController::class, 'store']);
Route::post('chip_log/update', [ChipLogController::class, 'update']);
Route::post('chip_log/delete', [ChipLogController::class, 'delete']);
