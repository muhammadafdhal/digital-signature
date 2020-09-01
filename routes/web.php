<?php

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

Route::get('/', function () {
    return view('template/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dokumen', 'DokumenController@index')->name('dokumen');
Route::post('/dokumen/tambah/save', 'DokumenController@store');
Route::get('/dokumen/ttd/{dk_id}', 'DokumenController@tandaTangan');
Route::post('/dokumen/wasiat/save', 'DokumenController@inputDataWasiat');
Route::get('/dokumen/anak/{dk_id}', 'DokumenController@createDataAnak');
Route::post('/dokumen/anak/{dk_id}/save', 'DokumenController@inputDataAnak');
Route::get('/dokumen/cetak_wasiat/{dk_id}', 'DokumenController@cetak_surat');

Route::get('/verifikasi','DokumenController@verifikasi');
Route::post('/verifikasi/save', 'DokumenController@verifyDokumen');

Route::get('/valid-unvalid', 'SignatureController@index')->name('signature');
// Route::post('signature', 'SignatureController@store');

//tanda-tangan
Route::get('/signature/{dk_id}', 'SignatureController@index');
Route::post('/signature/{id}/save', 'SignatureController@store');

Route::get('/digital-signature', function() {
    return view('kunci.signature');
});


Route::get('/user', 'UserController@index');
Route::post('/user/tambah/save', 'UserController@store');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/edit/{id}/save', 'UserController@update');
Route::delete('/user/delete/{id}', 'UserController@destroy');

Route::get('/pembangkit-kunci', function(){
    return view('kunci.index');
});