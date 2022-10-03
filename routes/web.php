<?php

use App\Http\Controllers\admin_institusi\UnitMasterContoller;
use App\Http\Controllers\admin_monev\MonevKategoriContoller;
use App\Http\Controllers\admin_monev\MonevMasterContoller;
use App\Http\Controllers\admin_siklus\MutuPeriodeContoller;
use App\Http\Controllers\admin_siklus\VersiMasterContoller;
use App\Http\Controllers\admin_spmi\MutuDokumenContoller;
use App\Http\Controllers\admin_spmi\MutuKategoriContoller;
use App\Http\Controllers\admin_spmi\MutuSistemContoller;
use App\Http\Controllers\akreditasi\AkreditasiKategoriController;
use App\Http\Controllers\akreditasi\AkreditasiMasterController;
use App\Http\Controllers\akreditasi\AkreditasiPeriodeController;
use App\Http\Controllers\akreditasi\AsesorController;
use App\Http\Controllers\akreditasi\AuditeController;
use App\Http\Controllers\ami\AmiDetailContoller;
use App\Http\Controllers\ami\AmiMasterContoller;
use App\Http\Controllers\ami\AmiPeriodeContoller;
use App\Http\Controllers\auth\DataUserController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\data_master\DataAlumniController;
use App\Http\Controllers\data_master\DataDosenController;
use App\Http\Controllers\data_master\DataMahasiswaController;
use App\Http\Controllers\data_master\DataMitraController;
use App\Http\Controllers\data_master\DataTendikController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\dokumen_akreditasi\AkreditasiDokumenController;
use App\Http\Controllers\dokumen_induk\IndukMasterContoller;
use App\Http\Controllers\dokumen_monev\MonevDetailContoller;
use App\Http\Controllers\dokumen_monev\MonevDokumenContoller;
use App\Http\Controllers\dokumen_mutu\MutuDetailContoller;
use App\Http\Controllers\dokumen_mutu\MutuMasterContoller;
use App\Http\Controllers\dokumen_spmi\SpmiDetailContoller;
use App\Http\Controllers\dokumen_spmi\SpmiMasterContoller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\kuesioner\KuesionerDetailController;
use App\Http\Controllers\kuesioner\KuesionerMasterController;
use App\Http\Controllers\respon\ResponController;
use App\Http\Controllers\standar_spmi\StandarDetailContoller;
use App\Http\Controllers\standar_spmi\StandarMasterContoller;
use App\Http\Controllers\survey\RekapSurveyController;
use App\Http\Controllers\survey\SurveyAlumniController;
use App\Http\Controllers\survey\SurveyDosenController;
use App\Http\Controllers\survey\SurveyMahasiswaController;
use App\Http\Controllers\survey\SurveyMitraController;
use App\Http\Controllers\survey\SurveyPeriodeController;
use App\Http\Controllers\survey\SurveyTendikController;
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

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');

Route::get('/register_mahasiswa', [RegisterController::class, 'create_mahasiswa'])->name('register_mahasiswa');
Route::get('/register_alumni', [RegisterController::class, 'create_alumni'])->name('register_alumni');
Route::get('/register_mitra', [RegisterController::class, 'create_mitra'])->name('register_mitra');

Route::post('/save_mahasiswa', [RegisterController::class, 'store_mahasiswa'])->name('save_mahasiswa');
Route::post('/save_alumni', [RegisterController::class, 'store_alumni'])->name('save_alumni');
Route::post('/save_mitra', [RegisterController::class, 'store_mitra'])->name('save_mitra');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/buku_spmi', [HomeController::class, 'spmi'])->name('buku_spmi');
Route::get('/dokumen_induk', [HomeController::class, 'induk'])->name('dokumen_induk');
Route::get('/standar_spmi', [HomeController::class, 'standar'])->name('standar_spmi');
Route::get('/pernyataan_spmi/{id}', [HomeController::class, 'pernyataan'])->name('pernyataan_spmi');

Route::post('/request_login', [UserController::class, 'request_login'])->name('request_login');
Route::post('/request_register', [UserController::class, 'request_register'])->name('request_register');

Route::get('/survey_mahasiswa', [SurveyMahasiswaController::class, 'index'])->name('survey_mahasiswa');
Route::get('/list_survey_mahasiswa', [SurveyMahasiswaController::class, 'create'])->name('list_survey_mahasiswa');
Route::post('/list1_survey_mahasiswa', [SurveyMahasiswaController::class, 'store'])->name('list1_survey_mahasiswa');

Route::get('/survey_dosen', [SurveyDosenController::class, 'index'])->name('survey_dosen');
Route::get('/list_survey_dosen', [SurveyDosenController::class, 'create'])->name('list_survey_dosen');
Route::post('/list1_survey_dosen', [SurveyDosenController::class, 'store'])->name('list1_survey_dosen');

