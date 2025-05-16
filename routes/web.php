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
use App\Http\Controllers\PengesahanBerkasController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\SkemaHibahController;
use App\Http\Controllers\VerifikasiStatus;


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
            Route::post('/data', [InformasiHibahController::class, 'data'])->name('informasi_hibah-list');
            Route::get('/show/{id}', [InformasiHibahController::class, 'show'])->name('informasi_hibah.show');
            Route::post('/store', [InformasiHibahController::class, 'store'])->name('informasi_hibah.store');
            Route::get('/edit/{id}', [InformasiHibahController::class, 'edit'])->name('informasi_hibah.edit');
            Route::post('/update', [InformasiHibahController::class, 'update'])->name('informasi_hibah.update');
            Route::delete('/{id}', [InformasiHibahController::class, 'destroy'])->name('informasi_hibah.destroy');
        });

        // Proposal
        Route::prefix('proposal')->group(function () {
            Route::get('/', [ProposalController::class, 'index'])->name('proposal.index');
            Route::post('/data', [ProposalController::class, 'data'])->name('proposal-list');
            Route::get('/show/{id}', [ProposalController::class, 'show'])->name('proposal.show');
            Route::get('/apply/{id}', [ProposalController::class, 'apply'])->name('proposal.apply');
            Route::post('/store', [ProposalController::class, 'store'])->name('proposal.store');
            Route::get('/edit/{id}', [ProposalController::class, 'edit'])->name('proposal.edit');
            Route::post('/update', [ProposalController::class, 'update'])->name('proposal.update');
            Route::post('/update_nilai', [ProposalController::class, 'update_nilai'])->name('proposal.update_nilai');
            Route::delete('/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
        });

        // List Kegiatan
        Route::prefix('list-kegiatan')->group(function () {
            Route::get('/', [ListKegiatanController::class, 'index'])->name('list-kegiatan.index');
            Route::get('/{proposal_id}', [ListKegiatanController::class, 'listKegiatan'])->name('list-kegiatan.data');
            Route::get('/{proposal_id}/tambah', [ListKegiatanController::class, 'create'])->name('list-kegiatan.tambah');
            Route::post('/list-kegiatan/{proposal_id}/tambah', [ListKegiatanController::class, 'store'])->name('list-kegiatan.store');
            Route::get('/{id}/edit', [ListKegiatanController::class, 'edit'])->name('list-kegiatan.edit');
            Route::put('/{id}/update', [ListKegiatanController::class, 'update'])->name('list-kegiatan.update');
            Route::delete('/{id}/destroy', [ListKegiatanController::class, 'destroy'])->name('list-kegiatan.destroy');
        });

        // Monev Kegiatan
        Route::prefix('monev-kegiatan')->group(function () {
            Route::get('/', [MonevKegiatanController::class, 'index'])->name('monev-kegiatan.index');
            Route::get('/data', [MonevKegiatanController::class, 'listKegiatan'])->name('monev-kegiatan.data');
        });

        // Pelaporan
        Route::prefix('pelaporan')->group(function () {
            Route::get('/', [PelaporanController::class, 'index'])->name('pelaporan.index');
            Route::get('/show/{list_kegiatan_id}', [PelaporanController::class, 'show'])->name('pelaporan.show');
            Route::get('/edit/{id}', [PelaporanController::class, 'edit'])->name('pelaporan.edit');
            Route::get('/input-dokumen/{informasi_hibah_id}', [PelaporanController::class, 'inputDocument'])->name('pelaporan.input_dokumen');
            Route::post('/input-dokumen/{informasi_hibah_id}/store', [PelaporanController::class, 'inputDocumentStore'])->name('pelaporan.input_dokumen.store');
        });

        // Kegiatan
        Route::prefix('kegiatan')->group(function () {
            Route::get('/{proposal_id}', [KegiatanController::class, 'index'])->name('kegiatan.index');
            Route::get('/buat-laporan/{list_kegiatan_id}', [KegiatanController::class, 'create'])->name('kegiatan.tambah');
            Route::post('/buat-laporan/{list_kegiatan_id}/create', [KegiatanController::class, 'store'])->name('kegiatan.store');
            Route::get('/show/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
            Route::get('/edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
            Route::get('/hasil-monev', [KegiatanController::class, 'hasilMonev'])->name('kegiatan.hasilMonev');
            Route::get('/review-keuangan/{list_kegiatan_id}', [KegiatanController::class, 'reviewLaporan'])->name('kegiatan.review_keuangan');
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
            Route::get('/monev-kegiatan/{proposal_id}', [MonevController::class, 'dataKegiatan'])->name('monev.kegiatan');
            Route::get('/review-laporan/{list_kegiatan_id}', [MonevController::class, 'reviewLaporan'])->name('monev.review');
            Route::get('/detail-dokumen/{informasi_hibah_id}', [MonevController::class, 'detailDokumen'])->name('monev.dokumen');
        });
        // Verifikasi Monev Ketua PIU
        Route::prefix('piu')->group(function () {
            Route::get('/', [MonevController::class, 'monevPiu'])->name('piu.index');
            Route::get('/kegiatan/{proposal_id}', [MonevController::class, 'monevPiuKegiatan'])->name('piu.kegiatan');
            Route::get('/verifikasi/{list_kegiatan_id}', [MonevController::class, 'monevPiuReview'])->name('piu.review');
            Route::post('/verifikasi/{pelaporan_id}/store', [MonevController::class, 'storePIU'])->name('piu.store');
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
            Route::get('/kegiatan/{proposal_id}', [LaporanKeuanganController::class, 'dataKegiatan'])->name('laporan-keuangan.kegiatan');
            Route::get('/review/{list_kegiatan_id}', [LaporanKeuanganController::class, 'reviewLaporan'])->name('laporan-keuangan.review');
            Route::post('/review/{pelaporan_id}/store', [LaporanKeuanganController::class, 'store'])->name('laporan-keuangan.store');
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
            Route::post('/data', [ProgresProposalController::class, 'data'])->name('progres_proposal-list');
        });

        // RAB
        Route::prefix('rab')->group(function () {
            Route::get('/', [RabController::class, 'index'])->name('rab.index');
            Route::post('/data', [RabController::class, 'data'])->name('rab-list');
            Route::get('/show/{id}', [RabController::class, 'show'])->name('rab.show');
            Route::post('/store', [RabController::class, 'store'])->name('rab.store');
            Route::get('/edit/{id}', [RabController::class, 'edit'])->name('rab.edit');
            Route::post('/update', [RabController::class, 'update'])->name('rab.update');
            Route::delete('/{id}', [RabController::class, 'destroy'])->name('rab.destroy');
        });

        // Ttd Berkas
        Route::prefix('pengesahan_berkas')->group(function () {
            Route::get('/', [PengesahanBerkasController::class, 'index'])->name('pengesahan_berkas.index');
            Route::get('/show/{id}', [PengesahanBerkasController::class, 'show'])->name('pengesahan_berkas.show');
            Route::post('/data', [PengesahanBerkasController::class, 'data'])->name('pengesahan_berkas-list');
            Route::post('/upload_berkas', [PengesahanBerkasController::class, 'upload_berkas'])->name('pengesahan_berkas.upload_berkas');
        });

        // Skema Hibah
        Route::prefix('skema_hibah')->group(function () {
            Route::get('/', [SkemaHibahController::class, 'index'])->name('skema_hibah.index');
            Route::post('/data', [SkemaHibahController::class, 'data'])->name('skema_hibah-list');
            Route::post('/store', [SkemaHibahController::class, 'store'])->name('skema_hibah.store');
            Route::get('/edit/{id}', [SkemaHibahController::class, 'edit'])->name('skema_hibah.edit');
            Route::post('/update', [SkemaHibahController::class, 'update'])->name('skema_hibah.update');
            Route::delete('/{id}', [SkemaHibahController::class, 'destroy'])->name('skema_hibah.destroy');
        });

        // Logout
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        // Verifikasi Status
        Route::post('verifikasi-status', VerifikasiStatus::class);
    }
);
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/select-role', [RoleController::class, 'selectRole'])->name('select.role');
Route::post('/set-role', [RoleController::class, 'setRole'])->name('set.role');
