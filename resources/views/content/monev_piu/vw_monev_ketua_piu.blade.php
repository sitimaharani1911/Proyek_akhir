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
                            <a class="text-muted text-hover-primary">Verif Monev</a>
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
                            <a class="text-muted text-hover-primary">Review</a>
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
                @forelse ($pelaporans as $pelaporan)
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
                                            <span class="fw-semibold">{{ $pelaporan->nama_kegiatan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Ketua Pelaksana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}</span>
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
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Absensi Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Tugas</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
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
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
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
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
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
                                            <span class="fw-semibold">{{ $pelaporan->dokumentasi }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Lainnya</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
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
                                <span class="card-label fw-bold fs-3 mb-1">Data Informasi Hibah</span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            @if ($pelaporan->review_piu)
                                <div class="alert alert-info">
                                    <strong>Sudah Di Review</strong>
                                    <p>{{ $pelaporan->review_piu->catatan }}</p>
                                </div>
                            @else
                                <form class="form"
                                    action="{{ route('piu.store', ['pelaporan_id' => $pelaporan->id]) }}" method="POST"
                                    id="formAdd" enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <input type="hidden" name="id" value="">
                                    <input type="hidden" name="pelaporan_id" value="{{ $pelaporan->id }}">
                                    <div class="d-flex flex-column mb-6 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                            <span class="required">Catatan</span>
                                        </label>
                                        <textarea class="form-control" name="catatan" rows="4"></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-danger">
                        <strong>Data tidak ditemukan!</strong>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // Notifikasi jika ada error validasi
        @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                text: 'Periksa kembali form Anda.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endsection