Route::get('/survey_tendik', [SurveyTendikController::class, 'index'])->name('survey_tendik');
Route::get('/list_survey_tendik', [SurveyTendikController::class, 'create'])->name('list_survey_tendik');
Route::post('/list1_survey_tendik', [SurveyTendikController::class, 'store'])->name('list1_survey_tendik');

Route::get('/survey_alumni', [SurveyAlumniController::class, 'index'])->name('survey_alumni');
Route::get('/list_survey_alumni', [SurveyAlumniController::class, 'create'])->name('list_survey_alumni');
Route::post('/list1_survey_alumni', [SurveyAlumniController::class, 'store'])->name('list1_survey_alumni');

Route::get('/survey_mitra', [SurveyMitraController::class, 'index'])->name('survey_mitra');
Route::get('/list_survey_mitra', [SurveyMitraController::class, 'create'])->name('list_survey_mitra');
Route::post('/list1_survey_mitra', [SurveyMitraController::class, 'store'])->name('list1_survey_mitra');

Route::post('/create_respon/{id}', [ResponController::class, 'create'])->name('create_respon');
Route::post('/save_respon', [ResponController::class, 'store'])->name('save_respon');
Route::post('/index_respon', [ResponController::class, 'index'])->name('index_respon');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboar', [IndexController::class, 'index'])->name('index');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::resource('/standar_master', StandarMasterContoller::class);
    Route::resource('/standar_detail', StandarDetailContoller::class);

    Route::resource('/spmi', SpmiMasterContoller::class);
    Route::resource('/spmi_dokumen', SpmiDetailContoller::class);

    Route::resource('/induk_master_dokumen', IndukMasterContoller::class);

    Route::get('/unit_dokumen_akreditasi', [AkreditasiDokumenController::class, 'index'])->name('unit_dokumen_akreditasi');
    Route::get('/show_dokumen_akreditasi/{id}', [AkreditasiDokumenController::class, 'show'])->name('show_dokumen_akreditasi');
    Route::get('/create_dokumen_akreditasi/{id}', [AkreditasiDokumenController::class, 'create'])->name('create_dokumen_akreditasi');
    Route::get('/add_dokumen_akreditasi/{id}/{periode}', [AkreditasiDokumenController::class, 'add_dokumen'])->name('add_dokumen_akreditasi');
    Route::post('/save_dokumen_akreditasi', [AkreditasiDokumenController::class, 'store'])->name('save_dokumen_akreditasi');
    Route::get('/edit_dokumen_akreditasi/{id}', [AkreditasiDokumenController::class, 'edit'])->name('edit_dokumen_akreditasi');
    Route::put('/update_dokumen_akreditasi/{id}', [AkreditasiDokumenController::class, 'update'])->name('update_dokumen_akreditasi');
    Route::delete('/delete_dokumen_akreditasi/{id}', [AkreditasiDokumenController::class, 'destroy'])->name('delete_dokumen_akreditasi');
    Route::post('/cari_dokumen_akreditasi', [AkreditasiDokumenController::class, 'cari_dokumen'])->name('cari_dokumen_akreditasi');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/ubah_profile/{id}', [UserController::class, 'ubah_profile'])->name('ubah_profile');
});

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/data_master', [DataMasterController::class, 'index'])->name('data_master');
    Route::post('/simpan_tahun', [DataMasterController::class, 'simpan_tahun'])->name('simpan_tahun');
    Route::post('/simpan_provinsi', [DataMasterController::class, 'simpan_provinsi'])->name('simpan_provinsi');
    Route::post('/simpan_kabupaten', [DataMasterController::class, 'simpan_kabupaten'])->name('simpan_kabupaten');
    Route::get('/edit_tahun/{id}', [DataMasterController::class, 'edit_tahun'])->name('edit_tahun');
    Route::get('/edit_provinsi/{id}', [DataMasterController::class, 'edit_provinsi'])->name('edit_provinsi');
    Route::get('/edit_kabupaten/{id}', [DataMasterController::class, 'edit_kabupaten'])->name('edit_kabupaten');
    Route::put('/update_tahun/{id}', [DataMasterController::class, 'update_tahun'])->name('update_tahun');
    Route::put('/update_provinsi/{id}', [DataMasterController::class, 'update_provinsi'])->name('update_provinsi');
    Route::put('/update_kabupaten/{id}', [DataMasterController::class, 'update_kabupaten'])->name('update_kabupaten');
    Route::get('/show_kabupaten/{id}', [DataMasterController::class, 'show_kabupaten'])->name('show_kabupaten');

    Route::resource('/sistem_mutu', MutuSistemContoller::class);
    Route::resource('/kategori_mutu', MutuKategoriContoller::class);
    Route::resource('/dokumen_mutu', MutuDokumenContoller::class);

    Route::resource('/periode_mutu', MutuPeriodeContoller::class);
    Route::resource('/master_versi', VersiMasterContoller::class);

    Route::resource('/monev_kategori', MonevKategoriContoller::class);
    Route::resource('/monev_master', MonevMasterContoller::class);

    // Route::resource('/akreditasi_kategori', AkreditasiKategoriController::class);
    // Route::get('/akreditasi_master', [AkreditasiMasterController::class, 'index'])->name('akreditasi_master');
    // Route::get('/create_akreditasi_master/{id}', [AkreditasiMasterController::class, 'create'])->name('create_akreditasi_master');
    // Route::post('/save_akreditasi_master', [AkreditasiMasterController::class, 'store'])->name('save_akreditasi_master');
    // Route::get('/edit_akreditasi_master/{id}', [AkreditasiMasterController::class, 'edit'])->name('edit_akreditasi_master');
    // Route::put('/update_akreditasi_master/{id}', [AkreditasiMasterController::class, 'update'])->name('update_akreditasi_master');

    Route::get('/index_unit_kerja', [UnitMasterContoller::class, 'index'])->name('index_unit_kerja');
    Route::get('/add_unit_kerja', [UnitMasterContoller::class, 'create'])->name('add_unit_kerja');
    Route::post('/save_unit_kerja', [UnitMasterContoller::class, 'store'])->name('save_unit_kerja');
    Route::get('/edit_unit_kerja/{id}', [UnitMasterContoller::class, 'edit'])->name('edit_unit_kerja');
    Route::put('/update_unit_kerja/{id}', [UnitMasterContoller::class, 'update'])->name('update_unit_kerja');

    Route::resource('/ami_periode', AmiPeriodeContoller::class);
    Route::get('/show_ami_periode/{id}', [AmiPeriodeContoller::class, 'periode'])->name('show_ami_periode');

    Route::get('/akreditasi_periode', [AkreditasiPeriodeController::class, 'index'])->name('akreditasi_periode');
    Route::get('/show_akreditasi_periode/{id}', [AkreditasiPeriodeController::class, 'show'])->name('show_akreditasi_periode');
    Route::get('/create_akreditasi_periode/{id}', [AkreditasiPeriodeController::class, 'create'])->name('create_akreditasi_periode');
    Route::post('/save_akreditasi_periode', [AkreditasiPeriodeController::class, 'store'])->name('save_akreditasi_periode');
    Route::get('/edit_akreditasi_periode/{id}', [AkreditasiPeriodeController::class, 'edit'])->name('edit_akreditasi_periode');
    Route::put('/update_akreditasi_periode/{id}', [AkreditasiPeriodeController::class, 'update'])->name('update_akreditasi_periode');

    Route::resource('/data_user', DataUserController::class);
    Route::resource('/data_mahasiswa', DataMahasiswaController::class);
    Route::resource('/data_dosen', DataDosenController::class);
    Route::resource('/data_tendik', DataTendikController::class);
    Route::resource('/data_alumni', DataAlumniController::class);
    Route::resource('/data_mitra', DataMitraController::class);
});

