@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Tambah Pelaporan Kegiatan</h1>
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
                            <a href="index.html" class="text-muted text-hover-primary">Tambah</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Tambah Pelaporan Kegiatan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @if ($pelaporan)
                        <div class="alert alert-success">
                            <strong>Perhatian!</strong> Anda sudah pernah mengisi pelaporan untuk kegiatan ini
                        </div>
                    @endif
                    <form class="row" action="{{ route('kegiatan.store', ['list_kegiatan_id' => $list_kegiatan_id]) }}"
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
                        <input type="hidden" name="list_kegiatan_id" value="{{ $list_kegiatan_id }}">

                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jumlah Peserta <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Jumlah Peserta"
                                    name="jumlah_peserta" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Absensi Peserta <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="absensi_peserta" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pengajuan Dana <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Pengajuan Dana"
                                    name="pengajuan_dana" />
                                <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sisa Dana <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Sisa Dana" name="sisa_dana" />
                                <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Surat Kerja <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="surat_kerja" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Surat Tugas <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="surat_tugas" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Laporan Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="laporan_kegiatan" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Laporan Keuangan <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="laporan_keuangan" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Luaran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Luaran" name="luaran" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Dampak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Dampak" name="dampak" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Dokumentasi <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" placeholder="https://link.com"
                                    name="dokumentasi" />
                                <span class="text-danger">Ket: Pastikan link dapat diakses</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Lainnya <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="lainnya" />
                                <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bukti Pembayaran <span
                                        class="text-danger">*</span></label>
                                <input type="url" class="form-control" placeholder="https://gdrive.com"
                                    name="bukti_pembayaran" />
                                <span class="text-danger">Ket: Lampirkan seluruh bukti pembayaran</span>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="col-12 text-end mt-4">
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
