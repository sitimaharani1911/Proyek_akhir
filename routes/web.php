<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiHibahController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PelaporanController;

Route::get('/', function () {
    return view('content.auth.login');
});

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
});