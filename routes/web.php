<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\DigitalKontenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('home');
});

// Rute untuk autentikasi
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Rute untuk Home
Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk IT yang menggunakan middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::resource('it', ItController::class);
    Route::resource('user', UserController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('digitalkonten', DigitalKontenController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('finance', FinanceController::class);
    Route::resource('fundraising', FundraisingController::class);
    Route::resource('marketing', MarketingController::class);
    Route::resource('mitra', MitraController::class);
    Route::post('it/uploadChunks', [ItController::class, 'uploadChunks'])->name('it.uploadChunks');
});

