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
                            <a href="{{ route('list-kegiatan.index') }}" class="text-muted text-hover-primary">Data Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.data', ['proposal_id' => $proposal_id]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">Tambah Kegiatan</a>
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
                    <form class="row g-3" action="{{ route('list-kegiatan.store', ['proposal_id' => $proposal_id]) }}"
                        method="POST" id="formAdd" enctype="multipart/form-data">
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
                        <input type="hidden" name="proposal_id" value="{{ $proposal_id }}">
                        <!-- SECTION KIRI -->
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Jenis Aktivitas<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="jenis Aktivitas"
                                        name="jenis_aktivitas" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Nama Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_kegiatan"
                                        placeholder="Input Nama Kegiatan" />
                                    <span class="text-danger">Ket: Samakan dengan judul yang tertera di proposal</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Jumlah Luaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Input Jumlah Luaran"
                                        name="jumlah_luaran" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Satuan Luaran<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="satuan_luaran"
                                        placeholder="Input Satuan Luaran" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Luaran Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="string" class="form-control" placeholder="Input Luaran Kegiatan"
                                        name="luaran_kegiatan" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Status Pelaksanaan Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="status_pelaksanaan_kegiatan"
                                        placeholder="Input Status Pelaksanaan" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Total Pengajuan Anggaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_pengajuan_anggaran" />
                                    <span class="text-danger">Ket: Pastikan nominal yang diinput benar </span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Total Penggunaan Anggaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_penggunaan_anggaran" />
                                </div>

                            </div>
                        </div>

                        <!-- SECTION KANAN -->
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tanggal Awal <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_awal" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tanggal Akhir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_akhir" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Rentang Pengerjaan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Input Rentang Pengerjaan"
                                        name="rentang_pengerjaan" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Panitia Kegiatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Input Panitia Kegiatan"
                                        name="panitia_pengerjaan" />
                                    <span class="text-danger">Ket: Inisial</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Rincian Jumlah Peserta <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Input Rincian Jumlah Peserta"
                                        name="rincian_jumlah_peserta" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tempat Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Input Tempat Pelaksanaan"
                                        name="tempat_pelaksanaan" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Surat Kerja<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="surat_kerja" accept=".pdf" />
                                    <span class="text-danger">Max. Size : 500 KB | Filetype : pdf</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Surat Tugas<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="surat_tugas" accept=".pdf" />
                                    <span class="text-danger">Max. Size : 500 KB | Filetype : pdf</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>

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
    </script>
@endsection
