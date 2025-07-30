@extends('layouts.master')

@section('content')
    <style>
        i.bi {
            stroke-width: 2;
        }

        label.input-group-text {
            cursor: pointer;
        }
    </style>
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Review Laporan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev.index') }}" class="text-muted text-hover-primary">Monev</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev.kegiatan', ['proposal_id' => encrypt($proposal_id)]) }}"
                                class="text-muted text-hover-primary">List Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">Review Laporan</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Review Laporan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    @if (!$pelaporan)
                        <div class="alert alert-info">
                            <strong>Belum Ada Laporan untuk Kegiatan Ini.</strong>
                        </div>
                    @else
                        @php
                            $monevs = $pelaporan->monev; // Relasi hasOne
                            $isUpdate = !is_null($monevs);
                        @endphp

                        @if ($isUpdate)
                            <div class="alert alert-info mb-4">
                                <strong>Perhatian:</strong> Anda sedang dalam Monev ulang. Mengirim
                                form ini akan memperbarui data.
                            </div>
                        @endif

                        <form class="row"
                            action="{{ $isUpdate ? route('monev.review.update', $monevs->id) : route('monev.review.store') }}"
                            method="POST" id="formMonev" enctype="multipart/form-data">
                            @csrf
                            @if ($isUpdate)
                                @method('PUT')
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <p><strong>Oops! Ada beberapa kesalahan:</strong></p>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <input type="hidden" name="pelaporan_id" value="{{ $pelaporan->id }}">
                            {{-- Kiri --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Kegiatan</label>
                                    <textarea class="form-control" readonly>{{ $pelaporan->list_kegiatan->nama_kegiatan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Ketua Pelaksana</label>
                                    <input type="text" class="form-control"
                                        value="{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tanggal Pelaporan</label>
                                    <input type="text" class="form-control" value="{{ $pelaporan->tanggal }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Absensi Peserta</label>
                                    <div class="form-control">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}" target="_blank">
                                            <span class="fw-semibold text-primary">Open </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Link Luaran <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->link_luaran }}"
                                            readonly />
                                        <label for="luaran-terima" class="input-group-text">
                                            <input type="radio" id="luaran-terima" name="status_luaran" value="Diterima"
                                                class="d-none"
                                                {{ old('status_luaran', $monevs->status_luaran ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="luaran-tolak" class="input-group-text">
                                            <input type="radio" id="luaran-tolak" name="status_luaran" value="Ditolak"
                                                class="d-none"
                                                {{ old('status_luaran', $monevs->status_luaran ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_luaran') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_luaran" rows="3">{{ old('catatan_luaran', $monevs->catatan_luaran ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Pengajuan Dana <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            value="{{ 'Rp ' . number_format($pelaporan->pengajuan_dana, 0, ',', '.') }}"
                                            readonly />
                                        <label for="pengajuan_dana-terima" class="input-group-text">
                                            <input type="radio" id="pengajuan_dana-terima" name="status_pengajuan_dana"
                                                value="Diterima" class="d-none"
                                                {{ old('status_pengajuan_dana', $monevs->status_pengajuan_dana ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="pengajuan_dana-tolak" class="input-group-text">
                                            <input type="radio" id="pengajuan_dana-tolak" name="status_pengajuan_dana"
                                                value="Ditolak" class="d-none"
                                                {{ old('status_pengajuan_dana', $monevs->status_pengajuan_dana ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_pengajuan_dana') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_pengajuan_dana" rows="3">{{ old('catatan_pengajuan_dana', $monevs->catatan_pengajuan_dana ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Penggunaan Dana <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            value="{{ 'Rp ' . number_format($pelaporan->penggunaan_dana, 0, ',', '.') }}"
                                            readonly />
                                        <label for="penggunaan_dana-terima" class="input-group-text">
                                            <input type="radio" id="penggunaan_dana-terima"
                                                name="status_penggunaan_dana" value="Diterima" class="d-none"
                                                {{ old('status_penggunaan_dana', $monevs->status_penggunaan_dana ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="penggunaan_dana-tolak" class="input-group-text">
                                            <input type="radio" id="penggunaan_dana-tolak"
                                                name="status_penggunaan_dana" value="Ditolak" class="d-none"
                                                {{ old('status_penggunaan_dana', $monevs->status_penggunaan_dana ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_penggunaan_dana') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_penggunaan_dana" rows="3">{{ old('catatan_penggunaan_dana', $monevs->catatan_penggunaan_dana ?? '') }}</textarea>
                                </div>
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Sisa Dana <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            value="{{ 'Rp ' . number_format($pelaporan->sisa_dana, 0, ',', '.') }}"
                                            readonly />
                                        <label for="sisa_dana-terima" class="input-group-text">
                                            <input type="radio" id="sisa_dana-terima" name="status_sisa_dana"
                                                value="Diterima" class="d-none"
                                                {{ old('status_sisa_dana', $monevs->status_sisa_dana ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="sisa_dana-tolak" class="input-group-text">
                                            <input type="radio" id="sisa_dana-tolak" name="status_sisa_dana"
                                                value="Ditolak" class="d-none"
                                                {{ old('status_sisa_dana', $monevs->status_sisa_dana ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_sisa_dana') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_sisa_dana" rows="3">{{ old('catatan_sisa_dana', $monevs->catatan_sisa_dana ?? '') }}</textarea>
                                </div>
                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Surat Keputusan <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_keputusan) }}"
                                                target="_blank"><span class="fw-semibold text-primary">Open
                                                    File</span></a>
                                        </div>
                                        <label for="surat_keputusan-terima" class="input-group-text">
                                            <input type="radio" id="surat_keputusan-terima"
                                                name="status_surat_keputusan" value="Diterima" class="d-none"
                                                {{ old('status_surat_keputusan', $monevs->status_surat_keputusan ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="surat_keputusan-tolak" class="input-group-text">
                                            <input type="radio" id="surat_keputusan-tolak"
                                                name="status_surat_keputusan" value="Ditolak" class="d-none"
                                                {{ old('status_surat_keputusan', $monevs->status_surat_keputusan ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_surat_keputusan') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_surat_keputusan" rows="3">{{ old('catatan_surat_keputusan', $monevs->catatan_surat_keputusan ?? '') }}</textarea>
                                </div>
                            </div>
                            {{-- kanam --}}
                            <div class="col-md-6">

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Surat Tugas <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}"
                                                target="_blank"><span class="fw-semibold text-primary">Open
                                                    File</span></a>
                                        </div>
                                        <label for="surat_tugas-terima" class="input-group-text">
                                            <input type="radio" id="surat_tugas-terima" name="status_surat_tugas"
                                                value="Diterima" class="d-none"
                                                {{ old('status_surat_tugas', $monevs->status_surat_tugas ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="surat_tugas-tolak" class="input-group-text">
                                            <input type="radio" id="surat_tugas-tolak" name="status_surat_tugas"
                                                value="Ditolak" class="d-none"
                                                {{ old('status_surat_tugas', $monevs->status_surat_tugas ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_surat_tugas') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_surat_tugas" rows="3">{{ old('catatan_surat_tugas', $monevs->catatan_surat_tugas ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Laporan Kegiatan <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}"
                                                target="_blank"><span class="fw-semibold text-primary">Open
                                                    File</span></a>
                                        </div>
                                        <label for="laporan_kegiatan-terima" class="input-group-text">
                                            <input type="radio" id="laporan_kegiatan-terima"
                                                name="status_laporan_kegiatan" value="Diterima" class="d-none"
                                                {{ old('status_laporan_kegiatan', $monevs->status_laporan_kegiatan ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="laporan_kegiatan-tolak" class="input-group-text">
                                            <input type="radio" id="laporan_kegiatan-tolak"
                                                name="status_laporan_kegiatan" value="Ditolak" class="d-none"
                                                {{ old('status_laporan_kegiatan', $monevs->status_laporan_kegiatan ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_laporan_kegiatan') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_laporan_kegiatan" rows="3">{{ old('catatan_laporan_kegiatan', $monevs->catatan_laporan_kegiatan ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Laporan Keuangan <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank"><span class="fw-semibold text-primary">Open
                                                    File</span></a>
                                        </div>
                                        <label for="laporan_keuangan-terima" class="input-group-text">
                                            <input type="radio" id="laporan_keuangan-terima"
                                                name="status_laporan_keuangan" value="Diterima" class="d-none"
                                                {{ old('status_laporan_keuangan', $monevs->status_laporan_keuangan ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="laporan_keuangan-tolak" class="input-group-text">
                                            <input type="radio" id="laporan_keuangan-tolak"
                                                name="status_laporan_keuangan" value="Ditolak" class="d-none"
                                                {{ old('status_laporan_keuangan', $monevs->status_laporan_keuangan ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_laporan_keuangan') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_laporan_keuangan" rows="3">{{ old('catatan_laporan_keuangan', $monevs->catatan_laporan_keuangan ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Dampak <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $pelaporan->dampak }}"
                                            readonly />
                                        <label for="dampak-terima" class="input-group-text">
                                            <input type="radio" id="dampak-terima" name="status_dampak"
                                                value="Diterima" class="d-none"
                                                {{ old('status_dampak', $monevs->status_dampak ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="dampak-tolak" class="input-group-text">
                                            <input type="radio" id="dampak-tolak" name="status_dampak" value="Ditolak"
                                                class="d-none"
                                                {{ old('status_dampak', $monevs->status_dampak ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_dampak') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_dampak" rows="3">{{ old('catatan_dampak', $monevs->catatan_dampak ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Dokumentasi <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-link-45deg"></i>
                                            <a href="{{ $pelaporan->dokumentasi }}" target="_blank"><span
                                                    class="fw-semibold text-primary">Open Link</span></a>
                                        </div>
                                        <label for="dokumentasi-terima" class="input-group-text">
                                            <input type="radio" id="dokumentasi-terima" name="status_dokumentasi"
                                                value="Diterima" class="d-none"
                                                {{ old('status_dokumentasi', $monevs->status_dokumentasi ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="dokumentasi-tolak" class="input-group-text">
                                            <input type="radio" id="dokumentasi-tolak" name="status_dokumentasi"
                                                value="Ditolak" class="d-none"
                                                {{ old('status_dokumentasi', $monevs->status_dokumentasi ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_dokumentasi') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_dokumentasi" rows="3">{{ old('catatan_dokumentasi', $monevs->catatan_dokumentasi ?? '') }}</textarea>
                                </div>

                                <div class="mb-3 group-catatan">
                                    <label class="form-label fw-semibold">Lainnya <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="form-control">
                                            <i class="bi bi-link-45deg"></i>
                                            <a href="{{ $pelaporan->lainnya }}" target="_blank"><span
                                                    class="fw-semibold text-primary">Open Link</span></a>
                                        </div>
                                        <label for="lainnya-terima" class="input-group-text">
                                            <input type="radio" id="lainnya-terima" name="status_lainnya"
                                                value="Diterima" class="d-none"
                                                {{ old('status_lainnya', $monevs->status_lainnya ?? '') == 'Diterima' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-check-circle-fill fs-4"></i>
                                        </label>
                                        <label for="lainnya-tolak" class="input-group-text">
                                            <input type="radio" id="lainnya-tolak" name="status_lainnya"
                                                value="Ditolak" class="d-none"
                                                {{ old('status_lainnya', $monevs->status_lainnya ?? '') == 'Ditolak' ? 'checked' : '' }}
                                                required />
                                            <i class="bi bi-x-circle-fill fs-4"></i>
                                        </label>
                                    </div>
                                    <textarea
                                        class="form-control d-none mt-2 @error('catatan_lainnya') is-invalid @enderror"
                                        placeholder="Berikan catatan penolakan..." name="catatan_lainnya" rows="3">{{ old('catatan_lainnya', $monevs->catatan_lainnya ?? '') }}</textarea>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Persentase Capaian <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @error('persentase_capaian') is-invalid @enderror"
                                        placeholder="0-100" name="persentase_capaian" id="persentase_capaian"
                                        min="0" max="100"
                                        value="{{ old('persentase_capaian', $monevs->persentase_capaian ?? '') }}"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status_select"
                                        required>
                                        <option value="" disabled
                                            {{ !old('status', $monevs->status ?? '') ? 'selected' : '' }}>-- Pilih Status
                                            --</option>
                                        <option value="open"
                                            {{ old('status', $monevs->status ?? '') == 'open' ? 'selected' : '' }}>Open
                                        </option>
                                        <option value="close"
                                            {{ old('status', $monevs->status ?? '') == 'close' ? 'selected' : '' }}>Close
                                        </option>
                                    </select>
                                    <input type="hidden" name="status" id="status_hidden"
                                        value="{{ old('status', $monevs->status ?? '') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Laporan Monev (PDF)
                                        @if ($isUpdate && $monevs->laporan_monev)
                                            <a href="{{ asset('storage/' . $monevs->laporan_monev) }}" target="_blank"
                                                class="ms-2 fw-normal">(Lihat File Saat Ini)</a>
                                        @endif
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" accept=".pdf"
                                        class="form-control @error('laporan_monev') is-invalid @enderror"
                                        name="laporan_monev" {{ !$isUpdate ? 'required' : '' }} />
                                    @if ($isUpdate)
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah file
                                            laporan.</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Tim Monev <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('tim_monev') is-invalid @enderror"
                                        placeholder="Nama Tim atau Anggota" name="tim_monev"
                                        value="{{ old('tim_monev', $monevs->tim_monev ?? '') }}" required />
                                </div>
                            </div>

                            <div class="col-12 text-end mt-4 mb-3">
                                <button type="submit" class="btn btn-primary px-6">
                                    <span
                                        class="indicator-label">{{ $isUpdate ? 'Update Review' : 'Kirim Review' }}</span>
                                </button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Skrip 1: Logika Persentase dan Status
            const persenInput = document.getElementById('persentase_capaian');
            const statusSelect = document.getElementById('status_select');
            const statusHidden = document.getElementById('status_hidden');

            const checkPersen = () => {
                if (!persenInput) return;
                const value = parseInt(persenInput.value);
                if (value === 100) {
                    statusSelect.value = 'close';
                    statusSelect.disabled = true;
                    statusHidden.value = 'close';
                } else {
                    statusSelect.disabled = false;
                }
            };

            if (persenInput) {
                persenInput.addEventListener('input', checkPersen);
            }

            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    statusHidden.value = this.value;
                });
            }

            checkPersen(); // Jalankan saat halaman dimuat

            // Skrip 2: Logika Tombol Terima/Tolak dan Catatan
            const groups = document.querySelectorAll('.group-catatan');
            groups.forEach(group => {
                const terimaButton = group.querySelector('input[type="radio"][value="Diterima"]');
                const tolakButton = group.querySelector('input[type="radio"][value="Ditolak"]');
                const terimaLabel = group.querySelector('label[for*="-terima"] .bi');
                const tolakLabel = group.querySelector('label[for*="-tolak"] .bi');
                const catatanInput = group.querySelector('textarea[name*="catatan_"]');

                if (!terimaButton || !tolakButton || !catatanInput) return;

                const updateStyles = () => {
                    terimaLabel.style.color = '';
                    tolakLabel.style.color = '';

                    if (terimaButton.checked) {
                        terimaLabel.style.color = '#059669'; // Hijau
                        catatanInput.classList.add('d-none');
                        catatanInput.required = false;
                        catatanInput.value = ''; 
                    } else if (tolakButton.checked) {
                        tolakLabel.style.color = '#DC3545'; // Merah
                        catatanInput.classList.remove('d-none');
                        catatanInput.required = true;
                    } else {
                        catatanInput.classList.add('d-none');
                        catatanInput.required = false;
                        catatanInput.value = ''; 
                    }
                };
                updateStyles();
                terimaButton.addEventListener('change', updateStyles);
                tolakButton.addEventListener('change', updateStyles);
            });
        });
    </script>

    {{-- Skrip 3: Notifikasi SweetAlert --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error!',
                html: 'Terdapat kesalahan pada input Anda. Silakan periksa kembali form.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
