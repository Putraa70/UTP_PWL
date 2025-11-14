<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    KegiatanController,
    KegiatanPanitiaController,
    KegiatanSayaController,
    KegiatanProgressController
};

/*
|--------------------------------------------------------------------------
| AUTH (Guest Only)
|--------------------------------------------------------------------------
| - User yang SUDAH login tidak boleh masuk login lagi
| - Middleware guest otomatis redirect ke dashboard jika sudah login
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED AREA
|--------------------------------------------------------------------------
| Semua halaman setelah login wajib melalui middleware auth.
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PANITIA (USER)
    |--------------------------------------------------------------------------
    | Akses: role = PANITIA
    | Cek via Gate can:isPanitia
    */
    Route::middleware('can:isPanitia')->group(function () {
        Route::get('/kegiatan-saya', [KegiatanSayaController::class, 'index'])
            ->name('kegiatan.saya');

        Route::get('/kegiatan-saya/{kegiatan}', [KegiatanSayaController::class, 'show'])
            ->name('kegiatan.saya.show');
    });

    /*
    |--------------------------------------------------------------------------
    | PROGRESS KEGIATAN (Dipakai Admin & Panitia)
    |--------------------------------------------------------------------------
    | Akses create/update/delete diatur oleh Policy (KegiatanProgressPolicy)
    */
    Route::prefix('/kegiatan/{kegiatan}')->group(function () {

        Route::get('/progress', [KegiatanProgressController::class, 'index'])
            ->name('progress.index');

        Route::get('/progress/create', [KegiatanProgressController::class, 'create'])
            ->name('progress.create');

        Route::post('/progress', [KegiatanProgressController::class, 'store'])
            ->name('progress.store');

        Route::get('/progress/{progress}/edit', [KegiatanProgressController::class, 'edit'])
            ->name('progress.edit');

        Route::put('/progress/{progress}', [KegiatanProgressController::class, 'update'])
            ->name('progress.update');

        Route::delete('/progress/{progress}', [KegiatanProgressController::class, 'destroy'])
            ->name('progress.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    | Akses: role = ADMIN
    */
    Route::middleware('can:admin')->group(function () {

        // CRUD Kegiatan
        Route::resource('kegiatan', KegiatanController::class);

        // CRUD Panitia (many-to-many) - shallow supaya URL rapi
        Route::resource('kegiatan.panitia', KegiatanPanitiaController::class)
            ->parameters(['panitia' => 'panitiaKegiatan'])
            ->shallow();
    });
});
