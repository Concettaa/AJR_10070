<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\brosurController;
use App\Http\Controllers\Api\customerController;
use App\Http\Controllers\Api\detailjadwalController;
use App\Http\Controllers\Api\driverController;
use App\Http\Controllers\Api\jadwalkerjaController;
use App\Http\Controllers\Api\mobilController;
use App\Http\Controllers\Api\mobilmitraController;
use App\Http\Controllers\Api\pegawaiController;
use App\Http\Controllers\Api\promoController;
use App\Http\Controllers\Api\roleController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::post('register', [AuthController::Class, 'register']);
    Route::post('login', [AuthController::Class, 'login']);

    Route::get('brosur', [brosurController::class, 'index']);
    Route::get('brosur/{id_brosur}', [brosurController::class, 'show']);
    Route::post('brosur', [brosurController::Class, 'store']);
    Route::put('brosur/{id_brosur}', [brosurController::Class, 'update']);
    Route::delete('brosur/{id_brosur}', [brosurController::Class, 'destroy']);
    // Route::get('brosur', 'Api\brosurController@index');
    // Route::get('brosur/{id}', 'Api\brosurController@show');
    // Route::post('brosur', 'Api\brosurController@store');
    // Route::put('brosur/{id}', 'Api\brosurController@update');
    // Route::delete('brosur/{id}', 'Api\brosurController@destroy');

    Route::get('customer', [customerController::class, 'index']);
    Route::get('customer/{id_customer}', [customerController::class, 'show']);
    Route::post('customer', [customerController::Class, 'store']);
    Route::put('customer/{id_customer}', [customerController::Class, 'update']);
    Route::delete('customer/{id_customer}', [customerController::Class, 'destroy']);
    // Route::get('customer', 'Api\customerController@index');
    // Route::get('customer/{id}', 'Api\customerController@show');
    // Route::post('customer', 'Api\customerController@store');
    // Route::put('customer/{id}', 'Api\customerController@update');
    // Route::delete('customer/{id}', 'Api\customerController@destroy');

    Route::get('detailjadwal', [detailjadwalController::class, 'index']);
    Route::get('detailjadwal/{id_jadwal}', [detailjadwalController::class, 'show']);
    Route::post('detailjadwal', [detailjadwalController::Class, 'store']);
    Route::put('detailjadwal/{id_jadwal}', [detailjadwalController::Class, 'update']);
    Route::delete('detailjadwal/{id_jadwal}', [detailjadwalController::Class, 'destroy']);
    // Route::get('detailjadwal', 'Api\detailjadwalController@index');
    // Route::get('detailjadwal/{id}', 'Api\detailjadwalController@show');
    // Route::post('detailjadwal', 'Api\detailjadwalController@store');
    // Route::put('detailjadwal/{id}', 'Api\detailjadwalController@update');
    // Route::delete('detailjadwal/{id}', 'Api\detailjadwalController@destroy');

    Route::get('driver', [driverController::class, 'index']);
    Route::get('driver/{id_driver}', [driverController::class, 'show']);
    Route::post('driver', [driverController::Class, 'store']);
    Route::put('driver/{id_driver}', [driverController::Class, 'update']);
    Route::delete('driver/{id_driver}', [driverController::Class, 'destroy']);
    // Route::get('driver', 'Api\driverController@index');
    // Route::get('driver/{id}', 'Api\driverController@show');
    // Route::post('driver', 'Api\driverController@store');
    // Route::put('driver/{id}', 'Api\driverController@update');
    // Route::delete('driver/{id}', 'Api\driverController@destroy');

    Route::get('jadwalkerja', [jadwalkerjaController::class, 'index']);
    Route::get('jadwalkerja/{id_jadwal}', [jadwalkerjaController::class, 'show']);
    Route::post('jadwalkerja', [jadwalkerjaController::Class, 'store']);
    Route::put('jadwalkerja/{id_jadwal}', [jadwalkerjaController::Class, 'update']);
    Route::delete('jadwalkerja/{id_jadwal}', [jadwalkerjaController::Class, 'destroy']);
    // Route::get('jadwalkerja', 'Api\jadwalkerjaController@index');
    // Route::get('jadwalkerja/{id}', 'Api\jadwalkerjaController@show');
    // Route::post('jadwalkerja', 'Api\jadwalkerjaController@store');
    // Route::put('jadwalkerja/{id}', 'Api\jadwalkerjaController@update');
    // Route::delete('jadwalkerja/{id}', 'Api\jadwalkerjaController@destroy');

    Route::get('mobil', [mobilController::class, 'index']);
    Route::get('mobil/{id_mobil}', [mobilController::class, 'show']);
    Route::post('mobil', [mobilController::Class, 'store']);
    Route::put('mobil/{id_mobil}', [mobilController::Class, 'update']);
    Route::delete('mobil/{id_mobil}', [mobilController::Class, 'destroy']);
    // Route::get('mobil', 'Api\mobilController@index');
    // Route::get('mobil/{id}', 'Api\mobilController@show');
    // Route::post('mobil', 'Api\mobilController@store');
    // Route::put('mobil/{id}', 'Api\mobilController@update');
    // Route::delete('mobil/{id}', 'Api\mobilController@destroy');

    Route::get('mobilmitra', [mobilmitraController::class, 'index']);
    Route::get('mobilmitra/{no_ktp_pemilik}', [mobilmitraController::class, 'show']);
    Route::post('mobilmitra', [mobilmitraController::Class, 'store']);
    Route::put('mobilmitra/{no_ktp_pemilik}', [mobilmitraController::Class, 'update']);
    Route::delete('mobilmitra/{no_ktp_pemilik}', [mobilmitraController::Class, 'destroy']);
    // Route::get('mobilmitra', 'Api\mobilmitraController@index');
    // Route::get('mobilmitra/{id}', 'Api\mobilmitraController@show');
    // Route::post('mobilmitra', 'Api\mobilmitraController@store');
    // Route::put('mobilmitra/{id}', 'Api\mobilmitraController@update');
    // Route::delete('mobilmitra/{id}', 'Api\mobilmitraController@destroy');

    Route::get('pegawai', [pegawaiController::class, 'index']);
    Route::get('pegawai/{id_pegawai}', [pegawaiController::class, 'show']);
    Route::post('pegawai', [pegawaiController::Class, 'store']);
    Route::put('pegawai/{id_pegawai}', [pegawaiController::Class, 'update']);
    Route::delete('pegawai/{id_pegawai}', [pegawaiController::Class, 'destroy']);
    // Route::get('pegawai', 'Api\pegawaiController','index');
    // Route::get('pegawai/{id_pegawai}', 'Api\pegawaiController@show');
    // Route::post('pegawai', 'Api\pegawaiController@store');
    // Route::put('pegawai/{id_pegawai}', 'Api\pegawaiController@update');
    // Route::delete('pegawai/{id_pegawai}', 'Api\pegawaiController@destroy');
    
    Route::get('promo', [promoController::class, 'index']);
    Route::get('promo/{kode_promo}', [promoController::class, 'show']);
    Route::post('promo', [promoController::Class, 'store']);
    Route::put('promo/{kode_promo}', [promoController::Class, 'update']);
    Route::delete('promo/{kode_promo}', [promoController::Class, 'destroy']);
    // Route::get('promo', 'Api\promoController@index');
    // Route::get('promo/{id}', 'Api\promoController@show');
    // Route::post('promo', 'Api\promoController@store');
    // Route::put('promo/{id}', 'Api\promoController@update');
    // Route::delete('promo/{id}', 'Api\promoController@destroy');

    Route::get('role', [roleController::class, 'index']);
    Route::get('role/{id_role}', [roleController::class, 'show']);
    Route::post('role', [roleController::Class, 'store']);
    Route::put('role/{id_role}', [roleController::Class, 'update']);
    Route::delete('role/{id_role}', [roleController::Class, 'destroy']);
    // Route::get('role', 'Api\roleController@index');
    // Route::get('role/{id}', 'Api\roleController@show');
    // Route::post('role', 'Api\roleController@store');
    // Route::put('role/{id}', 'Api\roleController@update');
    // Route::delete('role/{id}', 'Api\roleController@destroy');

// Route::group(['middleware' => 'auth:api'], function(){
    
// });
