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
                            <a href="{{ route('pelaporan.show', ['list_kegiatan_id' => $list_kegiatan_id]) }}"
                                class="text-muted text-hover-primary">Hasil Monev</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card-body py-3">
                @forelse ($pelaporans as $index => $pelaporan)
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Detail Pelaporan Kegiatan </h3>
                            </div>
                            @if ($loop->first)
                                <a href="{{ route('kegiatan.index', ['proposal_id' => encrypt($proposal_id)]) }}"
                                    class="btn btn-sm btn-primary align-self-center">Kembali</a>
                            @endif
                        </div>
                        <div class="card-body p-9">
                            <div class="row">
                                {{-- Section kiri  --}}
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
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Penggunaan Dana</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->penggunaan_dana }}</span>
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
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Absensi Peserta</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            <a href="{{ asset('storage/' . $pelaporan->absensi_peserta) }}"
                                                target="_blank">
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
                                </div>
                                {{-- Section Kanan --}}
                                <div class="col-lg-6">
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
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Jumlah Luaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->jumlah_luaran }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Satuan Luaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->satuan_luaran }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Luaran Kegiatan</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->luaran_kegiatan }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Link Luaran</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span class="fw-semibold">{{ $pelaporan->link_luaran }}</span>
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
                                           <span class="fw-semibold">{{ $pelaporan->lainnya }}</span>
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
                    </div>

                    {{-- Bagian Hasil Monev --}}
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Hasil Monev untuk Pelaporan</h3>
                            </div>
                        </div>
                        <div class="card-body p-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Persentase Capaian</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->monev->persentase_capaian ?? 'Belum Dimonev' }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Status</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->monev->status ?? 'Belum Dimonev' }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Tim Monev</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            <span
                                                class="fw-semibold">{{ $pelaporan->monev->tim_monev ?? 'Belum Dimonev' }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-md-4 fw-bold fs-6 text-gray-800">Laporan Monev</label>
                                        <label class="col-md-1 fw-bold fs-6 text-gray-800">:</label>
                                        <div class="col-md-7">
                                            @if ($pelaporan->monev && $pelaporan->monev->laporan_monev)
                                                <i class="bi bi-file-earmark-pdf"></i>
                                                <a href="{{ asset('storage/' . $pelaporan->monev->laporan_monev) }}"
                                                    target="_blank">
                                                    <span class="fw-semibold">Open </span>
                                                </a>
                                            @else
                                                <span class="fw-semibold">Belum Dimonev</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                </div>
                            </div>
                            <table class="table table-striped table-row-bordered gy-2 gs-7 border rounded mt-5">
                                <thead class="border">
                                    <tr class="fw-bold fs-6 text-gray-800 px-7 text-center">
                                        <th style="width: 200px">Item Evaluasi</th>
                                        <th style="width: 200px">Status Monev</th>
                                        <th style="width: 400px">Catatan Monev</th>
                                    </tr>
                                </thead>
                                <tbody class="border header-left">
                                    <tr class="text-center">
                                        <td class="fw-bold">Pengajuan Dana</td>
                                        <td>{{ $pelaporan->monev->status_pengajuan_dana ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_pengajuan_dana ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Penggunaan Dana</td>
                                        <td>{{ $pelaporan->monev->status_penggunaan_dana ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_penggunaan_dana ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Sisa Dana</td>
                                        <td>{{ $pelaporan->monev->status_sisa_dana ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_sisa_dana ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Kerja</td>
                                        <td>{{ $pelaporan->monev->status_surat_keputusan ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_surat_keputusan ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Tugas</td>
                                        <td>{{ $pelaporan->monev->status_surat_tugas ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_surat_tugas ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Laporan Kegiatan</td>
                                        <td>{{ $pelaporan->monev->status_laporan_kegiatan ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_laporan_kegiatan ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Surat Laporan Keuangan</td>
                                        <td>{{ $pelaporan->monev->status_laporan_keuangan ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_laporan_keuangan ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Luaran</td>
                                        <td>{{ $pelaporan->monev->status_luaran ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_luaran ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Dampak</td>
                                        <td>{{ $pelaporan->monev->status_dampak ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_dampak ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Dokumentasi</td>
                                        <td>{{ $pelaporan->monev->status_dokumentasi ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_dokumentasi ?? '-' }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="fw-bold">Lainnya</td>
                                        <td>{{ $pelaporan->monev->status_lainnya ?? 'Belum Dimonev' }}</td>
                                        <td>{{ $pelaporan->monev->catatan_lainnya ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>Belum Ada Laporan untuk Kegiatan Ini.</strong>
                    </div>
                @endforelse

                {{-- Form Kirim Ulang Pelaporan (Revisi) --}}
                @if ($latestMonev && $latestMonev->status === 'open' && $latestPelaporan)
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Perbaikan Pelaporan</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">
                                    Harap perbaiki item yang ditolak berdasarkan catatan dari tim Monev.
                                </span>
                            </h3>
                        </div>
                        <div class="card-body py-3">
                            <form action="{{ route('pelaporan.updateRevisi', ['pelaporan' => $latestPelaporan->id]) }}"
                                method="POST" id="formRevisi" enctype="multipart/form-data">
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

                                <div class="col-md-12">

                                    {{-- Pengajuan Dana --}}
                                    @if ($latestMonev->status_pengajuan_dana === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Pengajuan Dana <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Pengajuan Dana"
                                                name="pengajuan_dana" value="{{ old('pengajuan_dana') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_pengajuan_dana }}</div>
                                        </div>
                                    @endif

                                    {{-- Penggunaan Dana --}}
                                    @if ($latestMonev->status_penggunaan_dana === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Penggunaan Dana <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="penggunaan_dana"
                                                placeholder="Penggunaan Dana" value="{{ old('penggunaan_dana') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_penggunaan_dana }}</div>
                                        </div>
                                    @endif

                                    {{-- Sisa Dana --}}
                                    @if ($latestMonev->status_sisa_dana === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Sisa Dana <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="Sisa Dana"
                                                name="sisa_dana" value="{{ old('sisa_dana') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_sisa_dana }}</div>
                                        </div>
                                    @endif

                                    {{-- Jumlah Luaran --}}
                                    @if ($latestMonev->status_jumlah_luaran === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Jumlah Luaran <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="jumlah_luaran"
                                                placeholder="Input Jumlah Luaran" value="{{ old('jumlah_luaran') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_jumlah_luaran }}</div>
                                        </div>
                                    @endif

                                    {{-- Satuan Luaran --}}
                                    @if ($latestMonev->status_satuan_luaran === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Satuan Luaran <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="satuan_luaran"
                                                placeholder="Contoh: Publikasi Jurnal, Video, Artikel"
                                                value="{{ old('satuan_luaran') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_satuan_luaran }}</div>
                                        </div>
                                    @endif

                                    {{-- Luaran Kegiatan (Dipisah) --}}
                                    @if ($latestMonev->status_luaran_kegiatan === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Luaran Kegiatan <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" placeholder="Jelaskan luaran yang dihasilkan" name="luaran_kegiatan" rows="3">{{ old('luaran_kegiatan') }}</textarea>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_luaran_kegiatan }}</div>
                                        </div>
                                    @endif

                                    {{-- Link Luaran (Dipisah) --}}
                                    @if ($latestMonev->status_link_luaran === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Link Luaran <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" class="form-control" name="link_luaran"
                                                placeholder="https://..." value="{{ old('link_luaran') }}" />
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_link_luaran }}</div>
                                        </div>
                                    @endif

                                    {{-- Dampak --}}
                                    @if ($latestMonev->status_dampak === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Dampak <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" placeholder="Jelaskan dampak kegiatan" name="dampak" rows="3">{{ old('dampak') }}</textarea>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_dampak }}</div>
                                        </div>
                                    @endif

                                    {{-- Dokumentasi --}}
                                    @if ($latestMonev->status_dokumentasi === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Perbarui Link Dokumentasi <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" class="form-control"
                                                placeholder="https://drive.google.com/drive/..." name="dokumentasi"
                                                value="{{ old('dokumentasi') }}" />
                                            <span class="form-text text-muted">Ket: Pastikan link dapat diakses
                                                publik.</span>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_dokumentasi }}</div>
                                        </div>
                                    @endif

                                    {{-- Surat Keputusan --}}
                                    @if ($latestMonev->status_surat_keputusan === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Upload Ulang Surat Keputusan <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" accept=".pdf" class="form-control"
                                                name="surat_keputusan" />
                                            <div class="form-text text-muted">Max. Size: 5 MB | Filetype: PDF</div>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_surat_keputusan }}</div>
                                        </div>
                                    @endif

                                    {{-- Surat Tugas --}}
                                    @if ($latestMonev->status_surat_tugas === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Upload Ulang Surat Tugas <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" accept=".pdf" class="form-control"
                                                name="surat_tugas" />
                                            <div class="form-text text-muted">Max. Size: 5 MB | Filetype: PDF</div>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_surat_tugas }}</div>
                                        </div>
                                    @endif

                                    {{-- Laporan Kegiatan --}}
                                    @if ($latestMonev->status_laporan_kegiatan === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Upload Ulang Laporan Kegiatan <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" accept=".pdf" class="form-control"
                                                name="laporan_kegiatan" />
                                            <div class="form-text text-muted">Max. Size: 5 MB | Filetype: PDF</div>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_laporan_kegiatan }}</div>
                                        </div>
                                    @endif

                                    {{-- Laporan Keuangan --}}
                                    @if ($latestMonev->status_laporan_keuangan === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Upload Ulang Laporan Keuangan <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" accept=".pdf" class="form-control"
                                                name="laporan_keuangan" />
                                            <div class="form-text text-muted">Max. Size: 5 MB | Filetype: PDF</div>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_laporan_keuangan }}</div>
                                        </div>
                                    @endif

                                    {{-- Lainnya --}}
                                    @if ($latestMonev->status_lainnya === 'Ditolak')
                                        <div class="mb-5 p-4 border rounded">
                                            <label class="form-label fw-semibold">Upload Ulang Link Lainnya <span
                                                    class="text-danger">*</span></label>
                                            <input type="url" class="form-control" name="lainnya" />
                                            <div class="form-text text-muted">Max. Size: 5 MB | Filetype: PDF</div>
                                            <div class="form-text text-black mt-2">Catatan Monev:
                                                {{ $latestMonev->catatan_lainnya }}</div>
                                        </div>
                                    @endif

                                    {{-- Tombol Submit --}}
                                    <div class="mb-3 text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Kirim Perbaikan</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                @endif
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
