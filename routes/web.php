<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PenangananController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

route::get('/',[LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
route::get('/logout',[LoginController::class,'logout'])->name('logout');


route::get('/siswa',[SiswaController::class,'siswa'])->name('siswa');
route::get('/guru',[GuruController::class,'guru'])->name('guru');
route::get('/pelanggaran',[PelanggaranController::class,'pelanggaran'])->name('pelanggaran');
route::get('/penghargaan',[PenghargaanController::class,'penghargaan'])->name('penghargaan');
route::get('/riwayat',[RiwayatController::class,'riwayat'])->name('riwayat');
route::get('/penanganan',[PenangananController::class,'penanganan'])->name('penanganan');



Route::group(['middleware' => ['auth']], function (){
    route::get('/home',[HomeController::class,'index'])->name('home');
});

