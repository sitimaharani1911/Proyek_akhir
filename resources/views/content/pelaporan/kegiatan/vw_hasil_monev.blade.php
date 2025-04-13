@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    Verifikasi Kegiatan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('piu.index')}}" class="text-muted text-hover-primary">Verif Monev</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('piu.kegiatan')}}" class="text-muted text-hover-primary">Kegiatan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('piu.review')}}" class="text-muted text-hover-primary">Review</a>
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
                    <a href="{{ route('piu.kegiatan') }}"
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
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Absensi Peserta</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span class="fw-semibold">Open </span>
                                </div>
                            </div>
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
                        </div>
                        <!-- Section Kanan -->
                        <div class="col-lg-6">
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
                                    <span class="fw-semibold">...</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Catatan</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Ada beberapa hal yang harus di perbaiki seperti :
                                        1. ....
                                        2. ....
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Nilai</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">75</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Persentase Capaian</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">75 %</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Status</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">Open</span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Akhir Monev</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span class="fw-semibold">Open </span>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-4 fw-bold fs-6 text-gray-800">Tim Monev</label>
                                <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                <div class="col-md-7">
                                    <span class="fw-semibold">NFN, ISM, HNI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Revisi Pelaporan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                <form class="row g-3" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Surat Kerja <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="surat_kerja" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ketua Pelaksana <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Ketua Pelaksana" name="ketua_pelaksana" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Surat Tugas <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="surat_tugas" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Anggota Pelaksana <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Anggota Pelaksana" name="anggota_pelaksana" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Laporan Kegiatan <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="laporan_kegiatan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pengajuan Dana <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Pengajuan Dana" name="pengajuan_dana" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Laporan Keuangan <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="laporan_keuangan" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Sisa Dana <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Sisa Dana" name="sisa_dana" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Luaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Luaran" name="luaran" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dampak <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Dampak" name="dampak" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tempat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Tempat" name="Tempat" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dokumentasi <span class="text-danger">*</span></label>
                        <input type="url" class="form-control" placeholder="Dokumentasi" name="dokumentasi" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah Peserta <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Jumlah Peserta" name="jumlah_peserta" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lainnya <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="lainnya" />
                    </div>
                    <div class="col-12 text-end mt-5">
                        <button type="button" onclick="save()" class="btn btn-primary">Edit</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection