@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Kegiatan</h1>
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
                            <a href="index.html" class="text-muted text-hover-primary">Detail</a>
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
                            <h3 class="fw-bold m-0">Detail Pelaporan Kegiatan Pelaksanaan Hibah</h3>
                        </div>
                        <a href="{{ route('informasi_hibah.index') }}"
                            class="btn btn-sm btn-primary align-self-center">Kembali</a>
                    </div>
                    @forelse ($pelaporans as $pelaporan)
                        @php
                            $monevs = $pelaporan->monev;
                        @endphp
                        <div class="card-body p-9 mt">
                            <div class="row">
                                <!-- Section kiri -->
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Nama Kegiatan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->list_kegiatan->nama_kegiatan }}</span>
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
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->panitia_pengerjaan }}</span>
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
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->tempat_pelaksanaan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Jumlah Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->jumlah_peserta }}</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Section Kanan -->
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Absensi Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}" target="_blank">
                                                <span class="fw-semibold">Open </span>

                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Surat Tugas</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}" target="_blank">
                                                <span class="fw-semibold">Open </span>

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
                                                <span class="fw-semibold">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Keuangan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                target="_blank">
                                                <span class="fw-semibold">Open </span>
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
                                            <span class="fw-semibold">{{ $pelaporan->jumlah_peserta }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Lainnya</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank">
                                                <span class="fw-semibold">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Bukti Pembayaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->bukti_pembayaran }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card-body p-9">
                            <p>Belum Ada Laporan Untuk Kegiatan Ini</p>
                        </div>
                    @endforelse

                </div>

                @forelse ($pelaporans as $pelaporan)
                    <div class="card mb-2 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Hasil Monev </h3>
                            </div>
                        </div>
                        <div class="card-body p-9">
                            <div class="row">
                                <!-- Section kiri -->
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-3 fw-bold fs-6 text-gray-800">Nama Kegiatan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-8">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->nama_kegiatan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 fw-bold fs-6 text-gray-800">Ketua Pelaksana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-8">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->proposal->ketua_hibah }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 fw-bold fs-6 text-gray-800">Anggota Pelaksana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-8">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->panitia_pengerjaan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 fw-bold fs-6 text-gray-800">Tanggal</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-8">
                                            <span class="fw-semibold">{{ $pelaporan->tanggal }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-3 fw-bold fs-6 text-gray-800">Tempat</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-8">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->list_kegiatan->tempat_pelaksanaan }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <!-- Section Kanan -->
                                <div class="col-lg-5">
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
                                            <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}"
                                                target="_blank">
                                                <span class="fw-semibold text-primary">Open </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Nilai</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            @if ($monevs)
                                                <span class="fw-semibold">{{ $monevs->nilai }}</span>
                                            @else
                                                <span class="fw-semibold">Belum dinilai</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Persentase Capaian</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            @if ($monevs)
                                                <span class="fw-semibold">{{ $monevs->persentase_capaian }}</span>
                                            @else
                                                <span class="fw-semibold">Belum dinilai</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Status</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            @if ($monevs)
                                                <span class="fw-semibold">{{ $monevs->status }}</span>
                                            @else
                                                <span class="fw-semibold">Belum dinilai</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Tim Monev</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            @if ($monevs)
                                                <span class="fw-semibold">{{ $monevs->tim_monev }}</span>
                                            @else
                                                <span class="fw-semibold">Belum dinilai</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-row-bordered gy-2 gs-7 border rounded mt-5">
                                <thead class="border">
                                    <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                        <th style="width: 200px"></th>
                                        <th style="width: 200px">Data</th>
                                        <th style="width: 200px">Status</th>
                                        <th style="width: 400px">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="border header-left">
                                    <tr class="text-center">
                                        <td class="fw-bold">Pengajuan Dana</td>
                                        <td>{{ $pelaporan->pengajuan_dana }}</td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_pengajuan_dana }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_pengajuan_dana ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Sisa Dana</td>
                                        <td>{{ $pelaporan->sisa_dana }}</td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_sisa_dana }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_sisa_dana ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Kerja</td>
                                        <td>
                                            <div class="">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->surat_kerja) }}"
                                                    target="_blank">
                                                    <span class="fw-semibold text-primary">Open </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_surat_kerja }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_surat_kerja ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Tugas</td>
                                        <td>
                                            <div class="">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->surat_tugas) }}"
                                                    target="_blank">
                                                    <span class="fw-semibold text-primary">Open </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_surat_tugas }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_surat_tugas ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Laporan Kegiatan</td>
                                        <td>
                                            <div class="">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->laporan_kegiatan) }}"
                                                    target="_blank">
                                                    <span class="fw-semibold text-primary">Open </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_laporan_kegiatan }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_laporan_kegiatan ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Laporan Keuangan</td>
                                        <td>
                                            <div class="">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->laporan_keuangan) }}"
                                                    target="_blank">
                                                    <span class="fw-semibold text-primary">Open </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_laporan_keuangan }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_laporan_keuangan ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Luaran</td>
                                        <td>{{ $pelaporan->luaran }}</td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_luaran }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_luaran ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Dampak</td>
                                        <td>{{ $pelaporan->dampak }}</td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_dampak }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_dampak ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Dokumentasi</td>
                                        <td>{{ $pelaporan->dokumentasi }}</td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_dokumentasi }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_dokumentasi ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Lainnya</td>
                                        <td>
                                            <div class="">
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->lainnya) }}" target="_blank">
                                                    <span class="fw-semibold text-primary">Open </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->status_lainnya }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                        <td>
                                            @if ($monevs)
                                                {{ $monevs->catatan_lainnya ?? '-' }}
                                            @else
                                                Belum dinilai
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($monevs && $monevs->status === 'open')
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold fs-3 mb-1">Revisi Pelaporan</span>
                                </h3>
                            </div>
                            <div class="card-body py-3">
                                <form class="row"
                                    action="{{ route('kegiatan.store', ['list_kegiatan_id' => $list_kegiatan_id]) }}"
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
                                            <label class="form-label fw-semibold">Tanggal <span
                                                    class="text-danger">*</span></label>
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
                                            <label class="form-label fw-semibold">Sisa Dana <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Sisa Dana"
                                                name="sisa_dana" />
                                            <span class="text-danger">Ket: Pastikan nominal yang diinput benar</span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Surat Kerja <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="surat_kerja" />
                                            <span class="text-danger">Max. Size: 500 KB | Filetype: PDF</span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Surat Tugas <span
                                                    class="text-danger">*</span></label>
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
                                            <label class="form-label fw-semibold">Luaran <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Luaran"
                                                name="luaran" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Dampak <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Dampak"
                                                name="dampak" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Dokumentasi <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" class="form-control" placeholder="https://link.com"
                                                name="dokumentasi" />
                                            <span class="text-danger">Ket: Pastikan link dapat diakses</span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Lainnya <span
                                                    class="text-danger">*</span></label>
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
                    @endif
                @empty
                    <div class="alert alert-danger">
                        <strong>Belum Di monev</strong>
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
