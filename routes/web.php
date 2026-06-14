<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BibitController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\Admin\ProfilBalaiController;
use App\Http\Controllers\Admin\UserController;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider and all of them will
// | be assigned to the "web" middleware group. Make something great!
// |
// */

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']);
//     Route::resource('bibit', BibitController::class);
// });

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing.index');

Route::get('/profil', [LandingController::class, 'profil'])
    ->name('landing.profil');

Route::get('/visi-misi', [LandingController::class, 'visiMisi'])
    ->name('landing.visi-misi');

Route::get('/pemesanan', [LandingController::class, 'formPemesanan'])
    ->name('landing.pemesanan');

Route::post('/pemesanan', [LandingController::class, 'storePemesanan'])
    ->name('landing.pemesanan.store');

// Route::get('/', [LandingController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // dashboard & exports
    Route::get('/report/create', [DashboardController::class, 'showCreateReportForm'])->name('report.create');
    Route::get('/report/export', [DashboardController::class, 'exportReport'])->name('report.export');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('bibit', BibitController::class);
        Route::resource('monitoring', MonitoringController::class);
        Route::resource('pemesanan', PemesananController::class)
            ->only(['index', 'edit', 'update', 'destroy']);
        Route::get('/profil-balai', [ProfilBalaiController::class, 'index'])
            ->name('profil-balai.index');
        Route::put('/profil-balai', [ProfilBalaiController::class, 'update'])
            ->name('profil-balai.update');
        Route::resource('users', UserController::class)
            ->only(['index', 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

require __DIR__ . '/auth.php';