Route::group(['middleware' => ['auth', 'role:1,2,4']], function () {
    Route::resource('/mutu_master_dokumen', MutuMasterContoller::class);
    Route::resource('/mutu_detail_dokumen', MutuDetailContoller::class);

    Route::resource('/monev_master_dokumen', MonevDokumenContoller::class);
    Route::get('/monev_detail_dokumen', [MonevDetailContoller::class, 'index'])->name('monev_detail_dokumen');
    Route::get('/show_monev/{id}', [MonevDetailContoller::class, 'show'])->name('show_monev');
    Route::get('/create_monev/{monevid}/standar/{standarid}/{kategori}', [MonevDetailContoller::class, 'create'])->name('create_monev');
    Route::post('/save_monev', [MonevDetailContoller::class, 'store'])->name('save_monev');
    Route::get('/edit_monev/{id}', [MonevDetailContoller::class, 'edit'])->name('edit_monev');
    Route::put('/update_monev/{id}', [MonevDetailContoller::class, 'update'])->name('update_monev');
    Route::delete('/delete_monev/{id}', [MonevDetailContoller::class, 'destroy'])->name('delete_monev');

    Route::resource('/kuesioner', KuesionerMasterController::class);
    Route::resource('/kuesioner_detail', KuesionerDetailController::class);

    Route::resource('/survey_periode', SurveyPeriodeController::class);
    Route::get('/show_periode_survey/{id}', [SurveyPeriodeController::class, 'show_index'])->name('show_periode_survey');
    Route::post('/save_periode_survey', [SurveyPeriodeController::class, 'save_index'])->name('save_periode_survey');
    Route::get('/edit_periode_survey/{id}', [SurveyPeriodeController::class, 'edit_index'])->name('edit_periode_survey');
    Route::put('/update_periode_survey/{id}', [SurveyPeriodeController::class, 'update_index'])->name('update_periode_survey');

    Route::get('/rekap_survey/{id}', [RekapSurveyController::class, 'show'])->name('rekap_survey');
    Route::get('/rekap_survey_kategori/{id}/{kategori}', [RekapSurveyController::class, 'create'])->name('rekap_survey_kategori');
    Route::get('/cetak_survey/{id}', [RekapSurveyController::class, 'edit'])->name('cetak_survey');
    Route::get('/cetak_grafik/{id}', [RekapSurveyController::class, 'index'])->name('cetak_grafik');
    Route::get('/cetak_tabel_kategori/{id}/{kategori}', [RekapSurveyController::class, 'update'])->name('cetak_tabel_kategori');
    Route::get('/cetak_grafik_kategori/{id}/{kategori}', [RekapSurveyController::class, 'destroy'])->name('cetak_grafik_kategori');

    Route::resource('/ami_master', AmiMasterContoller::class);
    Route::post('/save_ami', [AmiMasterContoller::class, 'save_ami'])->name('save_ami');

    Route::resource('/akreditasi_kategori', AkreditasiKategoriController::class);
    Route::get('/akreditasi_master', [AkreditasiMasterController::class, 'index'])->name('akreditasi_master');
    Route::get('/create_akreditasi_master/{id}', [AkreditasiMasterController::class, 'create'])->name('create_akreditasi_master');
    Route::post('/save_akreditasi_master', [AkreditasiMasterController::class, 'store'])->name('save_akreditasi_master');
    Route::get('/edit_akreditasi_master/{id}', [AkreditasiMasterController::class, 'edit'])->name('edit_akreditasi_master');
    Route::put('/update_akreditasi_master/{id}', [AkreditasiMasterController::class, 'update'])->name('update_akreditasi_master');

    Route::get('/akreditasi_audite', [AuditeController::class, 'index'])->name('akreditasi_audite');
    Route::get('/show_akreditasi_audite/{id}', [AuditeController::class, 'show'])->name('show_akreditasi_audite');
    Route::get('/create_akreditasi_audite/{id}', [AuditeController::class, 'create'])->name('create_akreditasi_audite');
    Route::post('/save_akreditasi_audite', [AuditeController::class, 'store'])->name('save_akreditasi_audite');
    Route::get('/edit_akreditasi_audite/{id}', [AuditeController::class, 'edit'])->name('edit_akreditasi_audite');
    Route::put('/update_akreditasi_audite/{id}', [AuditeController::class, 'update'])->name('update_akreditasi_audite');
});

