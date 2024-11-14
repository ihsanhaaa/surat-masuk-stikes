<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuratArsipController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratPentingController;
use App\Http\Controllers\SuratSKController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PagesController::class, 'index']);

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    
    Route::resource('/home/surat-masuk', SuratMasukController::class);
    
    Route::resource('/home/surat-keluar', SuratKeluarController::class);
    
    Route::resource('/home/surat-arsip', SuratArsipController::class);
    
    Route::resource('/home/surat-penting', SuratPentingController::class);
    
    Route::resource('/home/surat-sk', SuratSKController::class);
    
    Route::get('/surat/{bulan}', [SuratController::class, 'showSuratByBulan'])->name('surat.bulan');

    // profile
    Route::get('/home/profil-saya/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/home/profil/edit/{id}', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('/home/update-profil/{id}', [ProfileController::class, 'updateProfil'])->name('profile.update');
    Route::post('change-profile-picture',[ProfileController::class,'updatePicture'])->name('profilPictureUpdate');
    Route::post('user-change-profile-picture/{id}',[ProfileController::class,'userUpdatePicture'])->name('userPictureUpdate');

    Route::patch('/home/update-password/{id}', [ProfileController::class, 'updatePassword'])->name('update-password');

    Route::resource('/home/roles', RoleController::class);

    Route::resource('/home/users', UserController::class);
    
});
