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
                            <a class="text-muted text-hover-primary">Data Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">List Kegiatan</a>
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
                        <a class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    <div class="card-body p-9">
                        <div class="row">
                            <!-- Section kiri -->
                            <div class="col-lg-6">
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Nama Kegiatan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->nama_kegiatan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Ketua Pelaksana</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->proposal->ketua_hibah }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Jenis Hibah</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->jenis_hibah }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">program_studi</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->program_studi }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Jenis Aktivitas</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->jenis_aktivitas }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Jumlah Luaran</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->jumlah_luaran }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Satuan Luaran</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->satuan_luaran }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Status Pelaksanaan Kegiatan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->status_pelaksanaan_kegiatan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Total Pengajuan Anggaran</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->total_pengajuan_anggaran }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Section Kanan -->
                            <div class="col-lg-6">
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Total Penggunaan Anggaran</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->total_penggunaan_anggaran }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Tanggal Awal</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->tanggal_awal }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Tanggal Akhir</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->tanggal_akhir }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Rentang Pengerjaan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->rentang_pengerjaan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Panita Pengerjaan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->panitia_pengerjaan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Rincian Jumlah Peserta</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->rincian_jumlah_peserta }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Tempat Pelaksanaan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <span class="fw-semibold">{{ $kegiatan->tempat_pelaksanaan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Kerja</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <a href="{{ asset('storage/' . $kegiatan->surat_kerja) }}" target="_blank"
                                            class="text-primary">
                                            <span class="fw-semibold">Open </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Tugas</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <a href="{{ asset('storage/' . $kegiatan->surat_tugas) }}" target="_blank"
                                            class="text-primary">
                                            <span class="fw-semibold">Open </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label class="col-md-4 fw-bold fs-6 text-gray-800">Template Laporan</label>
                                    <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                    <div class="col-md-7">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        @if ($kegiatan->template_laporan)
                                            <a href="{{ asset('storage/' . $kegiatan->template_laporan) }}"
                                                target="_blank" class="text-primary">Download</a>
                                        @else
                                            <span class="text-danger">Belum ada template</span>
                                        @endif
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
