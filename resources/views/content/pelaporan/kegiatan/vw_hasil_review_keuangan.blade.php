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
                            <a href="{{ route('pelaporan.index') }}" class="text-muted text-hover-primary">Pelaporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('kegiatan.index', ['proposal_id' => encrypt($proposal_id)]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('kegiatan.review_keuangan', ['list_kegiatan_id' => $list_kegiatan_id]) }}"
                                class="text-muted text-hover-primary">Hasil Review Keuangan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            @forelse ($pelaporans as $pelaporan)
                @php
                    $review = $pelaporan->review_keuangan;
                @endphp

                <div class="card mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Review Laporan</span>
                        </h3>
                    </div>
                    <div class="card-body py-3">
                        <form class="row"
                            action="{{ route('laporan-keuangan.store', ['pelaporan_id' => $pelaporan->id]) }}"
                            method="POST" id="formAdd" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="pelaporan_id" value="{{ $pelaporan->id }}">

                            <!-- Informasi Pelaporan -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Kegiatan</label>
                                <p class="form-control">{{ $pelaporan->list_kegiatan->nama_kegiatan }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Ketua Pelaksana</label>
                                <p class="form-control">{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Laporan Keuangan </label>
                                <div class="col-md-7 form-control">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}" target="_blank">
                                        <span class="fw-semibold">Open </span>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bukti Pembayaran</label>
                                <p class="form-control">{{ $pelaporan->bukti_pembayaran }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pengajuan Dana</label>
                                <p class="form-control">{{ $pelaporan->pengajuan_dana }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sisa Dana</label>
                                <p class="form-control">{{ $pelaporan->sisa_dana }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Serapan Dana</label>
                                <p class="form-control">{{ number_format($pelaporan->serapan_dana, 2) }} %</p>
                            </div>
                            <h3 class="mb-5">Hasil Review Dari Keuangan</h3>

                            <!-- Kolom Catatan -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Catatan</label>
                                @if ($review)
                                    <p class="form-control">{{ $review->catatan }}</p>
                                @else
                                    <input type="text" class="form-control" placeholder="Catatan" name="catatan" />
                                @endif
                            </div>

                            <!-- Kolom Status -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                @if ($review)
                                    <p class="form-control">{{ $review->status }}</p>
                                @else
                                    <input type="text" class="form-control" placeholder="Status" name="status" />
                                @endif
                            </div>

                            <!-- Kolom Auditor -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Auditor</label>
                                @if ($review)
                                    <p class="form-control">{{ $review->auditor }}</p>
                                @else
                                    <input type="text" class="form-control" placeholder="Auditor" name="auditor" />
                                @endif
                            </div>

                            @unless ($review)
                                <div class="col-12 text-end mt-4">
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            @endunless
                        </form>
                    </div>
                </div>
            @empty
                <div class="alert alert-success">
                    <p>Belum Ada Laporan Untuk Kegiatan Ini</p>
                </div>
            @endforelse

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
