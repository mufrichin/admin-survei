<?php

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


Route::get("error", "Controller@error");

Route::get('/', 'DashboardController@index');

// Route::get('/login_admin', 'AdminController@login_admin');
Route::get('/logout_admin', 'AdminController@logout_admin');
Route::get('/check_session', 'AdminController@check_session');

Route::get('rekapitulasi', 'AdminController@rekapitulasi');
Route::get("rekap/dosen", "DosenController@report");
Route::get("rekap/mahasiswa", "MahasiswaController@report");
route::get("rekap/alumni","AlumniController@report");
Route::get("rekap/tendik", "TendikController@report");
Route::get("rekap/pengguna", "PenggunaController@report");
Route::get("rekap/mitra", "MitraController@report");
Route::get('responden', 'AdminController@responden');
Route::get("responden/dosen", "DosenController@responden");
Route::get("responden/mahasiswa", "MahasiswaController@responden");
Route::get("responden/tendik", "TendikController@responden");
Route::get("responden/alumni", "AlumniController@responden");
Route::get("responden/pengguna", "PenggunaController@responden");
Route::get("responden/mitra", "MitraController@responden");
Route::post("responden/dosen/get_datatable", "DosenController@get_datatable_responden");
Route::post("responden/mahasiswa/get_datatable", "MahasiswaController@get_datatable_responden");
Route::post("responden/tendik/get_datatable", "TendikController@get_datatable_responden");
Route::post("responden/alumni/get_datatable", "AlumniController@get_datatable_responden");
Route::post("responden/pengguna/get_datatable", "PenggunaController@get_datatable_responden");
Route::post("responden/mitra/get_datatable", "MitraController@get_datatable_responden");

//Pertanyaan
Route::get('pertanyaan', "PertanyaanController@index");
Route::get('pertanyaan/tambah', "PertanyaanController@tambah");
Route::post("pertanyaan/getPertanyaan", "PertanyaanController@getPertanyaan");
Route::post("pertanyaan/simpanPertanyaan", "PertanyaanController@simpanPertanyaan");
Route::post("pertanyaan/ubahPertanyaan", "PertanyaanController@ubahPertanyaan");
Route::post("pertanyaan/hapusPertanyaan", "PertanyaanController@hapusPertanyaan");

Route::get("jawaban/dosen/{nip?}/{tgl?}", "DosenController@jawaban");

//Middleware untuk SSO
Route::group(['middleware' => 'samlauth'], function() {
  Route::get('/login_admin', 'AdminController@login_admin');
});