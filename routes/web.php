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
route::get('/',[LoginController::class,'landing'])->name('landing');

route::get('/login',[LoginController::class,'halamanlogin'])->name('login');
route::post('/postlogin',[LoginController::class,'postlogin'])->name('postlogin');
route::get('/logout',[LoginController::class,'logout'])->name('logout');

route::post('/importsiswa',[SiswaController::class,'siswaimportexcel'])->name('siswaimportexcel');


route::get('/pelanggaran',[PelanggaranController::class,'pelanggaran'])->name('pelanggaran');
route::get('/penghargaan',[PenghargaanController::class,'penghargaan'])->name('penghargaan');
route::get('/riwayat',[RiwayatController::class,'riwayat'])->name('riwayat');
route::get('/penanganan',[PenangananController::class,'penanganan'])->name('penanganan');


route::get('/ketpelanggaran',[pelanggaranController::class,'ketpelanggaran'])->name('ketpelanggaran');
route::get('/ketpenghargaan',[PenghargaanController::class,'ketpenghargaan'])->name('ketpenghargaan');
route::get('/ketriwayat',[RiwayatController::class,'ketriwayat'])->name('ketriwayat');
route::get('/ketpenanganan',[PenangananController::class,'ketpenanganan'])->name('ketpenanganan');

// Route::group(['middleware' => ['auth','ceklevel:guru']], function (){
    route::get('/home',[HomeController::class,'index'])->name('home');
    route::get('/siswa',[SiswaController::class,'siswa'])->name('siswa');
    route::get('/guru',[GuruController::class,'guru'])->name('guru');
// });


route::get('/tambah_guru',[GuruController::class,'tambahguru'])->name('tambahguru');
Route::post('/guru/store',[GuruController::class,'store']);
Route::delete('/guru/{id}',[GuruController::class,'destroy'])->name('destroy');
Route::get('/guru/{id}/edit_guru',[GuruController::class,'edit']);
Route::put('/guru/{id}',[GuruController::class,'update']);

route::get('/tambah_plg',[PelanggaranController::class,'tambahplg'])->name('tambahplg');
Route::post('/plg/storeplg',[PelanggaranController::class,'storeplg']);
Route::delete('/pelanggaran/{id_pelanggaran}',[PelanggaranController::class,'destroy1'])->name('destroy1');
Route::get('/pelanggaran/{id_pelanggaran}/edit_pelanggaran',[PelanggaranController::class,'editplg']);
Route::put('/pelanggaran/{id_pelanggaran}',[PelanggaranController::class,'updateplg']);


route::get('/tambah_phg',[PenghargaanController::class,'tambahphg'])->name('tambahphg');
Route::post('/phg/storephg',[PenghargaanController::class,'storephg']);
Route::delete('/penghargaan/{id_penghargaan}',[PenghargaanController::class,'destroy1'])->name('destroy1');
Route::get('/penghargaan/{id_penghargaan}/edit_penghargaan',[PenghargaanController::class,'editphg']);
Route::put('/penghargaan/{id_penghargaan}',[PenghargaanController::class,'updatephg']);

// route::get('/view',[PelanggaranController::class,'view'])->name('view');


route::get('/tambah_ketplg',[PelanggaranController::class,'tambahketplg'])->name('tambahketplg');
Route::post('/ketplg/store',[PelanggaranController::class,'store']);
Route::delete('/ketpelanggaran/{id_kategori_pelanggaran}',[PelanggaranController::class,'destroy'])->name('destroy');
Route::get('/ketpelanggaran/{id_kategori_pelanggaran}/edit_ketpelanggaran',[PelanggaranController::class,'edit']);
Route::put('/ketpelanggaran/{id_kategori_pelanggaran}',[PelanggaranController::class,'update']);


route::get('/tambah_ketpng',[PenangananController::class,'tambahketpng'])->name('tambahketpng');
Route::post('/ketpng/store',[PenangananController::class,'store']);
Route::delete('/ketpenanganan/{id_kategori_penanganan}',[PenangananController::class,'destroy'])->name('destroy');
Route::get('/ketpenanganan/{id_kategori_penanganan}/edit_ketpenanganan',[PenangananController::class,'edit']);
Route::put('/ketpenanganan/{id_kategori_penanganan}',[PenangananController::class,'update']);


route::get('/tambah_ketrwt',[RiwayatController::class,'tambahketrwt'])->name('tambahketrwt');
Route::post('/ketrwt/store',[RiwayatController::class,'store']);
Route::delete('/ketriwayat/{id_kategori_riwayat}',[RiwayatController::class,'destroy'])->name('destroy');
Route::get('/ketriwayat/{id_kategori_riwayat}/edit_ketriwayat',[RiwayatController::class,'edit']);
Route::put('/ketriwayat/{id_kategori_riwayat}',[RiwayatController::class,'update']);



route::get('/tambah_ketphg',[PenghargaanController::class,'tambahketphg'])->name('tambahketphg');
Route::post('/ketphg/store',[PenghargaanController::class,'store']);
Route::delete('/ketpenghargaan/{id_kategori_penghargaan}',[PenghargaanController::class,'destroy'])->name('destroy');
Route::get('/ketpenghargaan/{id_kategori_penghargaan}/edit_ketpenghargaan',[PenghargaanController::class,'edit']);
Route::put('/ketpenghargaan/{id_kategori_penghargaan}',[PenghargaanController::class,'update']);


route::get('/tambah_siswa',[SiswaController::class,'tambahsiswa'])->name('tambahsiswa');
Route::post('/siswa/store',[SiswaController::class,'store']);
Route::delete('/siswa/{id_siswa}',[SiswaController::class,'destroy'])->name('destroy');
Route::get('/siswa/{id_siswa}/edit_siswa',[SiswaController::class,'edit']);
Route::put('/siswa/{id_siswa}',[SiswaController::class,'update']);
route::get('/siswa/search',[SiswaController::class,'search'])->name('search');
route::get('/guru/search',[GuruController::class,'search'])->name('search');
route::get('/siswa/viewimport',[SiswaController::class,'viewimport'])->name('viewimport');




