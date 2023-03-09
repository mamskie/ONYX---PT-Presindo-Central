<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\JenisArsipController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LoginController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/login', [DataController::class, 'viewLogin']);



//Login
Route::get('/', [LoginController::class, 'viewLogin'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);


//Akses level admin dan user
Route::group(['middleware' => ['auth', 'cekLevel:admin,user']], function () {
    //Menu utama
    Route::get('/login', [DataController::class, 'login']);
    Route::get('/surat', [DataController::class, 'index']);

    Route::get('/view-sm', [ArsipController::class, 'viewSm']);
    Route::get('/view-jenis', [JenisArsipController::class, 'viewJenis']);
});

//Akses admin
Route::group(['middleware' => ['auth', 'cekLevel:admin']], function () {

    Route::get('/view-user', [LoginController::class, 'viewUser']);
    Route::get('/input-user', [LoginController::class, 'inputUser']);
    Route::post('/save-user', [LoginController::class, 'saveUser']);
    Route::get('/edit-user/{id}', [LoginController::class, 'editUser']);
    Route::get('/hapus-user/{id}', [LoginController::class, 'hapusUser']);
    Route::post('/update-user/{id}', [LoginController::class, 'updateUser']);

    Route::get('/input-sm', [ArsipController::class, 'inputSm']);
    Route::post('/save-sm', [ArsipController::class, 'saveSm']);
    Route::get('/edit-sm/{id}', [ArsipController::class, 'editSm']);
    Route::post('/update-sm/{id}', [ArsipController::class, 'updateSm']);
    Route::get('/hapus-sm/{id}', [ArsipController::class, 'hapusSm']);

    Route::get('/input-jenis', [JenisArsipController::class, 'inputJenis']);
    Route::post('/save-jenis', [JenisArsipController::class, 'saveJenis']);
    Route::get('/edit-jenis/{id}', [JenisArsipController::class, 'editJenis']);
    Route::post('/update-jenis/{id}', [JenisArsipController::class, 'updateJenis']);
    Route::get('/hapus-jenis/{id}', [JenisArsipController::class, 'hapusJenis']);
});