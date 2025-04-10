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
                        <a href="{{route('list-kegiatan.index')}}" class="text-muted text-hover-primary">List Kegiatan</a>
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
                    <table class="table table-row-dashed table-row-gray-300 align-middle" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 text-center align-middle">
                                <th style="width: 40px; vertical-align: middle;">No</th>
                                <th style="width: 150px; vertical-align: middle;">Jenis Hibah</th>
                                <th style="width: 150px; vertical-align: middle;">Program Studi</th>
                                <th style="width: 150px; vertical-align: middle;">Jenis Aktivitas</th>
                                <th style="width: 250px; vertical-align: middle;">Nama Kegiatan (Sesuai dengan proposal)</th>
                                <th style="width: 100px; vertical-align: middle;">Jumlah Luaran</th>
                                <th style="width: 120px; vertical-align: middle;">Satuan Luaran</th>
                                <th style="width: 200px; vertical-align: middle;">Luaran Kegiatan</th>
                                <th style="width: 180px; vertical-align: middle;">Status Pelaksanaan Kegiatan</th>
                                <th style="width: 180px; vertical-align: middle;">Total Pengajuan Anggaran</th>
                                <th style="width: 180px; vertical-align: middle;">Total Penggunaan Anggaran</th>
                                <th style="width: 130px; vertical-align: middle;">Tanggal Awal</th>
                                <th style="width: 130px; vertical-align: middle;">Tanggal Akhir</th>
                                <th style="width: 180px; vertical-align: middle;">Rentang Pengerjaan</th>
                                <th style="width: 200px; vertical-align: middle;">Panitia Kegiatan (Initial)</th>
                                <th style="width: 180px; vertical-align: middle;">Rincian Jumlah Peserta</th>
                                <th style="width: 180px; vertical-align: middle;">Tempat Pelaksanaan</th>
                                <th style="width: 130px; vertical-align: middle;">Surat Kerja</th>
                                <th style="width: 130px; vertical-align: middle;">Surat Tugas</th>
                                <th style="width: 130px; vertical-align: middle;">Template Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>1</td>
                                <td>Hibah Aset PEDP</td>
                                <td>SI</td>
                                <td>Workshop</td>
                                <td>Workshop Pengembangan Desain Produk Unggulan Program Studi dengan Melibatkan Industri</td>
                                <td>3</td>
                                <td>Paket</td>
                                <td>Desain Produk</td>
                                <td>Terbit</td>
                                <td>Rp 25.000.000</td>
                                <td>Rp 20.000.000</td>
                                <td>2025-01-10</td>
                                <td>2025-02-10</td>
                                <td>1 Bulan</td>
                                <td>AA, BB</td>
                                <td>30</td>
                                <td>PCR</td>
                                <td>SK001.pdf</td>
                                <td>ST001.pdf</td>
                                <td class="text-primary">Download</td>
                            </tr>
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