<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InformasiHibahController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\ListKegiatanController;
use App\Http\Controllers\MonevController;
use App\Http\Controllers\MonevKegiatanController;
use App\Http\Controllers\PengajuanDanaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProgresProposalController;
use App\Http\Controllers\TtdBerkasController;
use App\Http\Controllers\RabController;


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
            Route::get('/apply/{id}', [ProposalController::class, 'apply'])->name('proposal.apply');
        });

        // List Kegiatan
        Route::prefix('list-kegiatan')->group(function () {
            Route::get('/', [ListKegiatanController::class, 'index'])->name('list-kegiatan.index');
            Route::get('/data', [ListKegiatanController::class, 'listKegiatan'])->name('list-kegiatan.data');
        });

        // Monev Kegiatan
        Route::prefix('monev-kegiatan')->group(function () {
            Route::get('/', [MonevKegiatanController::class, 'index'])->name('monev-kegiatan.index');
            Route::get('/data', [MonevKegiatanController::class, 'listKegiatan'])->name('monev-kegiatan.data');
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
            Route::get('/hasil-monev', [KegiatanController::class, 'hasilMonev'])->name('kegiatan.hasilMonev');
        });
        // Pengajuan Dana
        Route::prefix('pengajuan-dana')->group(function () {
            Route::get('/', [PengajuanDanaController::class, 'index'])->name('pengajuan_dana.index');
            Route::get('/show/id', [PengajuanDanaController::class, 'show'])->name('pengajuan_dana.show');
            Route::get('/edit/id', [PengajuanDanaController::class, 'edit'])->name('pengajuan_dana.edit');
            Route::get('/tambah-pengajuan-dana', [PengajuanDanaController::class, 'create'])->name('pengajuan_dana.tambah');
            Route::get('/pengajuan-dana-kegaiatan', [PengajuanDanaController::class, 'dataKegiatan'])->name('pengajuan_dana.kegiatan');
        });
        // Monev
        Route::prefix('monev')->group(function () {
            Route::get('/', [MonevController::class, 'index'])->name('monev.index');
            Route::get('/show/id', [MonevController::class, 'show'])->name('monev.show');
            Route::get('/edit/id', [MonevController::class, 'edit'])->name('monev.edit');
            Route::get('/tambah-pengajuan-dana', [MonevController::class, 'create'])->name('monev.tambah');
            Route::get('/monev-kegiatan', [MonevController::class, 'dataKegiatan'])->name('monev.kegiatan');
            Route::get('/review-laporan', [MonevController::class, 'reviewLaporan'])->name('monev.review');
            Route::get('/detail-dokumen', [MonevController::class, 'detailDokumen'])->name('monev.dokumen');
        });
        // Verifikasi Monev Ketua PIU
        Route::prefix('piu')->group(function () {
            Route::get('/', [MonevController::class, 'monevPiu'])->name('piu.index');
            Route::get('/kegiatan', [MonevController::class, 'monevPiuKegiatan'])->name('piu.kegiatan');
            Route::get('/verifikasi', [MonevController::class, 'monevPiuReview'])->name('piu.review');
        });
        // Verifikasi Monev Pimpinan
        Route::prefix('pimpinan')->group(function () {
            Route::get('/', [MonevController::class, 'monevPimpinan'])->name('pimpinan.index');
            Route::get('/kegiatan', [MonevController::class, 'monevPimpinanKegiatan'])->name('pimpinan.kegiatan');
            Route::get('/verifikasi', [MonevController::class, 'monevPimpinanReview'])->name('pimpinan.review');
        });
        // Laporan Keuangan
        Route::prefix('laporan-keuangan')->group(function () {
            Route::get('/', [LaporanKeuanganController::class, 'index'])->name('laporan-keuangan.index');
            Route::get('/show/id', [LaporanKeuanganController::class, 'show'])->name('laporan-keuangan.show');
            Route::get('/edit/id', [LaporanKeuanganController::class, 'edit'])->name('laporan-keuangan.edit');
            Route::get('/kegiatan', [LaporanKeuanganController::class, 'dataKegiatan'])->name('laporan-keuangan.kegiatan');
            Route::get('/review', [LaporanKeuanganController::class, 'reviewLaporan'])->name('laporan-keuangan.review');
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

        // RAB
        Route::prefix('rab')->group(function () {
            Route::get('/', [RabController::class, 'index'])->name('rab.index');
            Route::get('/show/{id}', [RabController::class, 'show'])->name('rab.show');
            Route::get('/edit/{id}', [RabController::class, 'edit'])->name('rab.edit');
        });

        // Ttd Berkas
        Route::prefix('ttd_berkas')->group(function () {
            Route::get('/', [TtdBerkasController::class, 'index'])->name('ttd_berkas.index');
            Route::get('/show/{id}', [TtdBerkasController::class, 'show'])->name('ttd_berkas.show');
        });

        // Logout
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    }
);
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/select-role', [RoleController::class, 'selectRole'])->name('select.role');
Route::post('/set-role', [RoleController::class, 'setRole'])->name('set.role');
