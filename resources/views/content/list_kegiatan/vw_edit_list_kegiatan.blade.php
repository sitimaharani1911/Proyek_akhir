@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Edit List Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.index') }}" class="text-muted text-hover-primary">Data Hibah</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('list-kegiatan.data', ['proposal_id' => $kegiatan->proposal_id]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Edit Kegiatan</li>
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
                        <span class="card-label fw-bold fs-3 mb-1">Edit List Kegiatan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <form class="row g-3" action="{{ route('list-kegiatan.update', ['id' => $kegiatan->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="proposal_id" value="{{ $kegiatan->proposal_id }}">

                        <!-- SECTION KIRI -->
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Jenis Aktivitas<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="jenis_aktivitas"
                                        value="{{ old('jenis_aktivitas', $kegiatan->jenis_aktivitas) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Nama Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama_kegiatan"
                                        value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" />
                                    <span class="text-danger">Ket: Samakan dengan judul yang tertera di proposal</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Jumlah Luaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="jumlah_luaran"
                                        value="{{ old('jumlah_luaran', $kegiatan->jumlah_luaran) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Satuan Luaran<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="satuan_luaran"
                                        value="{{ old('satuan_luaran', $kegiatan->satuan_luaran) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Luaran Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="luaran_kegiatan"
                                        value="{{ old('luaran_kegiatan', $kegiatan->luaran_kegiatan) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Status Pelaksanaan Kegiatan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="status_pelaksanaan_kegiatan"
                                        value="{{ old('status_pelaksanaan_kegiatan', $kegiatan->status_pelaksanaan_kegiatan) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Total Pengajuan Anggaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_pengajuan_anggaran"
                                        value="{{ old('total_pengajuan_anggaran', $kegiatan->total_pengajuan_anggaran) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Total Penggunaan Anggaran<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="total_penggunaan_anggaran"
                                        value="{{ old('total_penggunaan_anggaran', $kegiatan->total_penggunaan_anggaran) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tanggal Awal <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_awal"
                                        value="{{ old('tanggal_awal', $kegiatan->tanggal_awal) }}" />
                                </div>
                            </div>
                        </div>

                        <!-- SECTION KANAN -->
                        <div class="col-md-6">
                            <div class="row g-3">

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tanggal Akhir <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="tanggal_akhir"
                                        value="{{ old('tanggal_akhir', $kegiatan->tanggal_akhir) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Rentang Pengerjaan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rentang_pengerjaan"
                                        value="{{ old('rentang_pengerjaan', $kegiatan->rentang_pengerjaan) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Panitia Kegiatan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="panitia_pengerjaan"
                                        value="{{ old('panitia_pengerjaan', $kegiatan->panitia_pengerjaan) }}" />
                                    <span class="text-danger">Ket: Inisial</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Rincian Jumlah Peserta <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="rincian_jumlah_peserta"
                                        value="{{ old('rincian_jumlah_peserta', $kegiatan->rincian_jumlah_peserta) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Tempat Pelaksanaan<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tempat_pelaksanaan"
                                        value="{{ old('tempat_pelaksanaan', $kegiatan->tempat_pelaksanaan) }}" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Surat Kerja</label>
                                    @if ($kegiatan->surat_kerja)
                                        <p>File sebelumnya: <a href="{{ asset('storage/' . $kegiatan->surat_kerja) }}"
                                                target="_blank">Lihat</a></p>
                                    @endif
                                    <input type="file" class="form-control" name="surat_kerja" accept=".pdf" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Surat Tugas</label>
                                    @if ($kegiatan->surat_tugas)
                                        <p>File sebelumnya: <a href="{{ asset('storage/' . $kegiatan->surat_tugas) }}"
                                                target="_blank">Lihat</a></p>
                                    @endif
                                    <input type="file" class="form-control" name="surat_tugas" accept=".pdf" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end mt-5">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
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
