@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Tambah List Kegiatan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="list-kegiatan.index" class="text-muted text-hover-primary">Data Hibah</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('list-kegiatan.data')}}" class="text-muted text-hover-primary">List Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('list-kegiatan.tambah')}}" class="text-muted text-hover-primary">Tambah Kegiatan</a>
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
                    <span class="card-label fw-bold fs-3 mb-1">Tambah List Kegiatan</span>
                </h3>
            </div>
            <div class="card-body py-3">
                <form class="row g-3" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jenis Hibah<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Jenis Hibah" name="jenis_hibah" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Program Studi<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="program_studi" placeholder="Input Program Studi" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jensi Aktivitas<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="jenis Aktivitas" name="jenis_aktivitas" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Kegiata<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_kegiatan" placeholder="Input Nama Kegiatan" />
                        <span class="text-danger">Ket: Samakan dengan judul yang tertera di proposal</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah Luaran<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Input Jumlah Luaran" name="jumlah_luaran" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Satuan Luaran<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="satuan_luaran" placeholder="Input Satuan Luaran"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Luaran Kegiatan<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Input Luaran Kegiatan" name="luaran_kegiatan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status Pelaksanaan Kegiatan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="status_pelaksanaan_kegiatan" placeholder="Input Status Pelaksanaan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Total Pengajuan Anggaran<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total_pengajuan_anggaran" />
                        <span class="text-danger">Ket: Pastikan nominal yang diinput benar </span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Total Penggunaan Anggaran<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="total_penggunaan_anggaran" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Awal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal_awal" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Akhir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal_akhir" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Rentang Pengerjaan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Input Rentang Pengerjaan" name="rentang_pengerjaan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Panitia Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Input Panitia Kegiatan" name="panitia_kegiatan" />
                        <span class="text-danger">Ket: Inisial</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Rincian Jumlah Pesertas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Input Rincian Jumlah Peserta" name="rincian_jumlah_peserta" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tempat Pelaksanaan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Input Tempat Pelaksanaan" name="tempat_pelaksanaan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Surat Kerja<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="surat_kerja" />
                        <span class="text-danger">Max. Size : 500 KB | Filetype : pdf</span>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Surat Tugas<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="surat_tugas" />
                        <span class="text-danger">Max. Size : 500 KB | Filetype : pdf</span>
                    </div>
                    <div class="col-12 text-end mt-5">
                        <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection