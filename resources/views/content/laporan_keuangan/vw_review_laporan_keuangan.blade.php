@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Review Laporan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('laporan-keuangan.index')}}" class="text-muted text-hover-primary">Laporan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('laporan-keuangan.kegiatan')}}" class="text-muted text-hover-primary">Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('laporan-keuangan.review')}}" class="text-muted text-hover-primary">Review</a>
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
        <div class="card mb-5 mb-xl-8">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Review Laporan</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="row" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">

                    <!-- Section Full Width -->
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kegiatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ketua Pelaksana <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Ketua Pelaksana" name="ketua_pelaksana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Laporan Keuangan <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="laporan_keuangan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Bukti Pembayaran<span class="text-danger">*</span></label>
                            <input type="url" class="form-control" placeholder="https://drive.com" name="bukti_pembayaran" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pengajuan Dana <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Pengajuan Dana" name="pengajuan_dana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sisa Dana <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Sisa Dana" name="sisa_dana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Serapan Dana <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Serapan Dana" name="serapan_dana" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Catatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Catatan" name="catatan" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Status" name="status" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Auditor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Auditor" name="auditor" />
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <button type="button" onclick="save()" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection