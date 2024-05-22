<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubkriteriaController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('admin/kriteria', [KriteriaController::class, 'index'])->name('admin.kriteria');
        Route::post('admin/kriteria', [KriteriaController::class, 'store'])->name('admin.kriteria.store');
        Route::put('admin/kriteria/update', [KriteriaController::class, 'update'])->name('admin.kriteria.update');
        Route::delete('admin/kriteria/{id}', [KriteriaController::class, 'destroyKriteria'])->name('admin.kriteria.destroy');
        Route::delete('admin/gameplay/{id}', [KriteriaController::class, 'destroyStrategi'])->name('admin.gameplay.destroy');

        Route::get('admin/subkriteria', [SubkriteriaController::class, 'index'])->name('admin.subkriteria');
        Route::post('admin/subkriteria', [SubkriteriaController::class, 'store'])->name('admin.subkriteria.store');
        Route::put('admin/subkriteria/update', [SubkriteriaController::class, 'update'])->name('admin.subkriteria.update');
        Route::delete('admin/subkriteria/{id}', [SubkriteriaController::class, 'destroy'])->name('admin.subkriteria.destroy');

        Route::get('admin/alternatif', [AlternatifController::class, 'index'])->name('admin.alternatif');
        Route::post('admin/alternatif', [AlternatifController::class, 'store'])->name('admin.alternatif.store');
        Route::put('admin/alternatif/update', [AlternatifController::class, 'update'])->name('admin.alternatif.update');
        Route::delete('admin/alternatif/{id}', [AlternatifController::class, 'destroy'])->name('admin.alternatif.destroy');

        Route::get('admin/perhitungan', [PerhitunganController::class, 'index'])->name('admin.perhitungan');
        Route::post('admin/perhitungan/add', [PerhitunganController::class, 'store'])->name('admin.perhitungan.store');
        Route::get('admin/perhitungan/normalisasi', [PerhitunganController::class, 'normalisasi'])->name('admin.perhitungan.normalisasi');
        Route::get('admin/perhitungan/pembobotan', [PerhitunganController::class, 'pembobotan'])->name('admin.perhitungan.pembobotan');
        Route::get('admin/perhitungan/concordance', [PerhitunganController::class, 'concordance'])->name('admin.perhitungan.concordance');
        Route::get('admin/perhitungan/discordance', [PerhitunganController::class, 'discordance'])->name('admin.perhitungan.discordance');
        Route::get('admin/perhitungan/matrix-concordance', [PerhitunganController::class, 'matrixConcordance'])->name('admin.perhitungan.matrix.concordance');
        Route::get('admin/perhitungan/matrix-discordance', [PerhitunganController::class, 'matrixDiscordance'])->name('admin.perhitungan.matrix.discordance');
        Route::get('admin/perhitungan/matrix-dominance-concordance', [PerhitunganController::class, 'matrixDominanceConcordance'])->name('admin.perhitungan.matrix.dominance.concordance');
        Route::get('admin/perhitungan/matrix-dominance-discordance', [PerhitunganController::class, 'matrixDominanceDiscordance'])->name('admin.perhitungan.matrix.dominance.discordance');
        Route::get('admin/perhitungan/aggregate-matrix-dominance', [PerhitunganController::class, 'aggregateMatrixDominance'])->name('admin.perhitungan.aggregate.matrix.dominance');

        Route::get('admin/hasil', [PerhitunganController::class, 'lessFavorable'])->name('admin.hasil');
    });

    Route::group(['middleware' => 'users'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria');

        Route::get('subkriteria', [SubkriteriaController::class, 'index'])->name('subkriteria');

        Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif');
        Route::post('alternatif', [AlternatifController::class, 'store'])->name('training.store');
        Route::put('alternatif/update', [AlternatifController::class, 'update'])->name('training.update');
        Route::delete('alternatif/{id}', [AlternatifController::class, 'destroy'])->name('training.destroy');
    });
});
