@extends('layouts.master')
@section('content')
<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                    List Kegiatan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('list-kegiatan.index') }}" class="text-muted text-hover-primary">Data Hibah</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('list-kegiatan.data', ['proposal_id' => $proposal_id])}}" class="text-muted text-hover-primary">List Kegiatan</a>
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
                <div class="d-flex flex-stack mb-5">
                    <div class="d-flex align-items-center position-relative my-1">
                        <select name="tahun" id="filter_tahun" class="form-control w-150px" required>
                            <option value="">Pilih Tahun</option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                        <a href="{{ route('list-kegiatan.tambah', ['proposal_id' => $proposal_id]) }}" type="button" class="btn btn-primary er fs-6 px-4 py-2">
                            <i class="ki-outline ki-plus fs-2"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle" style="table-layout: fixed; width: 100%;">
                        <thead>
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
                                <th style="width: 180px;">Total Pengajuan Anggaran</th>
                                <th style="width: 180px;">Total Penggunaan Anggaran</th>
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
                        <tbody>
                            @forelse ($listKegiatan as $kegiatan)
                            <tr class="text-center">
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
                                <td>{{ $kegiatan->surat_kerja }}</td>
                                <td>{{ $kegiatan->surat_tugas }}</td>
                                <td class="text-primary">
                                    <a href="{{ asset('storage/template_laporan/' . $kegiatan->template_laporan) }}" target="_blank">Download</a>
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
</div>
<div class="modal fade" id="m_modal_6" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="m_modal_6_title">Title</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form class="form" action="" method="POST" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="">
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Nama</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Nama" name="nama" />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Skema Hibah</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Skema Hibah" name="skema_hibah" />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Mitra</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Mitra" name="mitra" />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2"><span class="required">Program
                                Studi</span></label>
                        <select name="program_studi" class="form-control" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="1">Sistem Informasi</option>
                            <option value="2">Teknik Informatika</option>
                            <option value="3">Teknik Komputer</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Kriteria</span>
                        </label>
                        <textarea name="kriteria" placeholder="Kriteria" autocomplete="off" class="form-control"></textarea>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Periode Pengajuan</span>
                        </label>
                        <input type="date" class="form-control" placeholder="Periode Pengajuan"
                            name="periode_pengajuan" />
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                        <a href="#" onclick="save()" class="btn btn-primary ">
                            Simpan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    function resetForm() {
        $('#formAdd')[0].reset();
        $('[name="program_studi"] :selected').removeAttr('selected');
    }

    function add_ajax() {
        method = 'add';
        resetForm();
        $('#m_modal_6_title').html("Tambah Hibah");
        $('#m_modal_6').modal('show');
    }

    function edit(id) {
        method = 'edit';
        resetForm();
        $('#m_modal_6_title').html("Edit Hibah");

        $.ajax({
            url: "{{ url('informasi_hibah/edit') }}/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.data) {
                    $('#formAdd')[0].reset();
                    $('[name="id"]').val('1');
                    $('[name="nama"]').val('Lorem');
                    $('[name="skema_hibah"]').val('CF');
                    $('[name="mitra"]').val('Lorem');
                    $('[name="program_studi"]').val('1').change();
                    $('[name="kriteria"]').val('Lorem');
                    $('[name="periode_pengajuan"]').val('2025-02-21');
                    $('#m_modal_6').modal('show');
                } else {
                    Swal.fire("Oops", "Gagal mengambil data!", "error");
                }
                mApp.unblockPage();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                mApp.unblockPage();
                Swal.fire("Error", "Gagal mengambil data dari server!", "error");
            }
        });
    }
</script>
@endsection