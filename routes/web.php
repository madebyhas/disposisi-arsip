<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Pegawai\Auth\PegawaiLoginController;
use App\Http\Controllers\Pegawai\Auth\PegawaiRegisterController;
use App\Http\Controllers\Pegawai\Surat\SuratmasukController;
use App\Http\Controllers\Pegawai\Surat\ArsipController;
use App\Http\Controllers\Pegawai\Surat\DisposisiController;
use App\Http\Controllers\Pegawai\Surat\CatatanDisposisiController;

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\NewPasswordController;
// use App\Http\Controllers\Auth\PasswordResetLinkController;
// use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\EmailVerificationPromptController;
// use App\Http\Controllers\Auth\EmailVerificationNotificationController;

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
    return view('auth.login');
});

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:pegawai', 'verified'])->name('dashboard');

Route::middleware('auth:pegawai')->group(function () {
    // Route Suratmasuk Pada Dashboard
    Route::resource('suratmasuk', SuratmasukController::class);

    // // Route Disposisi Pada Dashboard
    Route::resource('disposisi', DisposisiController::class);
    // Route download disposisi Pada Dashboard
    Route::get('disposisi/download/{id_dispo}', [DisposisiController::class, 'download'])->name('disposisi.download');
    // Tambahkan route POST untuk menambahkan catatan pada disposisi
    Route::resource('catatan-disposisi', CatatanDisposisiController::class);
    
    // Route arsip Pada Dashboard
    Route::resource('arsip', ArsipController::class);

    // Route add Pegawai Pada Dashboard
    Route::get('pegawai-tampil', [PegawaiRegisterController::class, 'tampil'])->name('tampil.pegawai');
    Route::post('pegawai-tambah', [PegawaiRegisterController::class, 'tambah'])->name('tambah.pegawai');
    Route::resource('pegawai', PegawaiRegisterController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Route Pegawai Auth
Route::middleware('guest')->group(function () {
    // Pegawai View Regist
    Route::get('register', [PegawaiRegisterController::class, 'create'])->name('register');
    // Pegawai Save Regist
    Route::post('register', [PegawaiRegisterController::class, 'store']);
    // Pegawai View Login
    Route::get('login', [PegawaiLoginController::class, 'create'])->name('pegawai.login');
    // Pegawai Login
    Route::post('login', [PegawaiLoginController::class, 'store']);
    // Pegawai Logout
    Route::post('logout', [PegawaiLoginController::class, 'destroy'])
        ->name('logout');
});


