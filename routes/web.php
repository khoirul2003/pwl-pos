<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\AuthorizeUser;
use App\Models\LevelModel;

Route::pattern('id', '[0-9]+'); // Ensures the {id} parameter must be numeric

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Define all routes that require authentication here
    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']); // Menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']); // Menampilkan data user dalam bentuk JSON untuk datatables
        Route::get('/create', [UserController::class, 'create']); // Menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']); // Menyimpan data user baru
        Route::get('create_ajax', [UserController::class, 'create_ajax']);
        Route::post('ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}', [UserController::class, 'show']); // Menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); // Menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']); // Menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']); // Menghapus data user
    });

    Route::middleware([AuthorizeUser::class . ':ADM'])->prefix('level')->group(function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });


    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/{id}', [KategoriController::class, 'update']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
    });


    Route::middleware([AuthorizeUser::class . ':ADM,MNG'])->prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });

    Route::group(['prefix' => 'stok'], function () {
        Route::get('/', [StokController::class, 'index']);
        Route::post('/list', [StokController::class, 'list']);
        Route::get('/create', [StokController::class, 'create']);
        Route::post('/', [StokController::class, 'store']);
        Route::get('/{id}', [StokController::class, 'show']);
        Route::get('/{id}/edit', [StokController::class, 'edit']);
        Route::put('/{id}', [StokController::class, 'update']);
        Route::delete('/{id}', [StokController::class, 'destroy']);
    });

    Route::group(['prefix' => 'penjualan-detail'], function () {
        Route::get('/', [PenjualanDetailController::class, 'index']);
        Route::post('/list', [PenjualanDetailController::class, 'list']);
        Route::get('/create', [PenjualanDetailController::class, 'create']);
        Route::post('/', [PenjualanDetailController::class, 'store']);
        Route::get('/{id}', [PenjualanDetailController::class, 'show']);
        Route::get('/{id}/edit', [PenjualanDetailController::class, 'edit']);
        Route::put('/{id}', [PenjualanDetailController::class, 'update']);
        Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']);
    });
});
