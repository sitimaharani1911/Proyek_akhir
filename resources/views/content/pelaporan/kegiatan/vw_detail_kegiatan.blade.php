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
                        <a href="{{route('pelaporan.index')}}" class="text-muted text-hover-primary">Pelaporan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('kegiatan.index')}}" class="text-muted text-hover-primary">Kegiatan</a>
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
                        <h3 class="fw-bold m-0">Detail Kegiatan Pelaksanaan Hibah</h3>
                    </div>
                    <a href="{{ route('informasi_hibah.index') }}"
                        class="btn btn-sm btn-primary align-self-center">Kembali</a>
                </div>
                <div class="card-body p-9">
                    <div class="row">
                        <!-- Section kiri -->
                        <div class="col-lg-6">
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Nama Kegiatan</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Hibah Aset PEDP</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Ketua Pelaksana</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">NFN</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Anggota Pelaksana</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">MSZ, ISM, HNI</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Pengajuan Dana</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">150.000.000</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Sisa Dana</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">17.000.000</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Tanggal</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">04-03-2025</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Tempat</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Politenik Caltex Riau</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Jumlah Peserta</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">10 peserta</span>
                                </div>
                            </div>
                        </div>
                        <!-- Section Kanan -->
                        <div class="col-lg-6">
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Tugas</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span class="fw-semibold">Open </span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Kegiatan</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span class="fw-semibold">Open </span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Keuangan</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span class="fw-semibold">Open </span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Luaran</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Dari kegiatan yang dilaksanakan dihasilkan sebegai berikut</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dampak</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Dihasilkan produk seperti</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dokumentasi</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">drive.com</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Lainnya</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold"></span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Dokumentasi</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">drive.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection