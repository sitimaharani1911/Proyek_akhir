@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Input Dokumen</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('pelaporan.index') }}" class="text-muted text-hover-primary">Pelaporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('pelaporan.input_dokumen', ['informasi_hibah_id' => encrypt($informasi_hibah_id)]) }}" class="text-muted text-hover-primary">Input Dokumen</a>
                        </li>
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
                        <span class="card-label fw-bold fs-3 mb-1">Data Informasi Hibah</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @if ($dokumenHibah)
                        {{-- Dokumen sudah diinput --}}
                        <div class="alert alert-success">Dokumen telah diinput untuk informasi hibah ini.</div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Kontrak</label><br>
                            <div class="form-control">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <a href="{{ asset('storage/' . $dokumenHibah->kontrak) }}" target="_blank"
                                    class="text-primary">Lihat Kontrak</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Berita Acara</label><br>
                            <div class="form-control">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <a href="{{ asset('storage/' . $dokumenHibah->berita_acara) }}" target="_blank"
                                    class="text-primary">Lihat Berita Acara</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Verifikasi Kelayakan</label><br>
                            <div class="form-control">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <a href="{{ asset('storage/' . $dokumenHibah->verifikasi_kelayakan) }}" target="_blank"
                                    class="text-primary">Lihat Verifikasi</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Kerangka Acuan Kerja</label><br>
                            <div class="form-control">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <a href="{{ asset('storage/' . $dokumenHibah->kerangka_acuan_kerja) }}" target="_blank"
                                    class="text-primary">Lihat KAK</a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">SK Tim Hibah</label><br>
                            <div class="form-control">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <a href="{{ asset('storage/' . $dokumenHibah->sk_tim_hibah) }}" target="_blank"
                                    class="text-primary">Lihat SK</a>
                            </div>
                        </div>
                    @else
                        <form class="form"
                            action="{{ route('pelaporan.input_dokumen.store', ['informasi_hibah_id' => $informasi_hibah_id]) }}"
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
                            <input type="hidden" name="informasi_hibah_id" value="{{ $informasi_hibah_id }}">
                            <div class="d-flex flex-column mb-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                    <span class="required">Kontrak</span>
                                </label>
                                <input type="file" accept=".pdf" class="form-control" name="kontrak" />
                                <span class="text-danger  mt-2">Max. Size : 500 KB | Filetype : pdf</span>
                            </div>
                            <div class="d-flex flex-column mb-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                    <span class="required">Berita Acara</span>
                                </label>
                                <input type="file" accept=".pdf" class="form-control" name="berita_acara" />
                                <span class="text-danger  mt-2">Max. Size : 500 KB | Filetype : pdf</span>
                            </div>
                            <div class="d-flex flex-column mb-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                    <span class="required">Verifikasi Kelayakan</span>
                                </label>
                                <input type="file" accept=".pdf" class="form-control" name="verifikasi_kelayakan" />
                                <span class="text-danger mt-2">Max. Size : 500 KB | Filetype : pdf</span>
                            </div>
                            <div class="d-flex flex-column mb-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                    <span class="required">Kerangka Acuan Kerja</span>
                                </label>
                                <input type="file" accept=".pdf" class="form-control" name="kerangka_acuan_kerja" />
                                <span class="text-danger  mt-2">Max. Size : 500 KB | Filetype : pdf</span>
                            </div>
                            <div class="d-flex flex-column mb-6 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2 w-25">
                                    <span class="required">SK Tim Hibah</span>
                                </label>
                                <input type="file" accept=".pdf" class="form-control" name="sk_tim_hibah" />
                                <span class="text-danger  mt-2">Max. Size : 500 KB | Filetype : pdf</span>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    @endif
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
