<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiHibahController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProgresProposalController;


Route::get('/', [AuthController::class, 'login'])->name('login');

Route::middleware(['custom-auth'])->group(
    function () {
        // Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        });

        // Informasi Hibah
        Route::prefix('informasi_hibah')->group(function () {
            Route::get('/', [InformasiHibahController::class, 'index'])->name('informasi_hibah.index');
            Route::get('/show/{id}', [InformasiHibahController::class, 'show'])->name('informasi_hibah.show');
            Route::get('/edit/{id}', [InformasiHibahController::class, 'edit'])->name('informasi_hibah.edit');
        });

        // Proposal
        Route::prefix('proposal')->group(function () {
            Route::get('/', [ProposalController::class, 'index'])->name('proposal.index');
            Route::get('/show/{id}', [ProposalController::class, 'show'])->name('proposal.show');
            Route::get('/edit/{id}', [ProposalController::class, 'edit'])->name('proposal.edit');
        });

        // Pelaporan
        Route::prefix('pelaporan')->group(function () {
            Route::get('/', [PelaporanController::class, 'index'])->name('pelaporan.index');
            Route::get('/show/{id}', [PelaporanController::class, 'show'])->name('pelaporan.show');
            Route::get('/edit/{id}', [PelaporanController::class, 'edit'])->name('pelaporan.edit');
            Route::get('/input-dokumen', [PelaporanController::class, 'inputDocument'])->name('pelaporan.input_dokumen');
        });

        // Kegiatan
        Route::prefix('kegiatan')->group(function () {
            Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan.index');
            Route::get('/show/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
            Route::get('/edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
            Route::get('/tambah-kegiatan', [KegiatanController::class, 'create'])->name('kegiatan.tambah');
        });

        // User
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::post('/store_role', [UserController::class, 'store_role'])->name('user.store_role');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::get('/get_role/{id}', [UserController::class, 'get_role'])->name('user.get_role');
            Route::post('/update', [UserController::class, 'update'])->name('user.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::post('/data', [UserController::class, 'data'])->name('user-list');
        });

        // Progres Proposal
        Route::prefix('progres_proposal')->group(function () {
            Route::get('/', [ProgresProposalController::class, 'index'])->name('progres_proposal.index');
        });

        // Logout
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    }
);
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/select-role', [RoleController::class, 'selectRole'])->name('select.role');
Route::post('/set-role', [RoleController::class, 'setRole'])->name('set.role');