Route::group(['middleware' => ['auth', 'role:1,3,4']], function () {
    Route::get('/ami_detail', [AmiDetailContoller::class, 'index'])->name('ami_detail');
    Route::get('/show_ami_detail/{id}', [AmiDetailContoller::class, 'show'])->name('show_ami_detail');
    Route::get('/create_ami_detail', [AmiDetailContoller::class, 'create'])->name('create_ami_detail');
    Route::post('/save_ami_detail', [AmiDetailContoller::class, 'store'])->name('save_ami_detail');
    Route::get('/edit_ami_detail/{id}', [AmiDetailContoller::class, 'edit'])->name('edit_ami_detail');
    Route::put('/update_ami_detail/{id}', [AmiDetailContoller::class, 'update'])->name('update_ami_detail');
    Route::delete('/delete_ami_detail/{id}', [AmiDetailContoller::class, 'destroy'])->name('delete_ami_detail');

    Route::get('/akreditasi_asesor', [AsesorController::class, 'index'])->name('akreditasi_asesor');
    Route::get('/show_akreditasi_asesor/{id}', [AsesorController::class, 'show'])->name('show_akreditasi_asesor');
    Route::get('/create_akreditasi_asesor/{id}', [AsesorController::class, 'create'])->name('create_akreditasi_asesor');
    Route::put('/save_akreditasi_asesor/{id}', [AsesorController::class, 'store'])->name('save_akreditasi_asesor');
    Route::get('/edit_akreditasi_asesor/{id}', [AsesorController::class, 'edit'])->name('edit_akreditasi_asesor');
});

// Route::resource('/akreditasi_periode', AkreditasiPeriodeController::class);
// Route::put('/update_akreditasi_asesor/{id}', [AsesorController::class, 'update'])->name('update_akreditasi_asesor');
// Route::delete('/delete_akreditasi_asesor/{id}', [AsesorController::class, 'destroy'])->name('delete_akreditasi_asesor');