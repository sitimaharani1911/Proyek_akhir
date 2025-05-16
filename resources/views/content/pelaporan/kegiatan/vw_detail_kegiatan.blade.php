@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">Pelaporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Detail</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail Pelaporan Kegiatan Pelaksanaan Hibah</h3>
                        </div>
                        <a href="{{ route('informasi_hibah.index') }}"
                            class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    @forelse ($pelaporans as $pelaporan)
                        <div class="card-body p-9 mt">
                            <div class="row">
                                <!-- Section kiri -->
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Nama Kegiatan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->nama_kegiatan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Ketua Pelaksana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->ketua_pelaksana }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Anggota Pelaksana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->anggota_pelaksana }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Pengajuan Dana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->pengajuan_dana }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Sisa Dana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->sisa_dana }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Tanggal</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->tanggal }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Tempat</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->tempat }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Jumlah Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->jumlah_peserta }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Section Kanan -->
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Absensi Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Tugas</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Kegiatan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Keuangan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Luaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->luaran }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Dampak</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->dampak }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Dokumentasi</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->jumlah_peserta }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Lainnya</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->lainnya) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Bukti Pembayaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->bukti_pembayaran }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Belum Ada Laporan Untuk Kegiatan Ini</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
@endsection
