@extends('layouts.master')
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                        Monev Kegiatan</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('monev-kegiatan.index') }}" class="text-muted text-hover-primary">Monev
                                Kegiatan</a>
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
                        <span class="card-label fw-bold fs-3 mb-1">Daftar Kegiatan</span>
                    </h3>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 text-center align-middle">
                                    <th style="width: 40px;">No</th>
                                    <th style="width: 150px;">Jenis Hibah</th>
                                    <th style="width: 150px;">Program Studi</th>
                                    <th style="width: 150px;">Jenis Aktivitas</th>
                                    <th style="width: 250px;">Nama Kegiatan (Sesuai dengan proposal)</th>
                                    <th style="width: 100px;">Jumlah Luaran</th>
                                    <th style="width: 120px;">Satuan Luaran</th>
                                    <th style="width: 200px;">Luaran Kegiatan</th>
                                    <th style="width: 180px;">Status Pelaksanaan Kegiatan</th>
                                    <th style="width: 150px;">Total Pengajuan Anggaran</th>
                                    <th style="width: 150px;">Total Penggunaan Anggaran</th>
                                    <th style="width: 130px;">Tanggal Awal</th>
                                    <th style="width: 130px;">Tanggal Akhir</th>
                                    <th style="width: 180px;">Rentang Pengerjaan</th>
                                    <th style="width: 200px;">Panitia Kegiatan (Initial)</th>
                                    <th style="width: 180px;">Rincian Jumlah Peserta</th>
                                    <th style="width: 180px;">Tempat Pelaksanaan</th>
                                    <th style="width: 130px;">Surat Kerja</th>
                                    <th style="width: 130px;">Surat Tugas</th>
                                    <th style="width: 130px;">Template Laporan</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                @forelse ($kegiatans as $kegiatan)
                                    <tr class="">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kegiatan->jenis_hibah }}</td>
                                        <td>{{ $kegiatan->program_studi }}</td>
                                        <td>{{ $kegiatan->jenis_aktivitas }}</td>
                                        <td>{{ $kegiatan->nama_kegiatan }}</td>
                                        <td>{{ $kegiatan->jumlah_luaran }}</td>
                                        <td>{{ $kegiatan->satuan_luaran }}</td>
                                        <td>{{ $kegiatan->luaran_kegiatan }}</td>
                                        <td>{{ $kegiatan->status_pelaksanaan_kegiatan }}</td>
                                        <td>Rp {{ number_format($kegiatan->total_anggaran_pengajuan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($kegiatan->total_anggaran_penggunaan, 0, ',', '.') }}</td>
                                        <td>{{ $kegiatan->tanggal_awal }}</td>
                                        <td>{{ $kegiatan->tanggal_akhir }}</td>
                                        <td>{{ $kegiatan->rentang_pengerjaan }} Bulan</td>
                                        <td>{{ $kegiatan->panitia_pengerjaan }}</td>
                                        <td>{{ $kegiatan->rincian_jumlah_peserta }}</td>
                                        <td>{{ $kegiatan->tempat_pelaksanaan }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $kegiatan->surat_kerja) }}" target="_blank">
                                                Lihat Surat Kerja
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ asset('storage/' . $kegiatan->surat_tugas) }}" target="_blank">
                                                Lihat Surat Tugas
                                            </a>
                                        </td>

                                        <td class="text-primary">
                                            <!-- Tombol untuk memicu modal -->
                                            <button type="button" class="btn btn-sm btn-light-primary"
                                                data-bs-toggle="modal" data-bs-target="#unggahModal{{ $kegiatan->id }}">
                                                Input
                                            </button>

                                            <!-- Modal Upload -->
                                            <div class="modal fade" id="unggahModal{{ $kegiatan->id }}" tabindex="-1"
                                                aria-labelledby="unggahModalLabel{{ $kegiatan->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('template-laporan.store', $kegiatan->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="unggahModalLabel{{ $kegiatan->id }}">Unggah
                                                                    Template Laporan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="template_laporan" class="form-label">File
                                                                        Template</label>
                                                                    <input type="file" name="template_laporan"
                                                                        class="form-control" required
                                                                        accept=".pdf,.doc,.docx">
                                                                </div>
                                                                @if ($kegiatan->template_laporan)
                                                                    <p class="mt-2">Saat ini:
                                                                        <a href="{{ asset('storage/' . $kegiatan->template_laporan) }}"
                                                                            target="_blank">Lihat Template</a>

                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Unggah</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Belum ada kegiatan untuk proposal ini.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
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
