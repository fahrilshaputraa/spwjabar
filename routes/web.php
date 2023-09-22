<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KabController;
use App\Http\Controllers\KcdController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DisdikController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [RedirectController::class, 'cek']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/home', [LoginController::class, 'index']);
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::group(['middleware' => ['auth', 'level:1,2,3,4']], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('UbahPassword');
    Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('UpdatePassword');
    Route::post('/profile/uploadProfile', [ProfileController::class, 'uploadProfile'])->name('UploadProfile');
});

Route::group(['middleware' => ['auth', 'level:1']], function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/disdik', [AdminController::class, 'disdik']);
    Route::get('/admin/kcd', [AdminController::class, 'kcd']);
    Route::get('/admin/sekolah', [AdminController::class, 'sekolah']);

    Route::post('/admin/import/disdik', [AdminController::class, 'importDisdik']);
    Route::post('/admin/import/kcd', [AdminController::class, 'importKcd']);
    Route::post('/admin/import/sekolah', [AdminController::class, 'importSekolah']);

    Route::get('/admin/export/disdik', [AdminController::class, 'exportDisdik']);
    Route::get('/admin/export/kcd', [AdminController::class, 'exportKcd']);
    Route::get('/admin/export/sekolah', [AdminController::class, 'exportSekolah']);

    Route::get('/admin/getUser', [AdminController::class, 'getUser']);
    Route::resource('/admin/store', AdminController::class);
    Route::resource('/admin/update', AdminController::class);
    Route::resource('/admin/delete', AdminController::class);

    Route::get('/admin/getKodeUser', [AdminController::class, 'getKodeUser']);
    Route::get('/admin/search', [AdminController::class, 'search']);
});

Route::group(['middleware' => ['auth', 'level:2']], function () {
    Route::get('/disdik', [DisdikController::class, 'index']);

    Route::post('/disdik/import/kcd', [KcdController::class, 'import']);
    Route::post('/disdik/import/kab', [KabController::class, 'import']);
    Route::post('/disdik/import/sekolah', [SekolahController::class, 'import']);
    Route::post('/disdik/import/siswa', [DisdikController::class, 'importSiswa']);

    Route::get('/disdik/export/kcd', [KcdController::class, 'export']);
    Route::get('/disdik/export/kab', [KabController::class, 'export']);
    Route::get('/disdik/export/sekolah', [SekolahController::class, 'export']);
    Route::get('/disdik/export/siswa', [DisdikController::class, 'exportWirausaha']);
    Route::get('/disdik/export/alumni', [DisdikController::class, 'exportAlumni']);

    Route::get('/disdik/kcd', [DisdikController::class, 'kcd']);
    Route::post('/disdik/kcd/store', [DisdikController::class, 'kcdStore']);
    Route::get('/disdik/getKcd', [DisdikController::class, 'getKcd']);
    Route::post('/disdik/kcd/update', [DisdikController::class, 'kcdUpdate']);
    Route::post('/disdik/kcd/destroy', [DisdikController::class, 'kcdDestroy']);

    Route::get('/disdik/kab', [DisdikController::class, 'kab']);
    Route::post('/disdik/kab/store', [DisdikController::class, 'kabStore']);
    Route::get('/disdik/getKab', [DisdikController::class, 'getKab']);
    Route::post('/disdik/kab/update', [DisdikController::class, 'kabUpdate']);
    Route::post('/disdik/kab/destroy', [DisdikController::class, 'kabDestroy']);

    Route::get('/disdik/sekolah', [DisdikController::class, 'sekolah']);
    Route::post('/disdik/sekolah/store', [DisdikController::class, 'sekolahStore']);
    Route::get('/disdik/getSekolah', [DisdikController::class, 'getSekolah']);
    Route::post('/disdik/sekolah/update', [DisdikController::class, 'sekolahUpdate']);
    Route::post('/disdik/sekolah/destroy', [DisdikController::class, 'sekolahDestroy']);

    Route::get('/disdik/siswa', [DisdikController::class, 'siswa']);
    Route::get('/disdik/getKabs', [DisdikController::class, 'getKabs']);
    Route::get('/disdik/getSekolahs', [DisdikController::class, 'getSekolahs']);
    Route::post('/disdik/siswa/store', [DisdikController::class, 'siswaStore']);
    Route::get('/disdik/getSiswa', [DisdikController::class, 'getSiswa']);
    Route::post('/disdik/siswa/update', [DisdikController::class, 'siswaUpdate']);
    Route::post('/disdik/siswa/destroy', [DisdikController::class, 'siswaDestroy']);

    Route::get('/disdik/alumni', [DisdikController::class, 'alumni']);
    Route::post('/disdik/alumni/store', [DisdikController::class, 'alumniStore']);
    Route::get('/disdik/getAlumni', [DisdikController::class, 'getAlumni']);
    Route::post('/disdik/alumni/update', [DisdikController::class, 'alumniUpdate']);
    Route::post('/disdik/alumni/destroy', [DisdikController::class, 'alumniDestroy']);
});

Route::group(['middleware' => ['auth', 'level:3']], function () {
    Route::get('/kcd', [KcdController::class, 'index']);
    Route::get('/kcd/kab-kot', [KcdController::class, 'kab']);
    Route::get('/kcd/sekolah', [KcdController::class, 'sekolah']);
});

Route::group(['middleware' => ['auth', 'level:4']], function () {
    Route::get('/sekolah', [SekolahController::class, 'index']);
    Route::get('/sekolah/siswa', [SekolahController::class, 'siswa']);
    Route::get('/sekolah/alumni', [SekolahController::class, 'alumni']);

    Route::post('/sekolah/import/siswa', [SekolahController::class, 'importSiswa']);

    Route::get('/sekolah/siswa', [SekolahController::class, 'siswa']);
    Route::get('/sekolah/getKabs', [SekolahController::class, 'getKabs']);
    Route::get('/sekolah/getSekolahs', [SekolahController::class, 'getSekolahs']);
    Route::get('/sekolah/siswa.insert', [SekolahController::class, 'siswaInsert']);
    Route::get('/sekolah/siswa.update.{nisn}', [SekolahController::class, 'siswaEdit']);
    Route::post('/sekolah/siswa/store', [SekolahController::class, 'siswaStore']);
    Route::get('/sekolah/getSiswa', [SekolahController::class, 'getSiswa']);
    Route::post('/sekolah/siswa/update', [SekolahController::class, 'siswaUpdate']);
    Route::post('/sekolah/siswa/destroy', [SekolahController::class, 'siswaDestroy'])->name('deleteSiswa');

    Route::get('/sekolah/alumni', [SekolahController::class, 'alumni']);
    Route::get('/sekolah/alumni.insert', [SekolahController::class, 'alumniInsert']);
    Route::get('/sekolah/alumni.update.{id}', [SekolahController::class, 'alumniEdit']);
    Route::post('/sekolah/alumni/store', [SekolahController::class, 'alumniStore']);
    Route::get('/sekolah/getAlumni', [SekolahController::class, 'getAlumni']);
    Route::post('/sekolah/alumni/update', [SekolahController::class, 'alumniUpdate']);
    Route::post('/sekolah/alumni/destroy', [SekolahController::class, 'alumniDestroy']);

    Route::get('/sekolah/export/siswa', [SekolahController::class, 'exportWirausaha']);
    Route::get('/sekolah/export/alumni', [SekolahController::class, 'exportAlumni']);
});
