<?php

use App\Http\Controllers\Absen_karyawanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/karyawan', [AdminController::class, 'karyawan']);
Route::get('/absen_karyawan', [AdminController::class, 'absen_karyawan']);
Route::get('/setting_user', [AdminController::class, 'setting_user']);
Route::get('/laporan', [AdminController::class, 'laporan']);

Route::post('/absen-masuk', [Absen_karyawanController::class, 'store'])->name('absen-masuk');
Route::put('/absen-masuk', [Absen_karyawanController::class, 'update'])->name('absen-masuk');

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [AdminController::class, 'dashboard'])->name('dashboard');
